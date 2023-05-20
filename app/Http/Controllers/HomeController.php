<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $role = Auth::user()->role;
            if ($role == '1') {
                $users = User::all();
                return view('admin.admindashboard', ['users' => $users]);
            }
        else{
            return redirect()->route('profile.show');
        }
    }else {
        return redirect()->route('login');
    }
}
}
