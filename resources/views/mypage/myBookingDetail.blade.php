@extends('pageLayout')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $("#btnBookingCancel").click(function() {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               $.ajax({
                  type: "POST",
                  url: "/myBookingCancel",
                  data: {
                     bookingCode: '{{ $bookingService->bookingCode }}'
                  },
                  datatype: 'json',
                  async: false,
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                     console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                  },
                  // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                  success: function (result) {
                     location.href = "/myBookingDetail/{{ $bookingService->bookingCode }}";
                  },
                  failure: function (result) {
                     console.log('========================> Fail: ' + result);
                  }
               });
            });

            $("#btnBookingEdit").click(function() {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               $.ajax({
                  type: "POST",
                  url: "/myBookingEdit",
                  data: {
                    bookingCode: '{{ $bookingService->bookingCode }}',
                    countAdult: document.getElementById("adultCount").value,
                    countChild: document.getElementById("childCount").value,
                    tourDate: document.getElementById("bookingDate").value,
                    userRequirement: document.getElementById("bookingMessage").value,
                    totalPrice: document.getElementById("totalPrice").value,
                  },
                  datatype: 'json',
                  async: false,
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                     console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                  },
                  // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                  success: function (result) {
                     location.href = "/myBookingDetail/{{ $bookingService->bookingCode }}";
                  },
                  failure: function (result) {
                     console.log('========================> Fail: ' + result);
                  }
               });
            });

            $( "#bookingDate" ).datepicker({
                dateFormat: 'dd/mm/yy'
            });

            $("#adultMinus").click(function() { 
                var adultCount = parseInt(document.getElementById("adultCount").value);

                if (adultCount > 0) {
                    document.getElementById("adultCount").value = adultCount - 1;

                    sumTotalPrice();
                }
            });

            $("#adultPlus").click(function() { 
                var adultCount = parseInt(document.getElementById("adultCount").value);

                document.getElementById("adultCount").value = adultCount + 1;
                sumTotalPrice();
            });

            $("#childMinus").click(function() { 
                var childCount = parseInt(document.getElementById("childCount").value);

                if (childCount > 0) {
                    document.getElementById("childCount").value = childCount - 1;
                    sumTotalPrice();
                }
            });

            $("#childPlus").click(function() { 
                var childCount = parseInt(document.getElementById("childCount").value);

                document.getElementById("childCount").value = childCount + 1;
                sumTotalPrice();
            });
        });

        function sumTotalPrice() {
            var adultCount = parseInt(document.getElementById("adultCount").value);
            var childCount = parseInt(document.getElementById("childCount").value);
            var totalPrice = (adultCount * {{ $bookingService->adultPrice }}) + (childCount * {{ $bookingService->childPrice }});

            document.getElementById("totalPrice").value = totalPrice;
            $("#displayTotalPrice").html("<b>$ " + totalPrice + ".00</b>");
        }
   </script>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/mypage/myBooking.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>My Booking</h2>
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
                <h2 class="contact-title">My Booking > Booking Information</h2>
            </div>
            <div class="row">
                <div class="col-12" style="padding: 20px 0px; text-align:center; border-top: 1px solid #eee;">
                <h2>Booking Code - {{ $bookingService->bookingCode }}</h2>
                
                </div>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Bike Tour Package
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Adult ($ {{ $bookingService->adultPrice }})
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Child ($ {{ $bookingService->childPrice }})
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Total Price
                </div>
                <div class="col-auto" style="width: 130px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    Date
                </div>
                <div class="col-auto" style="width: 120px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    State
                </div>
            </div>
            <div class="row">
                <div class="col-5" style="padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>{{ $bookingService->tourTitle }}</b>
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    @if ($bookingService->bookingState == 'B')
                    <div class="form-group">
                        <button id="adultMinus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button" ><em class="fas fa-minus"></em></button>
                        <input type="text" id="adultCount" name="adultCount" style="width: 50px; display: inline; text-align: center; background-color: #FFF;" readonly class="form-control" value="{{ $bookingService->countAdult }}">
                        <button id="adultPlus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button"><em class="fas fa-plus"></em></button>
                    </div>
                    @else
                    <b>{{ $bookingService->countAdult }}</b>
                    @endif
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    @if ($bookingService->bookingState == 'B')
                    <div class="form-group">
                        <button id="childMinus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button" ><em class="fas fa-minus"></em></button>
                        <input type="text" id="childCount" name="childCount" style="width: 50px; display: inline; text-align: center; background-color: #FFF;" readonly class="form-control" value="{{ $bookingService->countChild }}">
                        <button id="childPlus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button"><em class="fas fa-plus"></em></button>
                    </div>
                    @else
                    <b>{{ $bookingService->countChild }}</b>
                    @endif
                </div>
                <div class="col-auto" style="width: 150px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <div id="displayTotalPrice"><b>$ {{ $bookingService->totalPrice }}</b></div>
                    <input type="hidden" name="totalPrice" id="totalPrice" value="{{ $bookingService->totalPrice }}">
                </div>
                <div class="col-auto" style="width: 130px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    @if ($bookingService->bookingState == 'B')
                    <input type="text" id="bookingDate" name="bookingDate" value="{{ Carbon\Carbon::parse($bookingService->tourDate)->format('d/m/Y') }}" style="width: 130px; text-align: center; background-color: #FFF;" readonly class="form-control"  onblur="this.placeholder = 'Select Date'" placeholder="Select Date">
                    @else
                    <b> {{ Carbon\Carbon::parse($bookingService->tourDate)->format('d/m/Y') }}</b>
                    @endif
                </div>
                <div class="col-auto" style="width: 120px; padding: 10px 0px; text-align:center; border-top: 1px solid #eee;">
                    <b>
                    @switch($bookingService->bookingState)
                        @case('C')
                            <span>Cancelled</span>
                            ({{ $bookingService->cancelDate }})
                            @break
                        @case('A')
                            <span>Confirmed </span>
                            @break
                        @default
                            <span>Booked</span>
                    @endswitch
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top: 50px; padding-bottom:10px; border-top: 1px solid #eee;">Message</div>
                <div class="col-12" style="padding: 10px 15px; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                @if ($bookingService->bookingState == 'B')
                    <textarea class="form-control w-100" name="bookingMessage" id="bookingMessage" rows="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Include a message with your purchase (optional)'" placeholder="Include a message with your purchase (optional)">{{ $bookingService->userRequirement }}</textarea>
                @else
                    @if (isset($bookingService->userRequirement))
                        {{ $bookingService->userRequirement }}
                    @else
                        No message!
                    @endif
                @endif
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-100 pt-30">
                    <button type="button" onClick="window.location.href='/myBooking';" class="button button-contactForm btn_1 boxed-btn"> &laquo; MY BOOKING</button>
                </div>
                @if ($bookingService->bookingState == 'B')
                <div class="col-6 mb-100 pt-30" style="text-align: right;">
                    <button type="button" class="button button-contactForm btn_1 boxed-btn" data-toggle="modal" data-target="#modalBookingEdit">BOOKING EDIT</button>
                    <button type="button" class="button button-contactForm btn_1 boxed-btn" data-toggle="modal" data-target="#modalBookingCancel">BOOKING CANCEL</button>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12 pb-100"></div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->

    <!-- Modal -->
    <div class="modal fade" id="modalBookingCancel" tabindex="-1" role="dialog" aria-labelledby="modalBookingCancelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongCancelTitle">Booking Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel your booking?
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnBookingCancel">Booking Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBookingEdit" tabindex="-1" role="dialog" aria-labelledby="modalBookingEditTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongEditTitle">Booking Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to edit your booking?
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnBookingEdit">Booking Edit</button>
                </div>
            </div>
        </div>
    </div>
@stop