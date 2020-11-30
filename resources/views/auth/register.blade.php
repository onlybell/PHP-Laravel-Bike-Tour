@extends('pageLayout')

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/hero_login.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Membership</h2>
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
            <div class="col-lg-12"  style="text-align: center;">
                <div class="col-lg-7" style="text-align: left; display: inline-block;">
                    <form class="form-contact contact_form" method="post" id="frmMemberSignup" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-title">Sign Up</h2>
                        </div>
                        <div class="col-12">
                            <div class="mb-10">
                                <input class="form-control @error('uEmail') is-invalid @enderror" name="uEmail" id="uEmail" type="email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" placeholder="Enter Email Address">
                                @error('uEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" required autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="password_confirmation" id="password-confirm" type="password" required autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Confirm Password'" placeholder="Enter Confirm Password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-10">
                                <input class="form-control @error('uFirstName') is-invalid @enderror" name="uFirstName" id="uFirstName" type="text" value="{{ old('uFirstName') }}" required autocomplete="uFirstName" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter First Name'" placeholder="Enter First Name">
                                @error('uFirstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-10">
                            <input class="form-control @error('uLastName') is-invalid @enderror" name="uLastName" id="uLastName" type="text" value="{{ old('uLastName') }}" required autocomplete="uLastName" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Last Name'" placeholder="Enter Last Name">
                                @error('uLastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="contactNum" id="contactNum" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Contact Number'" placeholder="Enter Contact Number">
                            </div>
                        </div>
                        <div class="col-12" style="text-align:right;">
                            <button type="submit" class="button button-contactForm boxed-btn" id="btnSignup" >Sign Up</button>
                        </div>
                     </div>

                    </form>
               </div>    
                </div>
            </div>
        </div>
    </section>
    
    <!-- ================ contact section end ================= -->

@stop