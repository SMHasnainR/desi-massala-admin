<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        $reicpes = Recipe::where('status',1)->get()->take(6);

        return view('home', compact('reicpes'));
    }
}
