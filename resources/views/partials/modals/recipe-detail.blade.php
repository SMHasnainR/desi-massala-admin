<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Recipe : {{ $recipe->name }} </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="recepie_details_area py-4 px-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_thumb">
                        <img src="{{url('')}}/assets/img/recipe/{{ $recipe->image_url ?: 'sample.jpg'}}" class='recipe-img-modal' alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_info">
                        <div class="recipe-title d-flex justify-content-center">
                            <h1>
                                {{$recipe->name}}
                            </h1>
                        </div>

                        <div class='recipe-excerpt'>
                            <h4>
                                {{ $recipe->excerpt }}
                            </h4>
                        </div>


                        <div class="recepies_details">
                            <ul>
                                <li><h5><strong>Time</strong> : {{ $recipe->time_from}} - {{$recipe->time_to}} Mins </h5></li>
                                <li><h5><strong>Category</strong> : {{ $recipe->category->name }} </h5></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 px-5">
                    <h3>Description :</h3>
                    <div class="recepies_text">
                        {!! $recipe->details !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
</div>
