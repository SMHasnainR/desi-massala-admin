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
        $categories = Category::where('name','<>','Healthy')->get();

        return view('home', compact('recipes','categories'));
    }

    //
    public function about(){
        $categories = Category::where('name','<>','Healthy')->get();

        return view('about', compact('categories'));
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
        $categories = Category::where('name','<>','Healthy')->get();
        return view('contact',compact('categories'));
    }

    public function healthy(){

        $blogs = Recipe::where('type','blog')->where('status',1)->get();
        $categories = Category::where('name','<>','Healthy')->get();
        return view('healthyliving', compact('categories','blogs'));
    }
}
