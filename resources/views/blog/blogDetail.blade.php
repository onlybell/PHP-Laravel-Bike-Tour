@extends('pageLayout')

@section('content')

   <script>
      $(document).ready(function() {

         $("#btnSaveComment").click(function() {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               });

               $.ajax({
                  type: "POST",
                  url: "/blogComment",
                  data: {
                     bIdx: '{{ $tourBlogDetail->bIdx }}',
                     blogComment: document.getElementById("blogComment").value,
                     userName: document.getElementById("userName").value,
                     userEmail: document.getElementById("userEmail").value
                  },
                  datatype: 'json',
                  async: false,
                  error: function (XMLHttpRequest, textStatus, errorThrown) {
                     console.log("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
                  },
                  // Successful execution, triggers toast message to display on page, notifying user that data has been saved or not
                  success: function (result) {
                     location.href = "/blogDetail/{{ $tourBlogDetail->bIdx }}";
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
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/hero_blog.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Bike Tour Blog</h2>
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
         <div class="row">
            <div class="col-lg-12 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                  @if (isset($tourBlogDetail->imgSrc))
                     <img class="img-fluid" src="{{ asset('assets/img/blog') }}/{{ $tourBlogDetail->imgSrc }}" alt="">
                  @endif
                  </div>
                  <div class="blog_details">
                     <h2>{{ $tourBlogDetail->blogTitle }}</h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><i class="fa fa-comments"></i> {{ $commentCount }} Comments</li>
                     </ul>
                     <p class="excert">{{ $tourBlogDetail->blogContent }}</p>
                  </div>
               </div>
               <div class="navigation-top">
                  <div class="navigation-area mt-0" style="border-bottom: 0px; pading-bottom: 15px;">
                     <div class="row">
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                           @if (isset($previous_record))
                           <div class="thumb">
                              <a href="/blogDetail/{{ $previous_record->bIdx }}">
                                 <img class="img-fluid" src="{{ asset('assets/img/post/prev_post.jpg') }}" alt="">
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="/blogDetail/{{ $previous_record->bIdx }}">
                                 <span class="lnr text-white ti-arrow-left"></span>
                              </a>
                           </div>
                           <div class="detials">
                              <p>Prev Post</p>
                              <a href="/blogDetail/{{ $previous_record->bIdx }}">
                                 <h4>{{ $previous_record->blogTitle }}</h4>
                              </a>
                           </div>
                           @endif
                        </div>
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                           @if (isset($next_record))
                           <div class="detials">
                              <p>Next Post</p>
                              <a href="/blogDetail/{{ $next_record->bIdx }}">
                                 <h4>{{ $next_record->blogTitle }}</h4>
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="/blogDetail/{{ $next_record->bIdx }}">
                                 <span class="lnr text-white ti-arrow-right"></span>
                              </a>
                           </div>
                           <div class="thumb">
                              <a href="/blogDetail/{{ $next_record->bIdx }}">
                                 <img class="img-fluid" src="{{ asset('assets/img/post/next_post.jpg') }}" alt="">
                              </a>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="comments-area mt-0" style="padding: 25px 0px 0px 0px;">
                  <h4 style="margin-bottom: 15px;">Comments</h4>
                  @foreach($tourBlogComment as $tbc)
                  <div class="comment-list" style="padding-bottom: 20px;">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb"></div>
                           <div class="desc">
                              <p class="comment mb-0">
                              {{ $tbc->blogComment }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{ $tbc->userName }}</a>
                                    </h5>
                                    <p class="date">{{ Carbon\Carbon::parse($tbc->registerDate)->format('F j, Y') }} at {{ Carbon\Carbon::parse($tbc->registerDate)->format('g:i a') }} </p>
                                 </div>
                                 <div class="reply-btn"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach

                  @if ($commentCount == 0)
                  <div class="comment-list" style="padding-bottom: 20px;">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="desc">
                              <p class="comment mb-0">No Comments!</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
                  
               </div>
               <div class="comment-form mt-0" style="padding-top: 25px;">
                  <h4 style="margin-bottom: 10px;">Leave a Reply</h4>
                  <form class="form-contact comment_form" action="#" id="commentForm">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control @error('blogComment') is-invalid @enderror w-100" name="blogComment" id="blogComment" required cols="30" rows="6" placeholder="Write Comment"></textarea>
                              @error('blogComment')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control @error('userName') is-invalid @enderror" name="userName" id="userName" value="@auth {{ $loginUser->uFirstName }} @endauth" type="text" required placeholder="Name">
                              @error('userName')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control @error('userEmail') is-invalid @enderror" name="userEmail" id="userEmail" value="@auth {{ $loginUser->uEmail }} @endauth" type="email" required placeholder="Email">
                              @error('userEmail')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" onClick="window.location.href='/blog';" class="button button-contactForm btn_1 boxed-btn"> &laquo; List</button>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn" id="btnSaveComment">Send Message</button>
                        </div>
                     </div>
                     
                    
                    
                  </form>
               </div>
            </div>
            
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->

@stop