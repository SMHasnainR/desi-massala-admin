<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use DataTables;

class RecipeController extends Controller
{

    public function index(Request $request)
    {

        // Load Data through Ajax
        if ($request->ajax()) {
            $data = Recipe::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', '<h6 class="mb-0 text-sm">{{$name}}</h6>')
                    ->editColumn('image','<img src="../assets/img/recipe/{{ $image_url }}" class="avatar avatar-sm me-3" alt="xd">')
                    ->editColumn('author','<span class="text-xs font-weight-bold">{{$author}}</span>')
                    ->editColumn('author','<span class="text-sm font-weight-bold">{{$author}}</span>')
                    ->editColumn('status', function($query){
                        return $query->status == 1 ?
                        '<span class="badge badge-sm bg-gradient-success">Active</span>' :
                        '<span class="badge badge-sm bg-gradient-secondary">Un-Active</span>';
                    })
                    ->editColumn('time', '<span class="text-xs font-weight-bold">{{ $time_from }} - {{ $time_to }} mins</span>')
                    ->editColumn('category', function($query){
                        $category =  Category::find($query->category_id);
                        return '<span class="text-sm font-weight-bold">'.$category->name.'</span>';
                    })
                    ->addColumn('action', function($row){
                            $editBtn = '<a href="'.route('recipes.edit',$row->id).'" class="edit btn btn-primary btn-sm mx-1">Edit </a>';
                            $delBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm mx-1">Delete </a>';
                            return $editBtn .$delBtn;
                    })
                    ->rawColumns(['image','name','author','category','status',"time",'action'])
                    ->make(true);
        }

        return view('admin.recipe.index');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.recipe.add',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'time_from' => 'required|max:300',
            'time_to' => 'required|max:300',
            'details' => 'required|min:10'
        ]);

        $extraData = [
            'author' => auth()->user()->name,
            'type' => 'admin',
            'status' => '1'
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
            return redirect()->route('recipes.index')->with('error','Error creating recipe:'.$e->getMessage());
        }

        return redirect()->route('recipes.index')->with('success','Recipe has been created successfully');
    }


    public function edit(Recipe $recipe){
        $categories = Category::all();
        return view('admin.recipe.add',compact('categories','recipe'));
    }

    public function update(Request $request, Recipe $recipe){
        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'time_from' => 'required|max:300',
            'time_to' => 'required|max:300',
            'details' => 'required|min:10'
        ]);

        // Uploading Image file
        $extraData = [];
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/img/recipe'), $imageName);
            $extraData['image_url'] =  $imageName;
        }

        // Storing Image data into DB
        try{
            $recipe->update($extraData + $request->all());
            $recipe->save();
        } catch(Exception $e){
            return redirect()->route('recipes.index')->with('error','Error updating recipe :'.$e->getMessage());
        }

        return redirect()->route('recipes.index')->with('success','Recipe has been updated successfully');
    }

    public function destroy(Recipe $recipe){
        $response = [];
        try{
            $recipe->delete();
            $response['success'] = 'Recipe has been deleted successfully;';

        }catch(Exception $e){
            $response['error'] = $e->getMessage();
        }
        return $response;
    }

    public function userRecipe()
    {
        return view('tables');
    }

}
