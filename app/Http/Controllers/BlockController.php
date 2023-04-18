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

    // Page
    public function page($id)
    {
        // Menggunakan findOrFail() untuk menemukan project berdasarkan id
        $project = Project::findOrFail($id);

        // Menggunakan eager loading untuk mengambil relasi pageDB
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

    public function deletePage($id)
    {
        Page::where('id', '=', $id)->delete();
        return redirect('/page' . $id)->with('deletePage', 'Berhasil menghapus data!');
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
