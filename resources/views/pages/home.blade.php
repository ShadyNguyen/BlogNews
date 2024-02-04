@extends('welcome');

@section('content')
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach ($post as $key => $pt)
                            <div class="col-md-6">
                                <div class="tn-img-slider">
                                    <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    <div class="tn-title">
                                        <a href="#">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @foreach ($post->take(4) as $key => $pt)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img
                                        src="{{ asset('uploads/article/' . $pt->image) }}"style="height:250px; width:350px; object-fit:cover;" />
                                    <div class="tn-title">
                                        <a href="#">{{ $pt->title }}</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                {{-- @foreach ($category->take(4) as $cate)
                    <div class="col-md-6">
                        <h2>{{ $cate->name }}</h2>
                        <div class="row cn-slider">
                            <div class="col-md-6">
                                <div class="cn-img">
                                    @foreach ($post_cate[$cate->name] as $post)
                                        <img src="{{ asset('uploads/article/' . $post->image) }}" />
                                        <div class="tn-title">
                                            <a href="#">{{ $post->title }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- Category News End-->



    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">Featured News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#latest">Latest News</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="latest" class="container tab-pane fade">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Most Viewed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-recent">Most Recent</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="m-viewed" class="container tab-pane active">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="m-read" class="container tab-pane fade">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="m-recent" class="container tab-pane fade">
                            @foreach ($post->take(3) as $key => $pt)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('uploads/article/' . $pt->image) }}" />
                                    </div>
                                    <div class="tn-title" style=" overflow:hidden">
                                        <a href="">{{ $pt->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($post as $key => $pt)
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="{{ asset('uploads/article/'.$pt->image) }}" />
                                <div class="mn-title">
                                    <a href="">{{$pt->title}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach ($post as $key => $pt)
                                <li>
                                    <a href="#">{{ $pt->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
    <!-- Main News End-->
@endsection
