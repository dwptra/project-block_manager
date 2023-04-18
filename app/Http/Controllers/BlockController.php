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

    // Page
    public function page($id)
    {
        $project = Project::findOrFail($id); // Mengambil data proyek berdasarkan ID
        $pageDB = Page::where('project_id', $id)->get(); // Mengambil data halaman berdasarkan ID proyek
        return view('pages.page', compact('project', 'pageDB')); // Mengirimkan data proyek dan data halaman ke view
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
