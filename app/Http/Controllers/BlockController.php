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
            'project_manager' => $request->project_manager
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

        return view('blocks.block_master', compact('blockCategory'));
    }

    public function blockMasterCreate()
    {
        $blockCategoryCreate = BlockCategory::all();

        return view('blocks.block_master_create', compact('blockCategoryCreate'));
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
        $pageDetailsDelete->delete(); 

        return redirect()->route('block', $page_id)->with('deleteBlock', 'Berhasil menghapus data!');
    }

    public function blockCreate($id)
    {
        $page = Page::findOrFail($id);
        $pageDB = Page::with('projects')->findOrFail($id);
        $blockCategory = BlockCategory::all();

        return view('blocks.block_create', compact('pageDB', 'blockCategory', 'page'));
    }

    public function postBlock(Request $request, $id)
    {
        // $page = Page::findOrFail($id);
        $request->validate([
            'category_id' => 'required',
            'block_name' => 'required|min:3',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'sample_image_1' => 'required|image|mimes:jpeg,png,jpg,gif',
            'sample_image_2' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menggunakan store() untuk menyimpan file gambar ke lokal
        $mainImage = $request->file('main_image')->store('public/images/main_image');
        $mobileImage = $request->file('mobile_image')->store('public/images/mobile_image');
        $sampleImage1 = $request->file('sample_image_1')->store('public/images/sample_image_1');
        $sampleImage2 = $request->file('sample_image_2')->store('public/images/sample_image_2');

        // Membuat data baru dengan isian dari request
        Block::create([
            'category_id' => $request->category_id,
            'block_name' => $request->block_name,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
            'mobile_image' => $mobileImage,
            'sample_image_1' => $sampleImage1,
            'sample_image_2' => $sampleImage2,
        ]);

        // Jika berhasil, arahkan ke halaman /page dengan pemberitahuan berhasil
        return redirect()->route('block', $page_id)->with('createblock', 'Berhasil membuat page!');
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
