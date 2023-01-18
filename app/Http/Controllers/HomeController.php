<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DailyRecipe;
use App\Models\HealthyVideo;
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

    public function contact(){

        return view('contact');
    }

    public function healthy(){

        // $blogs = Recipe::where('type','blog')->where('status',1)->simplePaginate(2);
        $blogCategories = Category::where('type','blog')->get();
        $video = HealthyVideo::first();

        return view('blogs.index', compact('blogCategories','video'));
    }

    public function dailyRecipe(Request $request){
        $recipes =  DailyRecipe::simplePaginate(6);

        // If Load More button is clicked then return recipes only
        if($request->ajax()){
            return $recipes;
        }
        return view('daily-recipe.index', compact('recipes'));
    }

    public function showBlog(Recipe $blog){
        if($blog->type !== 'blog' || $blog->status !== 1){
            abort(404);
        }

        $otherBlogs = Recipe::where('type','blog')->where('id','<>',$blog->id)->get();
        return view('blogs.show', compact('blog','otherBlogs'));
    }
}
