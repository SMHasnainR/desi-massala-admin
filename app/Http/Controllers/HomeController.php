<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home(){

        $recipes = Recipe::where('status',1)->where('type','recipe')->get()->take(6);

        return view('home', compact('recipes'));
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

    public function vegRecipes(){

        return view('vegrecipes');
    }

    public function contact(){

        return view('contact');
    }

    public function healthy(){

        // $blogs = Recipe::where('type','blog')->where('status',1)->simplePaginate(2);
        $blogCategories = Category::where('type','blog')->get();
        return view('blogs.index', compact('blogCategories'));
    }

    public function showBlog(Recipe $blog){
        if($blog->type !== 'blog' || $blog->status !== 1){
            abort(404);
        }

        $otherBlogs = Recipe::where('type','blog')->where('id','<>',$blog->id)->get();
        return view('blogs.show', compact('blog','otherBlogs'));
    }
}
