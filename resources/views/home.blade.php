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
    <!-- slider_area_end -->

    <!-- recepie_area_start  -->
    <section class="recepie_area">
        <div class="container">
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recipe_img recepie_thumb">
                                <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url ?: 'sample.jpg' }}"
                                    class="recepie_thumb" alt="">
                            </div>
                            <h3 class="title pointer recipe-modal-open" data-id="{{ $recipe->id }}" role='button'>
                                {{ $recipe->name }}</h3>
                            <span>{{ $recipe->category->name }}</span>
                            <p>Time Needs: {{ $recipe->time_from }} - {{ $recipe->time_to }} mins</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="line_btn">View Full Recipe</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /recepie_area_start  -->


    <!-- latest_trand     -->
    <div class="latest_trand_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="trand_info text-center">
                        <h5>Thousands of recipes are waiting to be watched</h5>
                        <h3>Discover latest trending recipes</h3>
                        <a href="{{ route('recipes') }}" class="boxed-btn3 latest-btn">View all Recipes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ latest_trand     -->

    <!-- Modal -->
    <div class="modal fade" id="recipeModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

@endsection

@section('end-script')
    <script>
        $('.recipe-modal-open').on('click', function() {
            let id = $(this).data('id');
            console.log(id);

            // Ajax Call to delete the recipe
            let url = "{{ route('recipes.modal.details', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "GET",
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    if (data.success) {
                        console.log('ups')
                        $('#recipeModal .modal-content').html(data.modal);
                        $('#recipeModal').modal('show');
                    }
                    if (data.error) {
                        console.log(data.error);
                    }

                }
            });

        });
    </script>
@endsection
