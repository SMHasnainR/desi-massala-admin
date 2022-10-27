@extends('layouts.app')

@section('content')

    {{-- Slider --}}
    <div class="nav-overlay">

    </div>
    <div class="slider_text text-center w-100">
        <div class="col-8">
            <h3>
                Chicken dish with per boiled egg
            </h3>
        </div>
    </div>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ url('') }}/assets/img/banner/banner-r.jpg" alt="Third slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ url('') }}/assets/img/banner/shahi-haleem-mix-banner.jpg"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100"
                    src="{{ url('') }}/assets/img/banner/depositphotos_308863016-stock-photo-cooking-banner-food-top-view.jpg"
                    alt="Second slide">
            </div>
        </div>
    </div>

    <!-- recepie_area_start  -->
    <div class="recepie_area">
        <div class="container">
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb">
                                <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url }}"
                                    class="recepie_thumb" alt="">
                            </div>
                            <h3 class="title pointer" data-toggle="modal" data-target="#exampleModalshort" role='button'>
                                {{ $recipe->name }}</h3>
                            <span>{{ $recipe->category->name }}</span>
                            <p>Time Needs: {{ $recipe->time_from }} - {{ $recipe->time_to }} mins</p>
                            <a href="#" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb" >
                            <img src="img/recepie/recpie_1.png" alt="">
                        </div>
                        <h3>Egg Manchurian</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="#" class="line_btn">View Full Recipe</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <img src="img/recepie/recpie_2.png" alt="">
                        </div>
                        <h3>Pure Vegetable Bowl</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="#" class="line_btn">View Full Recipe</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
                            <img src="img/recepie/recpie_3.png" alt="">
                        </div>
                        <h3>Egg Masala Ramen</h3>
                        <span>Appetizer</span>
                        <p>Time Needs: 30 Mins</p>
                        <a href="#" class="line_btn">View Full Recipe</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- /recepie_area_start  -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalshort" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="recepie_details_area pt-3">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-6">
                                    <div class="recepies_thumb">
                                        <img src="img/recepie/recepie_details.png" alt="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="recepies_info">
                                        <h3>Dragon tiger phoenix</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation.</p>

                                        <div class="resepies_details">
                                            <ul>
                                                <li>
                                                    <p><strong>Rating</strong> : <i class="fa fa-star"></i><i
                                                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                            class="fa fa-star"></i><i class="fa fa-star"></i> </p>
                                                </li>
                                                <li>
                                                    <p><strong>Time</strong> : 30 Mins </p>
                                                </li>
                                                <li>
                                                    <p><strong>Category</strong> : Main Dish </p>
                                                </li>
                                                <li>
                                                    <p><strong>Tags</strong> : Dinner, Main, Chicken, Dragon, Phoenix </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="links">
                                            <a href="#"> <i class="fa fa-facebook"></i> </a>
                                            <a href="#"> <i class="fa fa-twitter"></i> </a>
                                            <a href="#"> <i class="fa fa-linkedin"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="recepies_text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit.</p>
                                        <p> Voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                                            occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                            id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                                            inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo
                                            enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                            porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                            velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore
                                            magnam aliquam quaerat voluptatem.</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit. Voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                            culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                            omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                                            rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                                            beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                                            aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
                                            ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
                                            quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi
                                            tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- dish_area start  -->
    <!-- <div class="dish_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="dish_wrap d-flex">
                            <div class="single_dish text-center">
                                <div class="thumb">
                                    <img src="img/recepie/recpie_4.png" alt="">
                                </div>
                                <h3>Birthday Catering</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="single_dish text-center">
                                <div class="thumb">
                                    <img src="img/recepie/recpie_5.png" alt="">
                                </div>
                                <h3>Birthday Catering</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="single_dish text-center">
                                <div class="thumb">
                                    <img src="img/recepie/recpie_6.png" alt="">
                                </div>
                                <h3>Birthday Catering</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!--/ dish_area start  -->


    <!-- latest_trand     -->
    <div class="latest_trand_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="trand_info text-center">
                        <p>Thousands of recipes are waiting to be watched</p>
                        <h3>Discover latest trending recipes</h3>
                        <a href="#" class="boxed-btn3">View all Recipes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ latest_trand     -->
@endsection
