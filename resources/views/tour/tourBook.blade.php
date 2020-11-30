@extends('pageLayout')

@section('content')

    <script>
      $(document).ready(function() {

         $("#btnSaveBooking").click(function() {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               $.ajax({
                  type: "POST",
                  url: "/tourBookConfirm",
                  data: {
                     pIdx: '{{ $tourProduct->pIdx }}',
                     tourCode: '{{ $tourProduct->tourCode }}',
                     countAdult: '{{ $bookInfo->adultCount }}',
                     countChild: '{{ $bookInfo->childCount }}',
                     tourDate: '{{ $bookInfo->bookingDate }}',
                     userRequirement: '{{ $bookInfo->bookingMessage }}',
                     totalPrice: '{{ $totalPrice }}'
                  },
                  datatype: 'json',
                  async: false,
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                     console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                  },
                  // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                  success: function (result) {
                     //console.log(result['success']);
                     location.href = "/tourBookThanks/"+result['success'];
                  },
                  failure: function (result) {
                     console.log('========================> Fail: ' + result);
                  }
               });
         });
      });
   </script>

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
                <h2 class="contact-title">booking confirmation</h2>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Bike Tour Package
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Adult ($ {{ $tourProduct->adultPrice }})
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Child ($ {{ $tourProduct->childPrice }})
                </div>
                <div class="col-3" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Date
                </div>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $tourProduct->tourTitle }}</b>
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookInfo->adultCount }}</b>
                </div>
                <div class="col-2" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookInfo->childCount }}</b>
                </div>
                <div class="col-3" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                   <b> {{ $bookInfo->bookingDate }}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top: 50px; padding-bottom:10px; border-top: 1px solid #eee;">Message</div>
                <div class="col-12" style="padding: 10px 15px; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                @if (isset($bookInfo->bookingMessage))
                    {{ $bookInfo->bookingMessage }}
                @else
                    No message!
                @endif
                </div>
            </div>
            <div class="row mt-50">
                <div class="col-8"></div>
                <div class="col-2" style="padding: 10px 0px; text-align: right; border-bottom: 1px solid #eee;">Adult Price:</div>
                <div class="col-2" style="padding: 10px 0px; text-align: center; border-bottom: 1px solid #eee;">$ {{ number_format($tourProduct->adultPrice * $bookInfo->adultCount, 2) }}</div>
            </div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-2" style="padding: 10px 0px; text-align: right; border-bottom: 1px solid #eee;">Child Price:</div>
                <div class="col-2" style="padding: 10px 0px; text-align: center; border-bottom: 1px solid #eee;">$ {{ number_format($tourProduct->childPrice * $bookInfo->childCount, 2) }}</div>
            </div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-2" style="padding: 10px 0px; text-align: right; border-bottom: 1px solid #eee;">Total Price:</div>
                <div class="col-2" style="padding: 10px 0px; text-align: center; border-bottom: 1px solid #eee;"><b>$ {{ number_format($totalPrice, 2) }}</b></div>
            </div>
            <div class="col-12 mb-100 pt-30" style="text-align: right;">
                <button type="submit" class="button button-contactForm btn_1 boxed-btn" id="btnSaveBooking">BOOK CONFIRM</button>
            </div>
         </div>
      </section>
      <!--================ Blog Area end =================-->
@stop