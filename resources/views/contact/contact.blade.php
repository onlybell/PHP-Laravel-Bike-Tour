@extends('pageLayout')

@section('content')

    <script>
    $(document).ready(function() {

        $("#btnSendContact").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/contact",
                data: {
                    cTitle: document.getElementById("cTitle").value,
                    cMessage: document.getElementById("cMessage").value,
                    cName: document.getElementById("cName").value,
                    cEmail: document.getElementById("cEmail").value,
                    cContactNum: document.getElementById("cContactNum").value
                },
                datatype: 'json',
                async: false,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                },
                // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                success: function (result) {
                    location.href = "/contactConfirm";
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
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/hero_contact.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Contact us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- ================ contact section start ================= -->
    <section class="contact-section" style="padding-top: 30px; padding-bottom: 30px;" >
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="#" id="contactForm">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control form-control @error('cTitle') is-invalid @enderror" name="cTitle" id="cTitle" type="text" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                    @error('cTitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control form-control @error('cMessage') is-invalid @enderror w-100" name="cMessage" id="cMessage" required cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                                    @error('cMessage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control form-control @error('cName') is-invalid @enderror" name="cName" id="cName" value="@auth {{ $loginUser->uFirstName }} @endauth" type="text" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Name'" placeholder="Enter Your Name">
                                    @error('cName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control form-control @error('cEmail') is-invalid @enderror" name="cEmail" id="cEmail" value="@auth {{ $loginUser->uEmail }} @endauth" ype="email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" placeholder="Enter Email Address">
                                    @error('cEmail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="cContactNum" id="cContactNum" type="text" value="@auth {{ $loginUser->contactNum }} @endauth" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Contact Number (Optional)'" placeholder="Enter Contact Number (Optional)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 pb-100">
                            <button type="submit" class="button button-contactForm boxed-btn" id="btnSendContact">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>4 Cemetery Road, </h3>
                            <p>Queenstown, NZ 9300</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+64 3 000 000</h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>support@biketourqueenstown.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@stop