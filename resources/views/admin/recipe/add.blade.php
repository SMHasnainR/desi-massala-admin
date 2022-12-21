@extends('admin.layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h4 class="mb-0">{{ __('Add Recipe') }}</h4>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ isset($recipe) ? route('recipes.update',$recipe->id) : route('recipes.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        {{-- @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif --}}
                        @if (in_array($routeName, ['recipes.blog.create','recipes.create']))
                            <input type="hidden" name="type" value='{{ $routeName == 'recipes.blog.create' ? 'blog' : 'recipe' }}'>
                        @endif

                        {{-- <input type="hidden" name="type" value='{{ in_array($routeName,['recipes.blog.create', 'recipes.blog.update']) ? 'blog' : 'recipe' }}'> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label"> Recipe Name: </label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('name') ?: (isset($recipe) ? $recipe->name : '' )}}" type="text" placeholder="Recipe Name"
                                            id="name" name="name" required>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="form-control-label">Category: </label>
                                    <div class="@error('category_id')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="category" name="category_id" required >
                                            <option disabled selected>-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option class='' value="{{$category->id}}" {{ isset($recipe) ? ($recipe->category_id == $category->id ? 'selected' : '' ) : ''}} >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="time" class="form-control-label">Time: </label>
                                    <div
                                        class="d-flex justify-content-between align-items-center @error('time_from', 'time_to') border border-danger rounded-3 @enderror">
                                        <input class="form-control w-25" type="number" id="time_from" name="time_from"
                                            value="{{ isset($recipe) ? $recipe->time_from : ''}}" required> -
                                        <input class="form-control w-25" type="number" id="time_to" name="time_to"
                                            value="{{ isset($recipe) ? $recipe->time_to : ''}}"required> mins
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Main Image: </label>
                                    <div
                                        class="d-flex justify-content-between align-items-center @error('image') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="file" id="image" name="image"
                                            value=""> -
                                    </div>
                                </div>
                                <div class='form-group mx-5'>
                                    <img id='img-preview' src="{{ isset($recipe) ? asset('assets/img/recipe').'/'.$recipe->image_url : '#'}}" class="img-thumbnail" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="summernote">Recipe Excerpt: </label>
                                {{-- <input type="text" class="form-control" name='excerpt' value='{{ isset($recipe) ? $recipe->excerpt : ''}}'> --}}
                                <textarea class='form-control' name="excerpt" >{{ old('excerpt') ?: (isset($recipe) ? $recipe->excerpt : '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Recipe: </label>
                            <div class="@error('details')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="summernote" rows="4" placeholder="Recipe Details..." name="details">{!! old('details') ?: (isset($recipe) ? $recipe->details : '') !!}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('end-script')
    <script>

        // On Choosing the file, Display the file
        $('#image').on('change', function(){
            let image_file = $('#image')[0];
            let imgPrev = $('#img-preview')[0];
            let [file] = image_file.files
            if (file) {
                imgPrev.src = URL.createObjectURL(file)
            }
        });


    </script>
@endsection
