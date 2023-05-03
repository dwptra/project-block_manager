<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectManager;

class UserController extends Controller
{
    //
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
            'role' => 'required'
        ]);

        $user = ProjectManager::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('updateUser', 'Berhasil merubah User!');
    }
}
