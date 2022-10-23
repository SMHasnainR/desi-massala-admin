<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use DataTables;

class AdminController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard(Request $request)
    {
        $categoryCount = Category::count();
        $adminRecipeCount =  Recipe::where('type', 'admin')->count();
        $userRecipeCount = Recipe::where('type', 'user')->count();

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

        return view('dashboard', compact('categoryCount', 'adminRecipeCount', 'userRecipeCount'));
    }

    public function userRecipes()
    {

        return view('user-recipes');
    }

    public function banners()
    {
        return view('banners');
    }

}
