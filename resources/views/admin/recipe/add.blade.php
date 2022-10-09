@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h4 class="mb-0">{{ __('Add Recipe') }}</h4>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="/user-profile" method="POST" role="form text-left">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label"> Recipe Name: </label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="text"
                                            placeholder="Recipe Name" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">Category: </label>
                                    <div class="@error('category')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="category" name="category" >
                                            <option value="">Vegetable</option>
                                            <option value="">Health</option>
                                        </select>
                                        @error('category')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="user.location" class="form-control-label">Time: </label>
                                    <div class="d-flex justify-content-between align-items-center @error('user.location') border border-danger rounded-3 @enderror">
                                        <input class="form-control w-25" type="number" id="name"
                                            name="location" value=""> -
                                        <input class="form-control w-25" type="number" id="name"
                                            name="location" value=""> mins

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.location" class="form-control-label">Main Image: </label>
                                    <div class="d-flex justify-content-between align-items-center @error('user.location') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="file" id="image"
                                            name="image" value=""> -
                                    </div>
                                </div>
                                <div class='form-group mx-5'>
                                    <img src="../assets/img/recipe/recipe-1.png" class="img-thumbnail"  alt="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        </div>
                        <div class="form-group">
                            <label for="about">Recipe: </label>
                            <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="about" rows="4" placeholder="Recipe Details..."
                                    name="about_me">{{ auth()->user()->about_me }}</textarea>
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
