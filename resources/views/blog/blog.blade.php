@extends('pageLayout')

@section('content')

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/hero_blog.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Bike Tour Blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Blog Area Start -->
    <div class="home-blog-area section-padding2" style="padding-top: 50px; padding-bottom: 0px;">
        <div class="container">
            <div class="row">
            @foreach($tourBlog as $tb)
                <div class="col-xl-6 col-lg-6 col-md-6">
                    
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/img/blog/{{ $tb->imgSrc }}" width="570" height="369" alt=""  onerror="this.src='assets/img/blog/default-image-blog.jpg';">
                            <a href="#" class="blog_item_date">
                                <h3>{{ Carbon\Carbon::parse($tb->registerDate)->format('d') }}</h3>
                                <p>{{ Carbon\Carbon::parse($tb->registerDate)->format('M') }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="/blogDetail/{{$tb->bIdx}}">
                                <h2>{{$tb->blogTitle}}</h2>
                            </a>
                            <p style="height:75px;">{{ Str::limit($tb->blogContent, 200, '...') }}</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-comments"></i> {{ $tb->comments_count }} Comments</a></li>
                            </ul>
                        </div>
                    </article>

                </div>
            @endforeach
               
            </div>
        </div>
    </div>
    <!-- Blog Area End -->
    <!-- Pagination-area Start -->
    <div class="pb-50 pt-10">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav class="blog-pagination justify-content-center d-flex" style="margin-top: 0px;">
                            {{ $tourBlog->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination-area End -->
@stop