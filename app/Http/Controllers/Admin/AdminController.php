<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
    
    public function dashboard()
    {
        return view('dashboard');
    }

    public function userRecipes()
    {

        return view('user-recipes');
    }

    public function banners()
    {
        return view('banners');
    }

}
