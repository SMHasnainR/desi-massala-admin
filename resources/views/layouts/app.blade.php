<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('') }}/assets/img/logos/dallas_logo.png">

    <title>Dallas Desi Masalla</title>

    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Packages/Library -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('') }}/css/style.css">

    {{-- <link rel="stylesheet" href="{{ url('') }}/css/slick.css">
    <link rel="stylesheet" href="{{ url('') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{ url('') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ url('') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ url('') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ url('') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ url('') }}/css/gijgo.css">
    <link rel="stylesheet" href="{{ url('') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ url('') }}/css/slick.css">
    <link rel="stylesheet" href="{{ url('') }}/css/slicknav.css"> --}}

    <link rel="stylesheet" href="{{ url('') }}/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

    @if (session('success'))
    {{-- @props(['type', 'message']) --}}

    <div class='flash_message'>
        <div class='container'>
            <div class='flash-success alert p-0 d-flex justify-content-between align-items-center' >
                <div class='icon ion-happy-outline h-100'>
                    <i class='fa fa-check'></i>
                </div>
                <div class='message mx-2'> {{ session('success') }}</div>
                <button type="button" class="close text-success mx-2" data-dismiss="alert">x</button>
            </div>
        </div>
    </div>

{{--
        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            <span class="alert-text ">
                </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div> --}}
    @endif

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row justify-content-between align-items-center flex-nowrap flex-md-wrap">
                        <div class="col-xl-2 col-md-1 col-2">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <!-- <img src="img/logo.png" alt=""> -->
                                    <img src="{{ url('') }}/assets/img/logos/dallas_logo.png" height="80"
                                        width="80" alt="">
                                </a>
                            </div>
                        </div>
                        <div id="nav" class="col-xl-8 col-lg-9 col-md-8">
                            <div class="main-menu" id="mainMenu">
                                <nav>
                                    <ul id="navigation" class="w-100  d-none d-lg-block">
                                        <li><a href="{{ route('home') }}">home</a></li>
                                        <li><a href="{{ route('about') }}">about</a></li>
                                        <li><a href="{{ route('daily-recipes') }}">Daily Recipes</a></li>
                                        <li><a href="{{ route('recipes') }}">Recipes</a></li>
                                        <li><a href="{{ route('recipes.vegetables') }}">Veg Recipes</i></a></li>
                                        <li><a href="{{ route('recipes.users') }}">User Recipe</a></li>
                                        <li><a href="{{ route('healthy') }}">Healthy Living</a></li>
                                        {{-- <li><a href="{{ route('contact') }}">Contact</a></li> --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div id="add-recipe-div" class="flex-wrap">
                            <a href="#" class="line_btn btn-primary text-white d-lg-block"
                                data-toggle="modal" data-target="#addRecipeModal" role='button'>Add Recipe</a>
                        </div>
                        <div class="col-2 w-100 m-0 fa-2x text-white d-flex justify-content-center bar-icon ">
                            <i id="bar" class="fa fa-bars " aria-hidden="true" onclick="showMenu()" ></i>
                            <i id='cross' class="fa fa-times d-none" id="fa-cross" onclick="showMenu()"></i>
                        </div>

                        {{-- <div class="col-1 d-none d-lg-block">
                            {{-- <div class="search_icon m-0 w-100 ">
                                <a href="#">
                                    <i class="fa fa-search text-white"></i>
                                </a>
                            </div> --}}
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- Modal -->
    <div class="modal fade" id="addRecipeModal" tabindex="-1" role="dialog" aria-labelledby="addRecipeModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecipeModalTitle">Add Your Recipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body pt-4 p-3">
                    <form id='add-recipe-form' action="{{ route('recipes.store') }}" method="POST"
                        role="form text-left" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text ">
                                    {{ $errors->first() }}
                                </span>
                                <button type="button" class="close text-danger mx-2" data-dismiss="alert">x</button>

                            </div>
                        @endif

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="author_name" class="form-control-label"> Name: </label>
                                    <div class="@error('author_name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('author_name') ?: '' }}" type="text"
                                            placeholder="Enter Your Name" id="author_name" name="author_name"
                                            required>
                                        @error('author_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label"> Recipe Name: </label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ old('name') ?: '' }}" type="text"
                                            placeholder="Recipe Name" id="name" name="name" required>
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="form-control-label">Category: </label>
                                    <div class="@error('category_id') border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="category" name="category_id" required>
                                            <option disabled selected>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option class='' value="{{ $category->id }}"
                                                    {{ old('category_id') === $category->id ? 'selected' : '' }} >
                                                    {{ $category->name }}</option>
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
                                        <input class="form-control w-25" type="number" id="time_from"
                                            name="time_from" value="{{ old('time_from') ?: '' }}" required>
                                            @error('time_from')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                             -
                                        <input class="form-control w-25" type="number" id="time_to"
                                            name="time_to" value="{{ old('time_to') ?: '' }}" required>
                                            @error('time_to')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            mins
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
                                    <img id='img-preview' src="#" class="img-thumbnail" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Recipe Excerpt: </label>
                            {{-- <input type="text" class="form-control" name='excerpt' value='{{ isset($recipe) ? $recipe->excerpt : ''}}'> --}}
                            <textarea class='@error('excerpt')border border-danger rounded-3 @enderror form-control' id="excerpt" name="excerpt">{{ old('excerpt') ?: '' }}</textarea>
                            @error('excerpt')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="summernote">Recipe: </label>
                            <div class="@error('details')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="summernote" rows="4" placeholder="Recipe Details..." name="details">{{ old('details') ?: '' }}</textarea>
                                @error('details')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="add-recipe-btn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <footer class="footer ">
        <div class="d-flex flex-column justify-content-center align-items-center pd-5 footer-col">
            <div>
                <a href="{{ route('home') }}">
                    <img src="{{ url('') }}/assets/img/logos/dallas_logo.png" height="80" width="80" alt="">
                </a>
            </div>
            <div class="footer-items justify-content-center w-100 flex-wrap">

                <a href="{{ route('about') }}">About us</a>
                <a href="{{ route('recipes') }}">Recipes</a>
                <a href="{{ route('recipes.vegetables') }}">Veg Recipes</i></a>
                <a href="{{ route('recipes.users') }}">Users Recipes</a>
                <a href="{{ route('healthy') }}">Healthy Living</a>
                <a href="{{ route('contact') }}">Contact Us</a>

            </div>
            <div class="">
                <p>&#169; Copyright 2022 Dallas Desi Masala</p>
            </div>
        </div>
    </footer>
    <!--/ footer  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ url('') }}/js/main.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showMenu() {
            $('#navigation').toggleClass('d-none');
            $('#navigation').toggleClass('mob-nav');
            $('#bar').toggleClass('d-none');
            $('#cross').toggleClass('d-none');
            $('body').toggleClass('scroll-off');
            document.getElementById("navigation").style.transition = "all 1s";
        }

        $(document).ready(function() {
            $('#add-recipe-btn').on('click', function() {
                $('#add-recipe-form').submit();
            });

            var navigation = document.getElementById("navigation");


            // On Choosing the file, Display the file
            $('#image').on('change', function(){
                let image_file = $('#image')[0];
                let imgPrev = $('#img-preview')[0];
                let [file] = image_file.files
                if (file) {
                    imgPrev.src = URL.createObjectURL(file)
                }
            });

            @if (Session::has('success'))
                console.log('{{session("success")}}')
            @endif

            @if (Session::has('error'))
                console.log('{{session("error")}}')
            @endif

            @if ($errors->any())
                console.log("{{$errors->first()}}");
                $('#addRecipeModal').modal('show');
            @endif


        })


    </script>

    @yield('end-script')
    <!-- JS here -->
    <!-- <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script> -->

    <!--contact js-->
    <!-- <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script> -->

</body>

</html>
