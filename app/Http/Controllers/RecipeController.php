<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function index(){
        $recipes =  Recipe::whereHas('category', function(Builder $query){
            $query->where('name','<>','Vegetable');
        })->where('status', 1)->get()->take(9);
        $title = 'Our  Recipes';

        $categories = Category::all();
        return view('recipes.index', compact('recipes','categories','title'));
    }

    public function vegRecipes(){

        $recipes =  Recipe::whereHas('category', function(Builder $query){
            $query->where('name','Vegetable');
        })->where('status', 1)->get()->take(9);
        $title = 'Vegetable Recipes';

        $categories = Category::all();
        return view('recipes.index', compact('recipes','categories','title'));
    }

    public function show(Recipe $recipe){
        if($recipe->status == 0){
            // Return 404 Not Found
        }
        $categories = Category::all();
        return view('recipes.show', compact('recipe','categories'));
    }

    public function getModalDetails(Recipe $recipe){

        $response = [
            'success' => true,
            'modal' => view('partials.modals.recipe-detail', compact('recipe'))->render(),
        ];

        return response()->json($response);
    }


    public function store(Request $request){

        $isAdmin = Auth::check();

        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1000,max_height=1000',
            'time_from' => 'required|max:300',
            'time_to' => 'required|max:300',
            'details' => 'required|min:10'
        ]);

        if(!$isAdmin){
            $request->validate([
                'author_name' => 'required|max:100',
            ]);
        }

        $extraData = [
            'author' =>  $isAdmin ? auth()->user()->name : $request->author_name,
            'type' =>  $isAdmin ? 'admin' : 'user',
            'status' => $isAdmin ? '1' : '0'
        ];

        // Uploading Image file
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/img/recipe'), $imageName);
            $extraData['image_url'] =  $imageName;
        }

        // Storing Image data into DB
        try{
            Recipe::create($extraData + $request->all());
        } catch(Exception $e){
            return redirect()->back()->with('error','Error creating recipe:'.$e->getMessage());
        }

        return redirect()->back()->with('success','Recipe has been created successfully');
    }

}
