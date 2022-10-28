<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function index(){
        $recipes =  Recipe::where('status', 1)->get()->take(9);
        $categories = Category::all();
        return view('recipes.index', compact('recipes','categories'));
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
}
