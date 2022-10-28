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
                        <img src="{{url('')}}/assets/img/recipe/{{ $recipe->image_url }}" class='recipe-img-modal' alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_info">
                        <h1>{{$recipe->name}}</h1>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation.</p> --}}

                        <div class="resepies_details">
                            <ul>
                                {{-- <li>
                                    <p><strong>Rating</strong> : <i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i> </p>
                                </li> --}}
                                <li>
                                    <p><strong>Time</strong> : {{ $recipe->time_from }} - {{ $recipe->time_to }} Mins </p>
                                </li>
                                <li>
                                    <p><strong>Category</strong> : {{ $recipe->category->name }} </p>
                                </li>
                                <li>
                                    <p><strong>Author</strong> : {{ $recipe->author }} </p>
                                </li>
                                {{-- <li>
                                    <p><strong>Tags</strong> : Dinner, Main, Chicken, Dragon, Phoenix </p>
                                </li> --}}
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
