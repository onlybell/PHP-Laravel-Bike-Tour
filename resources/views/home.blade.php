@extends('pageLayout')

@section('content')
        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div style="min-height:450px;" class="single-slider hero-overly  slider-height d-flex align-items-center" data-background="assets/img/hero/h1_hero_new.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <div class="hero__caption">
                                    <h1>Bike Tour - <span>Queenstown</span> </h1>
                                    <p>Amazing Places on earth</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End--> 

        <!-- Favourite Places Start -->
        <div class="favourite-place place-padding" style="padding-top: 50px; padding-bottom: 50px;">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h2 style="margin-bottom:30px;">Favourite Tour Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($tourProduct as $tp)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <div class="place-img">
                                <img src="assets/img/service/{{$tp->imgSrc}}" alt="" onerror="this.src='assets/img/service/default-image.jpg';">
                            </div>
                            <div class="place-cap" style="padding:10px;">
                                <div class="place-cap-top" style="margin-bottom:10px;">
                                    <h3><a href="/tourDetail/{{$tp->pIdx}}">{{$tp->tourTitle}}</a></h3>
                                    <p class="dolor" style="margin-bottom:5px;">
                                        ${{$tp->adultPrice}} <span>/ Per Adult,</span> ${{$tp->childPrice}} <span>/ Per Child</span>
                                    </p>
                                </div>
                                <div class="place-cap-bottom" style="height:75px;">
                                    <ul>
                                        <li>{{ Str::limit($tp->tourSubTitle, 130, '...') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- Favourite Places End -->

        <!-- Aount us Start Arera -->
        <div class="video-area video-bg pt-50 pb-50"  data-background="assets/img/service/video-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="video-caption text-center">
                            <p class="pera1">ABOUT OUR COMPANY</p>
                            <p class="pera2">We Are Bike Tour Company</p>
                            <p class="pera3"> That Presents You Happiness</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aount us Start End -->

        <!-- Blog Area Start -->
        <div class="home-blog-area section-padding2" style="padding-top: 50px; padding-bottom: 50px;">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Our Recent news</span>
                            <h2 style="margin-bottom:30px;">Bike Tour Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($tourBlog as $bp)
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img src="assets/img/blog/{{$bp->imgSrc}}" width="570" height="369" alt="" onerror="this.src='assets/img/blog/default-image-blog.jpg';">
                                </div>
                                <div class="blog-cap">
                                    <p> |   Traveling</p>
                                    <h3 style="height:75px;"><a href="#">{{$bp->blogTitle}}</a></h3>
                                    <a href="#" class="more-btn">Read more »</a>
                                </div>
                            </div>
                            <div class="blog-date text-center">
                                <span>{{ Carbon\Carbon::parse($bp->registerDate)->format('d') }}</span>
                                <p>{{ Carbon\Carbon::parse($bp->registerDate)->format('M') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- Blog Area End -->
@stop

