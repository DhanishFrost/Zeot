<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class AdminUserController extends Controller
{

    public function store(Request $request)
    {   
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => 'User created successfully']);  
    }


    public function editUser($id){
        $user = User::where('id','=', $id)->first();
        return view('admin.admindashboard',compact('user'));
    }


    public function updateUser(Request $request)
{
    $request->validate([
        'id' => 'required',
        'editUserName' => 'required',
        'editUserEmail' => 'required|email',
    ]);

    $id = $request->id;
    $name = $request->editUserName;
    $email = $request->editUserEmail;

    $user = User::find($id);
    if ($user) {
        $user->name = $name;
        $user->email = $email;
        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
}


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('index')->with('message', 'User deleted successfully');    }
}
