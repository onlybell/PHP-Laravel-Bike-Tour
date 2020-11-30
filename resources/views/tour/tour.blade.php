@extends('pageLayout')

@section('content')

        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/hero_tour.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Bike Tour Packages</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <!-- Favourite Places Start -->
        <div class="favourite-place place-padding"  style="padding-top: 50px; padding-bottom: 20px;">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>FEATURED TOURS Packages</span>
                            <h2 style="margin-bottom:30px;">Favourite Bike Tour</h2>
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

        <!-- Pagination-area Start -->
        <div class="pb-50 pt-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav class="blog-pagination justify-content-center d-flex" style="margin-top: 0px;">
                                {{ $tourProduct->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination-area End -->

@stop