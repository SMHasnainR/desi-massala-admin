<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\DailyRecipe;
use App\Models\HealthyVideo;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function storeContact(Request $request){

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required|min:16'
        ]);

        try{
            Mail::to('hasnainmohammad145@gmail.com')->send(new ContactMail($request->name, $request->email,$request->message));
            return redirect()->back()->with('success','Message has been successfully send.');
        } catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
