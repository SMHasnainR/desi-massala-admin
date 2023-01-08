<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DailyRecipe;
use App\Models\HealthyVideo;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use DataTables;

class RecipeController extends Controller
{

    public function index(Request $request)
    {
        $routeName = $request->route()->getName();

        // Load Data through Ajax
        if ($request->ajax()) {

            // Handle Daily Recipe Menu
            if($routeName === 'admin.daily-recipes'){
                $data = DailyRecipe::query();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('image','<img alt="" src="{{ url("") }}/assets/img/daily-recipes/{{ !empty($image_slug) ? $image_slug : `sample.jpg` }}" class="avatar avatar-sm me-3" alt="xd">')
                    // ->editColumn('status', function($query){
                    //     return $query->status == 1 ?
                    //     '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" checked />' :
                    //     '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" />';
                    // })
                    ->addColumn('action', function($row){
//                            $editBtn = '<a href="'.route('admin.recipes.edit',$row->id).'" class="edit btn btn-primary btn-sm mx-1">Edit </a>';
                            $delBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm mx-1">Delete </a>';
                            return $delBtn;
                    })
                    ->rawColumns(['image','name','author','type','category','status',"time",'action'])
                    ->make(true);
            }elseif($routeName === 'admin.healthy-video'){
                $data = HealthyVideo::query();

                return DataTables::of($data)
                    ->addIndexColumn()
//                    ->editColumn('image','<img alt="" src="{{ url("") }}/assets/img/daily-recipes/{{ !empty($image_slug) ? $image_slug : `sample.jpg` }}" class="avatar avatar-sm me-3" alt="xd">')
                    // ->editColumn('status', function($query){
                    //     return $query->status == 1 ?
                    //     '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" checked />' :
                    //     '<input type="checkbox" data-id="'.$query->id.'" class="js-switch" />';
                    // })
                    ->addColumn('action', function($row){
//                            $editBtn = '<a href="'.route('admin.recipes.edit',$row->id).'" class="edit btn btn-primary btn-sm mx-1">Edit </a>';
                        $delBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm mx-1">Delete </a>';
                        return $delBtn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
            }

            $data = $routeName === 'admin.recipes.user' ? Recipe::where('type','recipe')->where('from','user')
            : ($routeName == 'admin.recipes' ? Recipe::where('type','recipe')->where('from','admin') : Recipe::where('type','blog') ) ;

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', '<h6 class="mb-0 text-sm">{{$name}}</h6>')
                    ->editColumn('image','<img src="{{ url("") }}/assets/img/recipe/{{ !empty($image_url) ? $image_url : `sample.jpg` }}" class="avatar avatar-sm me-3" alt="xd">')
                    ->editColumn('author', '<span class="text-sm font-weight-bold">{{ $author }}</span>')
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
                            $editBtn = '<a href="'.route('admin.recipes.edit',$row->id).'" class="edit btn btn-primary btn-sm mx-1">Edit </a>';
                            $delBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm mx-1">Delete </a>';
                            return $editBtn .$delBtn;
                    })
                    ->rawColumns(['image','name','author','type','category','status',"time",'action'])
                    ->make(true);
        }

        $columns = $routeName === 'admin.daily-recipes' ?
        [
            [
                "index" => "id",
                "name" => "id",
                "label" => "No",
                "sortable" => true,
            ],
            [
                "index" => "image",
                "name" => "image",
                "label" => "Image",
                "sortable" => true,
            ],
            [
                "index" => "action",
                "name" => "action",
                "label" => "Action",
                "sortable" => true,
            ],
        ] :
        ( $routeName === 'admin.healthy-video' ?
        [
            [
                "index" => "id",
                "name" => "id",
                "label" => "No",
                "sortable" => true,
            ],
            [
                "index" => "action",
                "name" => "action",
                "label" => "Action",
                "sortable" => true,
            ],
        ] :
        [
            [
                "index" => "id",
                "name" => "id",
                "label" => "No",
                "sortable" => true,
            ],
            [
                "index" => "image",
                "name" => "image",
                "label" => "Image",
                "sortable" => true,
            ],
            [
                "index" => "name",
                "name" => "name",
                "label" => "Name",
                "sortable" => true,
            ],
            [
                "index" => "author",
                "name" => "author",
                "label" => "Author",
                "sortable" => true,
            ],
            [
                "index" => "time",
                "name" => "time",
                "label" => "Time",
                "sortable" => true,
            ],
            [
                "index" => "category",
                "name" => "category",
                "label" => "Category",
                "sortable" => true,
            ],
            [
                "index" => "status",
                "name" => "status",
                "label" => "Status",
                "sortable" => true,
            ],
            [
                "index" => "action",
                "name" => "action",
                "label" => "Action",
                "sortable" => true,
            ],
        ] );

        return view('admin.recipe.index',compact('routeName','columns'));
    }

    public function create(Request $request)
    {
        $routeName = $request->route()->getName();
        $categories = $routeName == 'admin.recipes.blog.create' ? Category::where('type','blog')->get() : Category::where('type','recipe')->get();

        return view('admin.recipe.add',compact('categories','routeName'));
    }

    public function edit(Recipe $recipe, Request $request){
        $routeName = $request->route()->getName();
        $categories = Category::all();
        // $categories = $routeName == 'recipes.blog.create' ? Category::where('id',3)->get() : Category::where('name','<>','Healthy')->get();

        return view('admin.recipe.add',compact('categories','recipe','routeName'));
    }

    public function update(Request $request, Recipe $recipe){
        $request->validate([
            'name' =>'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1000,max_height=1000',
            'time_from' => 'required|max:300',
            'time_to' => 'required|max:300',
            'excerpt' => 'required|min:10|max:200',
            'details' => 'required|min:20'
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
            return redirect()->back()->with('error','Error updating recipe :'.$e->getMessage());
        }

        return redirect()->back()->with('success','Recipe has been updated successfully');
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

    public function destroyDailyRecipe(DailyRecipe $recipe){
        $response = [];
        try{
            $recipe->delete();
            $response['success'] = 'Recipe has been deleted successfully;';

        }catch(Exception $e){
            $response['error'] = $e->getMessage();
        }
        return $response;
    }
    public function createDailyRecipe()
    {
        return view('admin.daily-recipe.add');
    }

    public function storeDailyRecipe(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1480,max_height=2000',
        ]);

        // Uploading file
        $imageSlug = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/img/daily-recipes'), $imageSlug);

        // Storing Image data into DB
        try{
            DailyRecipe::create([
               'image_slug' => $imageSlug
            ]);
        } catch(Exception $e){
            return redirect()->back()->with('error','Error creating recipe:'.$e->getMessage());
        }

        return redirect()->back()->with('success','Recipe has been created successfully');
    }

}
