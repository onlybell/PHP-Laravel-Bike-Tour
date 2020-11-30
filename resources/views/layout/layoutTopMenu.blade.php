
    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
               <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                  <a href="/"><img src="{{ asset('assets/img/logo/bt_logo.png') }}" width="81" height="70" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>               
                                        <ul id="navigation">
                                        
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/about">About US</a></li>
                                            <li><a href="/tour">Tour</a></li>
                                            <li><a href="/blog">Blog</a></li>
                                            <li><a href="/contact">Contact Us</a></li>
                                            @auth
                                            <li style="margin-left:100px; margin-right: 20px;"><a href="#">My Page</a>
                                                <ul class="submenu">
                                                    <li><a href="/profile">Profile</a></li>
                                                    <li><a href="/myBooking">My Booking</a></li>
                                                    @if (Auth::user()->adminType == "A") 
                                                    <li>---------------------</li>
                                                    <li><a href="/manageBooking">Manage Booking</a></li>
                                                    <li><a href="/manageTourPackages">Tour Packages</a></li>
                                                    <li><a href="/manageContactUs">Contact Us</a></li>
                                                    <li><a href="/manageMembers">Member Management</a></li>
                                                    <li>---------------------</li>
                                                    @endif
                                                    <li><a href="#" onclick="document.frmLogout.submit();">Log Out</a></li>
                                                </ul>
                                            </li>
                                            @else
                                            <li style="margin-left:100px; margin-right: -30px;"><a href="/login">Login</a></li>
                                            <li><a href="/register">Sign Up</a></li>
                                            @endauth
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
        <form method="POST" name="frmLogout" id="frmLogout" action="{{ route('logout') }}">
        @csrf
        </form>
    </header>