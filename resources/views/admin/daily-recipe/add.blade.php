@extends('admin.layouts.user_type.auth')

@section('content')
    <div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h4 class="mb-0">{{ __('Add Recipe') }}</h4>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ isset($recipe) ? route('daily-recipes.update',$recipe->id) : route('admin.daily-recipes.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
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

                        <div class="row">
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
                                    <img id='img-preview' src="{{ isset($recipe) ? asset('assets/img/daily-recipes').'/'.$recipe->image_url : '#'}}" class="img-thumbnail" alt="">
                                </div>
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
