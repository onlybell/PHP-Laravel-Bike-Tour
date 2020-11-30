@extends('pageLayout')

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/hero_tour.jpg') }}">
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

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="col-12">
                <h2 class="contact-title">Booking confirmation</h2>
            </div>
            <div class="row">
                <div class="col-12" style="padding: 50px 0px; text-align:center; border-top: 1px solid #eee;">
                <h2>Thank You!</h2>
                Booking Code - {{ $bookingService->bookingCode }}
                </div>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Bike Tour Package
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Adult ($ {{ $bookingService->adultPrice }})
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Child ($ {{ $bookingService->childPrice }})
                </div>
                <div class="col-3" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Date
                </div>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookingService->tourTitle }}</b>
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookingService->countAdult }}</b>
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookingService->countChild }}</b>
                </div>
                <div class="col-3" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b> {{ Carbon\Carbon::parse($bookingService->tourDate)->format('d/m/Y') }}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top: 50px; padding-bottom:10px; border-top: 1px solid #eee;">Message</div>
                <div class="col-12" style="padding: 10px 15px; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                @if (isset($bookingService->bookingMessage))
                    {{ $bookingService->bookingMessage }}
                @else
                    No message!
                @endif
                </div>
            </div>
            <div class="col-12 mb-100 pt-30 text-right">
                    <button type="button" onClick="window.location.href='/myBooking';" class="button button-contactForm btn_1 boxed-btn"> &laquo; MY BOOKING</button>
                </div>
            <div class="row">
                <div class="col-12 pb-50"></div>
            </div>
        </div>
   </section>
      <!--================ Blog Area end =================-->
@stop