<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function index(){

        $recipes =  Recipe::where('status', 1)->get()->take(9);

        return view('recipes', compact('recipes'));
    }


    public function show(Recipe $recipe){
        if($recipe->status == 0){
            // Return 404 Not Found
        }
        return view('recipes.show', compact('recipe'));
    }
}
