@extends('pageLayout')

@section('content')
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
      $( function() {
         $( "#bookingDate" ).datepicker({
            dateFormat: 'dd/mm/yy'
         });

         $("#adultMinus").click(function() { 
            var adultCount = parseInt(document.getElementById("adultCount").value);

            if (adultCount > 0) {
               document.getElementById("adultCount").value = adultCount - 1;
            }
         });

         $("#adultPlus").click(function() { 
            var adultCount = parseInt(document.getElementById("adultCount").value);

            document.getElementById("adultCount").value = adultCount + 1;
         });

         $("#childMinus").click(function() { 
            var childCount = parseInt(document.getElementById("childCount").value);

            if (childCount > 0) {
               document.getElementById("childCount").value = childCount - 1;
            }
         });

         $("#childPlus").click(function() { 
            var childCount = parseInt(document.getElementById("childCount").value);

            document.getElementById("childCount").value = childCount + 1;
         });
      } );
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
         <form method="post" action="/tourBook">
         @csrf
         <input type="hidden" name="pIdx" id="pIdx" value="{{ $tourProduct->pIdx }}">
            <div class="row">
               <div class="col-6">
                  <div class="col-12 posts-list">
                     <div class="single-post">
                        <div class="feature-img">
                        @if (isset($tourProduct->imgSrc))
                           <img class="img-fluid" src="{{ asset('assets/img/service') }}/{{ $tourProduct->imgSrc }}" alt="">
                        @endif
                        </div>
                        <div class="blog_details">
                           <h2>{{ $tourProduct->tourTitle }}</h2>
                           <p class="excert"><b>{{ $tourProduct->tourSubTitle }}</b></p>
                           <p>{{ $tourProduct->tourContent }}</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-6 mt-30">
                  <div class="row">
                     <div class="col-sm-3 mt-10">Adult:</div> 
                     <div class="col-sm-3 mt-10"><b>$ {{ $tourProduct->adultPrice }}</b></div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <button id="adultMinus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button" ><em class="fas fa-minus"></em></button>
                           <input type="text" id="adultCount" name="adultCount" style="width: 70px; display: inline; text-align: center; background-color: #FFF;" readonly class="form-control" value="0">
                           <button id="adultPlus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button"><em class="fas fa-plus"></em></button>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3 mt-10">Child:</div> 
                     <div class="col-sm-3 mt-10"><b>$ {{ $tourProduct->childPrice }}</b></div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <button id="childMinus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button" ><em class="fas fa-minus"></em></button>
                           <input type="text" id="childCount" name="childCount" style="width: 70px; display: inline; text-align: center; background-color: #FFF;" readonly class="form-control" value="0">
                           <button id="childPlus" class="button button-contactForm btn_1 boxed-btn" style="padding:7px 10px;" type="button"><em class="fas fa-plus"></em></button>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3">Date:</div> 
                     <div class="col-sm-3">
                        <input type="text" id="bookingDate" name="bookingDate" value="{{ $today }}" style="width: 150px; text-align: center; background-color: #FFF;" readonly class="form-control"  onblur="this.placeholder = 'Select Date'" placeholder="Select Date">
                     </div>   
                  </div>

                  <div class="col-12 pt-30" style="padding-left: 0px;">
                     <textarea class="form-control w-100" name="bookingMessage" id="bookingMessage" rows="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Include a message with your purchase (optional)'" placeholder="Include a message with your purchase (optional)"></textarea>
                  </div>
                  <div class="col-12 pt-30" style="text-align: right;">
                     <button type="submit" class="button button-contactForm btn_1 boxed-btn">BOOK NOW</button>
                  </div>
               </div>
               </div>
            </div>
         </form>
         </div>
      </section>
      <!--================ Blog Area end =================-->
@stop