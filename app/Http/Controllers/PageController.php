<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Project;

class PageController extends Controller
{
    //
    // Page
    public function page($id)
    {
        // Menggunakan findOrFail() untuk menemukan project berdasarkan id
        $project = Project::findOrFail($id);

        // Menggunakan eager loading untuk mengambil relasi pages dan projectManager
        $project->load(['pages', 'projectManager']);

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
}
