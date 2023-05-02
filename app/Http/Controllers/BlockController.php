<?php

namespace App\Http\Controllers;

use App\Models\ProjectManager;
use App\Models\Project;
use App\Models\Block;
use App\Models\BlockCategory;
use App\Models\Page;
use App\Models\PageDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $projectDB = Project::all();
        return view('dashboard', compact('projectDB'));
    }

    public function error()
    {
        return view('404');
    }

    public function project()
    {
        $projectDB = Project::with('projectManager')->get();
        return view('project.project', compact('projectDB'));
    }

    public function createProject()
    {
        $user = ProjectManager::all();
        return view('project.project_create', compact('user'));
    }

    public function projectPost(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_manager' => 'required'
        ]);

        Project::create([
            'project_name' => $request->project_name,
            'project_manager' => $request->project_manager,
        ]);

        return redirect()->route('project')->with('createProject', 'Berhasil membuat projek baru!');
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        $user = ProjectManager::all();
        return view('project.project_edit', compact('project', 'user'));
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required',
            'project_manager' => 'required'
        ]);

        Project::find($id)->update([
            'project_name' => $request->project_name,
            'project_manager' => $request->project_manager
        ]);

        return redirect()->route('project')->with('updateProject', 'Berhasil mengubah projek!');
    }

    public function deleteProject($id)
    {
        Project::where('id', '=', $id)->delete();
        return redirect()->route('project')->with('deleteProject', 'Berhasil menghapus projek!');
    }

    // Page
    public function page($id)
    {
        // Menggunakan findOrFail() untuk menemukan project berdasarkan id
        $project = Project::findOrFail($id);

        // Menggunakan eager loading untuk mengambil relasi pages
        $project->load('pages');

        // Mengambil data pages dari relasi yang sudah dimuat
        $pageDB = $project->pages;

        return view('pages.page', compact('project', 'pageDB'));
    }
    
    public function createPage($id)
    {
        $project = Project::findOrFail($id);
        $pages = Page::with('projects')->find($id);
        return view('pages.page_create', compact('pages', 'project'));
    }

    public function postPage(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $request->validate([
            'project_id' => 'required',
            'page_name' => 'required|min:3',
            'status' => 'required|in:On Progress,On Review,Approved,Declined', // Menambahkan validasi untuk enum status
        ]);

        // bikin data baru dengan isian dari request
        Page::create([
            'project_id' => $request->project_id,
            'page_name' => $request->page_name,
            'note' => $request->note,
            'status' => $request->status,
        ]);
        
        // kalau berhasil, arahin ke halaman /user dengan pemberitahuan berhasil
        return redirect()->route('page', $id)->with('createPage', 'Berhasil membuat page!');
    }

    public function editPage($id)
    {
        $pageDB = Page::with('projects')->findOrFail($id);
        return view('pages.page_edit', compact('pageDB'));
    }
    
    public function updatePage(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'page_name' => 'required|min:3',
            'status' => 'required|in:On Progress,On Review,Approved,Declined', // Menambahkan validasi untuk enum status
        ]);

        $page = Page::findOrFail($id);
        $page->update([
            'project_id' => $request->project_id,
            'page_name' => $request->page_name,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        // Dapatkan project_id dari halaman yang diupdate
        $project_id = $page->project_id;

        // kalau berhasil, arahin ke halaman proyek dengan pemberitahuan berhasil
        return redirect()->route('page', $project_id)->with('updatePage', 'Berhasil mengubah page!');
    }

    public function deletePage($id)
    {
        $page = Page::findOrFail($id); // Menggunakan findOrFail untuk mendapatkan data halaman berdasarkan ID
        $project_id = $page->project_id; // Mendapatkan project_id dari halaman yang akan dihapus
        $page->delete(); // Menghapus data halaman dari database

        return redirect()->route('page', $project_id)->with('deletePage', 'Berhasil menghapus data!'); // Mengarahkan pengguna kembali ke halaman proyek dengan ID yang sesuai
    }

    // Blocks
    public function print($pageId)
    {
        $pagePrint = Page::findOrFail($pageId);
        $projectPrint = Project::findOrFail($pagePrint->project_id);
        $blockPrint = PageDetails::with('blocks')->where('page_id', $pageId)->get();
    
        return view('print.block_print', compact('pagePrint', 'blockPrint', 'projectPrint'));
    }    
    
    public function blockMaster()
    {
        $blockCategory = Block::with('categories')->get();
        return view('block_master.block_master', compact('blockCategory'));
    }
    
    public function blockMasterCreate()
    {
        $blockCategoryCreate = BlockCategory::all();

        return view('block_master.block_master_create', compact('blockCategoryCreate'));
    }
    
    public function blockMasterPost(Request $request)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg',
        ]);
        
        $mainImage = $request->file('main_image')->store('public/images/main_image');

        Block::create([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
        ]);

        return redirect()->route('block.master')->with('createBlockMaster', 'Berhasil membuat block');
    }

    public function blockMasterEdit($id)
    {
        $blockEdit = Block::findOrFail($id);
        $blockCategoryEdit = BlockCategory::all();
        
        return view('block_master.block_master_edit', compact('blockEdit', 'blockCategoryEdit'));
    }

    public function blockMasterUpdate(Request $request, $id)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg',
        ]);
        
        $block = Block::findOrFail($id);

        $mainImage = $block->main_image;

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image')->store('public/images/main_image');
            Storage::delete('public/images/main_image/' . $block->main_image);
        }

        $block->update([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
        ]);
        
        return redirect()->route('block.master')->with('updateBlockMaster', 'Berhasil mengubah block');
    }

    public function blockMasterDelete($id)
    {
        Block::where('id', '=', $id)->delete();
        return redirect()->route('block.master')->with('deleteBlockMaster', 'Berhasil menghapus block');
    }

    public function block($id)
    {
        $pageDB = Page::findOrFail($id);
        $blockList = PageDetails::with('pages')->where('page_id', $id)->get();
        return view('blocks.block', compact( 'blockList', 'pageDB'));
    }

    public function deleteBlock($id)
    {
        $pageDetailsDelete = PageDetails::findOrFail($id);
        $page_id = $pageDetailsDelete->page_id;

        // Hapus data
        $pageDetailsDelete->delete(); 

        // Perbarui nomor urutan data
        $pageDetails = PageDetails::where('page_id', $page_id)->orderBy('sort')->get();
        foreach ($pageDetails as $key => $detail) {
            $detail->update(['sort' => $key + 1]);
        }

        // Berhasil menghapus data, arahkan kembali ke halaman /block dengan pemberitahuan
        return redirect()->route('block', $page_id)->with('deleteBlock', 'Berhasil menghapus data!');
    }

    public function blockCreate($id)
    {
        $page = Page::findOrFail($id);
        $pageDB = Page::with('projects')->findOrFail($id);
        $projectManager = DB::table('projects')
            ->join('project_managers', 'projects.project_manager', '=', 'project_managers.id')
            ->where('projects.id', $pageDB->projects->id)
            ->select('project_managers.name')
            ->first();

        $blockDB = Block::all();
        return view('blocks.block_create', compact('pageDB', 'page', 'projectManager', 'blockDB'));
    }

    public function postBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);

        // Menghitung urutan data
        $lastSort = PageDetails::where('page_id', $page->id)->max('sort');
        $sort = $lastSort + 1; 


        // Membuat data baru dengan isian dari request
        PageDetails::create([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'page_id' => $page->id, //mengambil id dari objek page
            'sort' => $sort++,
        ]);
        
        // Jika berhasil, arahkan ke halaman /page dengan pemberitahuan berhasil
        return redirect()->route('block', $page->id)->with('createblock', 'Berhasil membuat block!');
    }

    public function blockEdit($id)
    {
        $blockEdit = PageDetails::findOrFail($id);
        $blockDB = Block::all();
        
        return view('blocks.block_edit', compact('blockDB', 'blockEdit'));
    }

    public function updateBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);

        // Periksa bahwa data yang akan diperbarui adalah milik halaman yang benar
        $pageDetails = PageDetails::findOrFail($id);
        if ($pageDetails->page_id != $request->page_id) {
            return redirect()->route('block', $page->id)->withErrors(['msg' => 'Data yang diperbarui tidak valid!']);
        }

        // Perbarui nomor urutan data
        $newSort = $request->sort;
        $oldSort = $pageDetails->sort;
        if ($newSort != $oldSort) {
            if ($newSort < $oldSort) {
                PageDetails::where('page_id', $request->page_id)->whereBetween('sort', [$newSort, $oldSort - 1])->increment('sort');
            } else {
                PageDetails::where('page_id', $request->page_id)->whereBetween('sort', [$oldSort + 1, $newSort])->decrement('sort');
            }
        }

        // Perbarui data
        $pageDetails->update([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'sort' => $newSort,
        ]);

        // Jika berhasil, arahkan ke halaman /block dengan pemberitahuan berhasil
        // return redirect()->route('dashboard')->with('updateBlock', 'Berhasil mengubah block!');
    }    

    public function blockCategory()
    {
        $categoriesDB = BlockCategory::all();
        return view('blocks.block_categories', compact('categoriesDB'));
    }

    public function postCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3',
        ]);

        // bikin data baru dengan isian dari request
        BlockCategory::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('block.categories')->with('createCategory', 'Berhasil membuat Category baru!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:3'
        ]);

        BlockCategory::find($id)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('block.categories')->with('updateCategory', 'Berhasil merubah Category!');
    }

    public function deleteCategory(Request $request, $id)
    {
        BlockCategory::where('id', '=', $id)->delete();
        return redirect()->route('block.categories')->with('deleteCategory', 'Berhasil menghapus Category.');
    }

    // Login dan Logout
    public function index()
    {
        return view('index');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:3',
        ]);

        $user = ProjectManager::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/dashboard')->with('successLogin', 'Welcome!');
        }
        return redirect('/')->with('fail', 'Periksa Email atau Password!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('successLogout', 'Berhasil keluar akun.');
    }

    // User
    public function user()
    {
        $projectMDB = ProjectManager::all();
        return view('users.user', compact('projectMDB'));
    }

    public function deleteUser($id)
    {
        ProjectManager::where('id', '=', $id)->delete();
        return redirect()->route('user')->with('deleteUser', 'Berhasil menghapus data');
    }

    public function createUser()
    {
        $project = ProjectManager::all();
        return view('users.user_create', compact('project'));
    }

    public function userPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|min:3'
        ]);

        ProjectManager::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user')->with('createUser', 'Berhasil membuat user baru!');
    }
    
    public function editUser($id)
    {
        $user = ProjectManager::findOrFail($id);

        return view('users.user_edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|min:3'
        ]);

        ProjectManager::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user')->with('updateUser', 'Berhasil merubah User!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}
