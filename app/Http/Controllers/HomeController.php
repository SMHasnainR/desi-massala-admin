<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){

        $recipes = Recipe::where('status',1)->get()->take(6);
        $categories = Category::all();

        return view('home', compact('recipes','categories'));
    }

    //
    public function about(){

        return view('about');
    }
    //
    public function recipes(){

        $recipes =  Recipe::where('status', 1)->get()->take(9);

        return view('recipes', compact('recipes'));
    }

    //
    public function vegRecipes(){

        return view('vegrecipes');
    }

    //
    public function contact(){

        return view('contact');
    }
}
