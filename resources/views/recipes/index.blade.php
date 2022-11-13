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
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single_recepie text-center">
                            <div class="recepie_thumb recipe_img">
                                <img src="{{ url('') }}/assets/img/recipe/{{ $recipe->image_url }}"
                                    class='recepie_thumb' alt="">
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
        @if ($recipes->count() > 9)
            <div>
                <div class="trand_info text-center">
                    <a href="#" class="boxed-btn3">Load More</a>
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
