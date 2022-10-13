<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RecipeController extends Controller
{

    public function index()
    {
        return view('admin.recipe.index');
    }


    public function add()
    {
        $categories = Category::all();

        return view('admin.recipe.add',compact('categories'));
    }

    public function save(Request $request){
        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'details' => 'required|min:10'
        ]);

        $extraData = [
            'author' => auth()->user()->name,
            'type' => 'admin'
        ];

        // Uploading Image file
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/img/recipe'), $imageName);
            $extraData['image_url'] = public_path('assets/img/recipe/') . $imageName;
        }

        // Storing Image data into DB
        try{
            Recipe::create($extraData + $request->all());
        } catch(Exception){
            return redirect()->route('recipes')->with('error','Error creating recipe !');
        }

        return redirect()->route('recipes')->with('success','Recipe has been created successfully');
    }

    // public function uploadImage(Request $request){
    //     request()->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $imageName = time().'.'.request()->image->getClientOriginalExtension();
    //     request()->image->move(public_path('images'), $imageName);
    //     // dd($request->image_url);
    // }


    public function userRecipe()
    {
        return view('admin.recipe.index');
    }

}
