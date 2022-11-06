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

            $routeName = $request->route()->getName();
            $data = $routeName == 'recipes.user' ? Recipe::where('type','user') : Recipe::select('*');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', '<h6 class="mb-0 text-sm">{{$name}}</h6>')
                    ->editColumn('image','<img src="{{ url("") }}/assets/img/recipe/{{ $image_url }}" class="avatar avatar-sm me-3" alt="xd">')
                    ->editColumn('author', '<span class="text-sm font-weight-bold">{{ $author }}</span>')
                    ->editColumn('type', function($query){
                        return $query->type == 'admin' ?
                        '<span class="badge badge-sm bg-gradient-success">Admin</span>' :
                        '<span class="badge badge-sm bg-gradient-secondary">User</span>';
                    })
                    ->editColumn('status', function($query){
                        return $query->status == 1 ?
                        '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" checked />' :
                        '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" />';
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
                    ->rawColumns(['image','name','author','type','category','status',"time",'action'])
                    ->make(true);
        }

        $route = $request->route()->getName();
        return view('admin.recipe.index',compact('route'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.recipe.add',compact('categories'));
    }


    public function edit(Recipe $recipe){
        $categories = Category::all();
        return view('admin.recipe.add',compact('categories','recipe'));
    }

    public function update(Request $request, Recipe $recipe){
        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1000,max_height=1000',
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

    public function updateStatus(Recipe $recipe){
        $response = [];
        try{
            $updatedValue = $recipe->status == 1 ? 0 : 1;
            $recipe->status = $updatedValue;
            $recipe->save();
            $response['success'] = 'Recipe status has been updated successfully;';

        }catch(Exception $e){
            $response['error'] = $e->getMessage();
        }
        return $response;
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
