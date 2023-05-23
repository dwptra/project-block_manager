<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Project;
use App\Models\ProjectManager;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard()
    {
        $projectDB = Project::all();
        $user = ProjectManager::all();
        $totalAdmin = 0;
        $totalPM = 0;
        $totalUser = 0;
        $totalProject = 0;

        foreach ($user as $users) {
            if ($users) {
                $totalUser++;
                if ($users->role == 'Project Manager') {
                    $totalPM++;
                } elseif ($users->role == 'Admin') {
                    $totalAdmin++;
                }
            }
        }

        foreach($projectDB as $project) {
            if ($project) {
                $totalProject++;
            }
        }

        return view('dashboard', compact('projectDB', 'user', 'totalAdmin', 'totalPM', 'totalUser', 'totalProject'));
    }

    public function error_403()
    {
        return view('403');
    }
}
