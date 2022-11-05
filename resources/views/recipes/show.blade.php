@extends('layouts.app')

@section('content')

    <!-- header-end -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Recipe Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

    <div class="recepie_details_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-md-6">
                    <div class="recipe-main-img">
                        <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url }}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_info">
                        <div class="recipe-title">
                            <h1>
                                {{$recipe->name}}
                            </h1>
                        </div>

                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p> --}}

                        <div class="recepies_details">
                            <ul>
                                <li><p><strong>Time</strong> : {{ $recipe->time_from}} - {{$recipe->time_to}} Mins </p></li>
                                <li><p><strong>Category</strong> : {{ $recipe->category->name }} </p></li>
                            </ul>
                        </div>
                        {{-- <div class="links">
                            <a href="#"> <i class="fa fa-facebook"></i> </a>
                            <a href="#"> <i class="fa fa-twitter"></i> </a>
                            <a href="#"> <i class="fa fa-linkedin"></i> </a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-12 my-5">
                    <div class="recepies_text">
                        <h1 class='mb-5' >Descirption: </h1>
                        {!! $recipe->details !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- recepie_area_start  -->
    {{-- <div class="recepie_area inc_padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_recepie text-center">
                        <div class="recepie_thumb">
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
            </div>
        </div>
    </div> --}}
    <!-- /recepie_area_start  -->


@endsection
