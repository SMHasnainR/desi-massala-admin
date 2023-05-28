@extends('layouts.app')

@section('content')

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1" >
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3> Daily Recipes </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

    <!-- recepie_area_start  -->
    <section class="recepie_area">
        <div class="container">
            <div class="row recipe-list">

                @forelse ($recipes as $recipe)
                    <div class="single_recepie text-center col-12 col-md-6 ">
                            <img src="{{ url('') }}/assets/img/daily-recipes/{{ $recipe->image_slug ?: 'sample.jpg' }}"
                                 class='daily-recipe-img' alt="Daily Recipe ">
                    </div>
                @empty
                    <h2 class="no-recipe-text">
                        Sorry, there are no recipes to show.
                    </h2>
                @endforelse
            </div>
        </div>

        @if ($recipes->hasMorePages())
            <div>
                <div class="text-center">
                    <button id='load-more-btn' href="#" class="boxed-btn3">Load More</button>
                </div>
            </div>
        @endif
    </section>


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

    // Loading Recipe Data
    var page = 1;
    function loadData(page){
        let url = "{{ route('daily-recipes') }}" ;
        console.log(url);

        console.log(page);
        $.ajax({
            url: url+'?page='+page,
            method: "GET",
            dataType: 'JSON',
            success: function(response) {
                {{--let route = '{{route("recipes.show",[":id"])}}';--}}
                console.log(response);
                // Append data to the recipe list
                response.data.forEach(function(recipe){

                    $('.recipe-list').append(`
                        <div class="single_recepie text-center col-12 col-md-6 ">
                            <img src="{{ url('') }}/assets/img/daily-recipes/${ recipe.image_slug ?? 'sample.jpg' }"
                                 class='daily-recipe-img' alt="Daily Recipe ">
                        </div>
                        `);
                });

                // If there are no more data available then hide load more btn
                if(!response.next_page_url){
                    $('#load-more-btn').hide();
                }
            },
            error: function(error) {
                // console.log(error.);
            },
            complete: function(){
                console.log("dd");
            }
        });
    }

    $('#load-more-btn').on('click',function(){
        page++;
        console.log('btn clicked');
        loadData(page);

    });

</script>
@endsection
