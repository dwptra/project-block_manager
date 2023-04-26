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

    public function createProject()
    {
        return view('project.project_create');
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

        return redirect('/dashboard')->with('createProject', 'Berhasil membuat projek baru!');
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);

        return view('project.project_edit', compact('project'));
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

        return redirect('/dashboard')->with('updateProject', 'Berhasil mengubah projek!');
    }

    public function deleteProject($id)
    {
        Project::where('id', '=', $id)->delete();
        return redirect('/dashboard')->with('deleteProject', 'Berhasil menghapus projek!');
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
        return redirect('/page' . $id)->with('createPage', 'Berhasil membuat page!');
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
        return redirect('/page' . $project_id)->with('updatePage', 'Berhasil mengubah page!');
    }

    public function deletePage($id)
    {
        $page = Page::findOrFail($id); // Menggunakan findOrFail untuk mendapatkan data halaman berdasarkan ID
        $project_id = $page->project_id; // Mendapatkan project_id dari halaman yang akan dihapus
        $page->delete(); // Menghapus data halaman dari database

        return redirect('/page' . $project_id)->with('deletePage', 'Berhasil menghapus data!'); // Mengarahkan pengguna kembali ke halaman proyek dengan ID yang sesuai
    }

    // Blocks
    public function blocksPrint(){
        return view('print.block.print');
    }

    public function block($id)
    {

        $pageDB = Page::findOrFail($id);
        $blockList = PageDetails::with('pages')->where('page_id', $id)->get();

        
        return view('blocks.block', compact( 'blockList', 'pageDB'));
    }

    public function blockCreate($id)
    {
        $pageDB = Page::with('projects')->findOrFail($id);
        $blockCategory = BlockCategory::all();

        return view('blocks.block_create', compact('pageDB', 'blockCategory'));
    }

    public function postBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
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
        Page::create([
            'category_id' => $request->category_id,
            'block_name' => $request->block_name,
            'note' => $request->note,
            'status' => $request->status,
            'main_image' => $mainImage,
            'mobile_image' => $mobileImage,
            'sample_image_1' => $sampleImage1,
            'sample_image_2' => $sampleImage2,
        ]);

        // Jika berhasil, arahkan ke halaman /page dengan pemberitahuan berhasil
        return redirect('/block' . $id)->with('createblock', 'Berhasil membuat page!');
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
            return redirect('/dashboard');
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
        return redirect('/user')->with('deleteUser', 'Berhasil menghapus data');
    }

    public function createUser()
    {
        return view('users.user_create');
    }

    public function userPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:3'
        ]);

        ProjectManager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/user')->with('createUser', 'Berhasil membuat user baru!');
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
            'password' => 'required|min:3'
        ]);

        Project::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/user')->with('updateUser', 'Berhasil merubah User!');
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
