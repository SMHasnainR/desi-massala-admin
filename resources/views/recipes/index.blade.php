@extends('layouts.app')

@section('content')

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1" >
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
            <div class="row recipe-list">
                @forelse ($recipes as $recipe)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb recipe_img">
                                <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url ?: 'sample.jpg' }}"
                                    class='recepie_thumb' alt="">
                            </div>
                            <h3 class="title pointer recipe-modal-open" data-id="{{ $recipe->id }}" role='button'>
                                    {{ $recipe->name }}</h3>
                            <span>{{ $recipe->category->name }}</span>
                            <p>Time Needs: {{ $recipe->time_from }} - {{ $recipe->time_to }} mins</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="line_btn">View Full Recipe</a>
                        </div>
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
            let url = "{{ route($routeName) }}" ;

            $.ajax({
                url: url+'?page='+page,
                method: "GET",
                dataType: 'JSON',
                success: function(response) {
                    let route = '{{route("recipes.show",[":id"])}}';

                    // Append data to the recipe list
                    response.data.forEach(function(recipe){
                        route = route.replace(':id',recipe.id);

                        $('.recipe-list').append(`
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single_recepie text-center">
                                <div class="recepie_thumb recipe_img">
                                    <img src="{{url('')}}/assets/img/recipe/${ recipe.image_url ?? 'sample.jpg' }"
                                        class='recepie_thumb' alt="">
                                </div>
                                <h3 class="title pointer recipe-modal-open" data-id="${ recipe.id }" role='button'>
                                        ${ recipe.name }</h3>
                                <span>${ recipe.category.name }</span>
                                <p>Time Needs: ${ recipe.time_from } - ${ recipe.time_to } mins</p>
                                <a href="${route}" class="line_btn">View Full Recipe</a>
                            </div>
                        </div>
                        `);
                    });

                    // If there are no more data available then hide load more btn
                    if(!response.next_page_url){
                        $('#load-more-btn').hide();
                    }
                }
            });
        }

        $('#load-more-btn').on('click',function(){
            page++;
            // console.log('btn clicked');
            loadData(page);

        });

        // Show Recipes Details on Modal when click on recipe title
        $(document).on('click','.recipe-modal-open', function() {
            let id = $(this).data('id');

            // Ajax Call to show the recipe
            let url = "{{ route('recipes.modal.details', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "GET",
                dataType: 'JSON',
                success: function(data) {
                    if (data.success) {
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
