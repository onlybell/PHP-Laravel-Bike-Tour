@extends('pageLayout')

@section('content')
<script>
      $(document).ready(function() {
         $("#btnChange").click(function() {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               $.ajax({
                  type: "POST",
                  url: "/profile",
                  data: {
                     uIdx: '{{  $loginUser->uIdx }}',
                     uEmail: document.getElementById("uEmail").value,
                     password: document.getElementById("password").value,
                     uFirstName: document.getElementById("uFirstName").value,
                     uLastName: document.getElementById("uLastName").value,
                     contactNum: document.getElementById("contactNum").value
                  },
                  datatype: 'json',
                  async: false,
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                     console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                  },
                  // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                  success: function (result) {
                      alert('Save!')
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
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/mypage/profile.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- slider Area End-->
    <section class="contact-section" style="padding-top: 30px; padding-bottom: 30px;" >
        <div class="container">

            <form class="form-contact contact_form" action="#" id="frmMemberSignup">
            <div class="row">
                <div class="col-12"> 
                    <h2 class="contact-title">Profile</h2>
                </div>
                <div class="col-12">
                    <div class="mb-10">
                        <input class="form-control" name="uEmail" id="uEmail" type="email" value="{{ $loginUser->uEmail }}" readonly onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" placeholder="Enter Email Address">
                        @error('uEmail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control valid" name="password" id="password" type="password" autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" placeholder="Enter Password">
                        @error('reg_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control valid" name="password_confirmation" id="password-confirm" type="password" autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Confirm Password'" placeholder="Enter Confirm Password">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-10">
                        <input class="form-control @error('uFirstName') is-invalid @enderror" name="uFirstName" id="uFirstName" type="text" value="{{ $loginUser->uFirstName }}" required autocomplete="uFirstName" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter First Name'" placeholder="Enter First Name">
                        @error('uFirstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-10">
                    <input class="form-control @error('uLastName') is-invalid @enderror" name="uLastName" id="uLastName" type="text" value="{{ $loginUser->uLastName }}" required autocomplete="uLastName" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Last Name'" placeholder="Enter Last Name">
                        @error('uLastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input class="form-control" name="contactNum" id="contactNum" type="text"  value="{{ $loginUser->contactNum }}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Contact Number'" placeholder="Enter Contact Number">
                    </div>
                </div>
                <div class="col-12" style="text-align:right;">
                    <button type="submit" class="button button-contactForm boxed-btn" id="btnChange" >Save</button>
                </div>
            </div>
            </form>

        </div>
    </section>
@stop