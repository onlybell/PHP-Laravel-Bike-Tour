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
                <div class="col-lg-5" style="text-align: left; display: inline-block;">
                    <form class="form-contact contact_form"  method="post" action="{{ route('login') }}" id="frmMemberLogin">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-title">Login</h2>
                        </div>
                        <div class="col-12">
                            <div class="mb-10">
                                <input class="form-control @error('uEmail') is-invalid @enderror" name="uEmail" id="uEmail" type="email" value="{{ old('uEmail') }}" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" placeholder="Enter Email Address">
                                @error('uEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-10">
                                <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="select-suport-items" style="margin-bottom:20px;">
                                <label class="single-items">Remember Me
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mb-20">
                            <button type="submit" class="button button-contactForm boxed-btn">Login</button>
                        </div>
                        
                    </div>
                    
                    </form>
                    <form class="form-contact contact_form"  method="post" action="{{ route('password.email') }}" id="frmForgottenPassword">
                    @csrf

                    <div class="row">
                        <div class="col-12" style="border-top: 1px solid #eee">
                            <h2 class="contact-title mt-20">Forgotten Password</h2>
                        </div>
                        <div class="col-12">
                            <div class="mb-10">
                                <input class="form-control @error('chk_uEmail') is-invalid @enderror" name="chk_uEmail" id="chk_uEmail" type="email" value="{{ old('chk_uEmail') }}" required autocomplete="email"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" placeholder="Enter Email Address">
                                @error('chk_uEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-20">
                            <button type="submit" class="button button-contactForm boxed-btn">Send Password Reset Link</button>
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