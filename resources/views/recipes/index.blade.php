@extends('layouts.app')

@section('content')

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

    <!-- recepie_area_start  -->
    <section class="recepie_area">
        <div class="container">
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb">
                                <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url }}"
                                    class='recepie_thumb' alt="">
                            </div>
                            <h3>{{ $recipe->name }}</h3>
                            <span>{{ $recipe->category->name }}</span>
                            <p>Time Needs: {{ $recipe->time_from }} - {{ $recipe->time_to }} mins</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if ($recipes->count() > 9)
            <div>
                <div class="trand_info text-center">
                    <a href="#" class="boxed-btn3">Load More</a>
                </div>
            </div>
        @endif
    </section>

@endsection
