@extends('layouts.app')

@section('content')

    @if (isset($video->video_slug))
        {{-- Start Video --}}
        <div class="w-100 d-flex justify-content-center align-items-center">
            <div id="light">
                <video id="video"src="{{ url('') }}/assets/video/{{ $video->video_slug ?? '' }}" width="100%"  muted
                    autoplay controls></video>
            </div>
        </div>
        <div id="fade" onClick="vidPopupClose();"></div>
    @endif

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Healthy Living</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            @forelse($blogCategories as $blogCategory)
                <h1 class="d-flex justify-content-center py-5">
                    {{ $blogCategory->name }}
                </h1>
                <div class="row ">
                    @forelse($blogCategory->blogs as $blog)
                        <article class="blog_item col-12 col-md-6">
                            <div class="blog_item_img">
                                <img class="card-img" src="{{ url('') }}/assets/img/recipe/{{ $blog->image_url ?? 'sample-yoga.jpeg' }}"
                                    alt="">
                                <a href="{{ route('healthy.show', $blog->id) }}" class="blog_item_date">
                                    <h3>{{ date('d', strtotime($blog->created_at)) }}</h3>
                                    <p>{{ date('M', strtotime($blog->created_at)) }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{ route('healthy.show', $blog->id) }}">
                                    <h2>{{ $blog->name }}</h2>
                                </a>
                                <p>
                                    {{ $blog->excerpt }}
                                </p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> {{ $blog->category->name }},
                                            Lifestyle</a></li>
                                    {{-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> --}}
                                </ul>
                            </div>
                        </article>
                    @empty
                        <h2 class="w-100 text-center my-5">
                            Sorry, there are no blogs to show.
                        </h2>
                    @endforelse
                </div>
            @empty
                <h2 class="w-100 text-center my-5">
                    Sorry, there are no Blogs to show.
                </h2>
            @endforelse
        </div>

    </section>
    <!--================Blog Area =================-->
@endsection

@section('end-script')
    <script>
        @if (isset($video->video_slug))
            {{--  Function to close Video Popup  --}}

            function vidPopupClose() {
                $('body').css('overflow', 'scroll')
                $('#fade, #light').addClass('d-none');
            }

            $(document).ready(function() {

                // If video is muted then unmute it
                $("#video").prop("muted", false);
                $("#video").click(function() {
                    $('#video').get(0).play();
                });


                // Scroll always on top
                $("html, body").animate({
                    scrollTop: 0
                }, 600);

                $('body').css('overflow', 'hidden');

                // Close video auto when finished
                $('#video').on('ended', function() {
                    vidPopupClose();
                });


            });
        @endif
    </script>
@endsection
