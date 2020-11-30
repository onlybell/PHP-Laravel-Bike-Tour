@extends('pageLayout')

@section('content')

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/admin/manage-booking-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2 style="color: #0B1C39">Manage Booking</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <section class="contact-section" style="padding-top: 30px; padding-bottom: 30px;" >
        <div class="container">
            <div class="col-12"> 
                <h2 class="contact-title">Customer Booking List</h2>
            </div>
            <div class="row">
                <div class="col-auto" style="width: 170px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Booking Code
                </div>
                <div class="col-auto" style="width: 180px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Name
                </div>
                <div class="col-auto" style="width: 350px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Bike Tour Package
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Adult
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Child
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Total Price
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    Tour Date
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                    State
                </div>
            </div>
            @foreach($bookingService as $bs)
            <div class="row">
                <div class="col-auto" style="width: 170px; padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                    <a href='/manageBookingDetail/{{$bs->bookingCode}}' style="color: #635c5c">{{$bs->bookingCode}}</a>
                </div>
                <div class="col-auto" style="width: 180px; padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                    <a href='/manageBookingDetail/{{$bs->bookingCode}}' style="color: #635c5c">{{$bs->uFirstName}} {{$bs->uLastName}}</a>
                </div>
                <div class="col-auto" style="width: 350px; padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                    <a href='/manageBookingDetail/{{$bs->bookingCode}}' style="color: #635c5c">{{$bs->tourTitle}}</a>
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                {{$bs->countAdult}}
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                {{$bs->countChild}}
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                $ {{$bs->totalPrice}}
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                {{$bs->tourDate}}
                </div>
                <div class="col-1" style="padding: 10px 0px; text-align:center; border-bottom: 1px solid #eee;">
                @switch($bs->bookingState)
                    @case('C')
                        <span>Cancelled</span>
                        @break
                    @case('A')
                        <span>Confirmed </span>
                        @break
                    @case('P')
                        <span>Processing </span>
                        @break
                    @case('H')
                        <span>Hold </span>
                        @break
                    @default
                        <span>Booked</span>
                @endswitch
                </div>
            </div>
            @endforeach
            @if ($bookingService->count() == 0)
            <div class="row">
                <div class="col-12 pb-50 pt-50" style="text-align: center; border-bottom: 1px solid #eee;">No Booking Data</div>
            </div>
            @endif
            <div class="row">
                <div class="col-12 pb-50"></div>
            </div>
        </div>

        <!-- Pagination-area Start -->
        <div class="pb-50 pt-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav class="blog-pagination justify-content-center d-flex" style="margin-top: 0px;">
                                {{ $bookingService->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination-area End -->
   </section>
@stop