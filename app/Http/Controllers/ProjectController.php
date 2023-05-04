<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectManager;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //
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
        $userRole = Auth::user()->role;

        if ($userRole == "admin") {
            $request->validate([ 
                'project_name' => 'required',
                'project_manager' => 'required',
            ]);

            $projectManager = $request->project_manager;
        }else {
            $request->validate([
                'project_name' => 'required',
            ]);

            $projectManager = Auth::user()->id;
        }

        Project::create([
            'project_name' => $request->project_name,
            'project_manager' => $projectManager,
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
}
