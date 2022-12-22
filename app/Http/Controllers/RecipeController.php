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

    public function index(Request $request){

        // Identifying the type of recipe reqeusted
        $routeName = $request->route()->getName();
        $title = $routeName === 'recipes' ? 'Our  Recipes' : ($routeName === 'recipes.users' ? 'Users Recipes' : 'Vegetable Recipes');

        //  Querying recipes wrt requested url
        $recipes = Recipe::with('category');
        if($routeName === 'recipes'){
            $recipes->whereHas('category', function(Builder $query){
                $query->where('name','Non-Vegetable');
            })->where('status', 1);
        }elseif($routeName === 'recipes.vegetables'){
            $recipes->whereHas('category', function(Builder $query){
                $query->where('name','Vegetable');
            })->where('status', 1);
        }elseif($routeName === 'recipes.users') {
            $recipes->where('from','user')->where('status', 1);
        }
        $recipes = $recipes->simplePaginate(3);

        // If Load More button is clicked then return recipes only
        if($request->ajax()){
            return $recipes;
        }

        $categories = Category::where('name','<>','Healthy')->get();
        return view('recipes.index', compact('recipes','categories','title','routeName'));
    }

    public function loadRecipe(Request $request){
        // dd()

    }

    public function show(Recipe $recipe){
        if($recipe->status == 0){
            // Return 404 Not Found
        }
        $categories = Category::where('name','<>','Healthy')->get();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1280,max_height=1000',
            'time_from' => 'required|max:300',
            'time_to' => 'required|max:300',
            'excerpt' => 'required|min:10|max:255',
            'details' => 'required|min:20'
        ]);

        if(!$isAdmin){
            $request->validate([
                'author_name' => 'required|max:100',
            ]);
        }

        $extraData = [
            'author' =>  $isAdmin ? auth()->user()->name : $request->author_name,
            'from' =>  $isAdmin ? 'admin' : 'user',
            'status' => $isAdmin ? '1' : '0'
        ];

        if(!$isAdmin){
            $extraData['type'] =  'recipe';
        }

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
