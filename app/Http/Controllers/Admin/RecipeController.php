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

        if ($request->ajax()) {
            $data = Recipe::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', '<h6 class="mb-0 text-sm">{{$name}}</h6>')
                    ->editColumn('image', function($query){
                        return '<img src="../assets/img/recipe/'. $query->image_url .'" class="avatar avatar-sm me-3" alt="xd">';
                    })
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
                            $editBtn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm mx-1">Edit </a>';
                            $delBtn = '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm mx-1">Delete </a>';
                            return $editBtn .$delBtn;
                    })
                    ->rawColumns(['image','name','author','category','status',"time",'action'])
                    ->make(true);
        }
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
        return view('tables');
    }

}
