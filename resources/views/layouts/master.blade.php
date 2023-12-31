<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>خريج</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link href="{{ asset('assets/img/خريج.svg')}}" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body dir="rtl">
    <div class="first">
        <div class="container-fluid bg-white p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">خريج...</span>
                </div>
            </div>
            <!-- Spinner End -->
            
            <!-- Navbar & Hero Start -->
            <div class="  position-relative p-0">
                <div class="   container position-relative p-0">
                    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                        <a href="" class="navbar-brand p-0">
                            <h1 class="m-0"><img class="w-250 " src="{{ asset('assets/img/خريج.svg')}}"/></h1>
                            {{-- <img class="d-none d-lg-block " src="{{ asset('assets/img/logo_web.svg')}}" alt="Logo">  --}}
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav mx-auto py-0">
                                <a href="/" class="nav-item nav-link {{is_active('')}} ">الرئيسية</a>
                                <a href="https://wa.me/+96599870752" class="nav-item nav-link {{is_active('contact')}} ">تواصل  معنا</a>
                                <a  href="{{route('demo')}}" class="nav-item nav-link  {{is_active('demo')}}">Demo </a>
                                <a href="{{route('pricing.index')}}" class="nav-item nav-link {{is_active('pricing')}}">الأسعار</a>
                            </div>
       
                        @guest	
                            <a href="{{route('login')}}" class="btn rounded-pill py-2 px-4 ms-3  d-lg-block login-button">تسجيل الدخول </a>
                        @else
                        <div class="navbar-nav ">
    
                            <ul class="navbar-nav header-navbar-rht">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" href="{{ route('home') }}" class="nav-link dropdown-toggle"  >
                                            {{ Auth::user()->name }}
                                        </a>
                                        
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('home') }}">{{ __('pages.dashboard') }}</a>
                                            <a class="dropdown-item"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" aria-expanded="false" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                {{ __('pages.Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        </div>
                                    </li>
                            </ul>
                        </div>
                        @endguest
                        </div>
                    </nav>
                </div>
    
          
            </div>

            @yield('content')
    
            <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
                <div class="container py-5 px-lg-5">
                    <div class="row g-5">
    
                        <div class="col-md-6 col-lg-6">
                            <p class="section-title text-white h5 mb-4">الروابط<span></span></p>
                            <a class="btn btn-link" href="/">الرئيسية</a>
                            <a class="btn btn-link" href="https://wa.me/+96599870752">تواصل معنا </a>
                            <a class="btn btn-link" href="{{route('demo')}}">ديمو</a>
                            <a class="btn btn-link" href="{{route('pricing.index')}}">الأسعار</a>
                            <a class="btn btn-link" href="{{route('terms')}}">الشروط والأحكام</a>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <p class="section-title text-white h5 mb-4">خدماتنا<span></span></p>
                            <div class="row g-2">
                                <a class="col-3" href="https://wa.me/+96599870752">
                                    <img class="img-fluid" src="{{ asset('assets/img/Picture1.png')}}" alt="Image">
                                </a>

                                <a class="col-3" href="{{route('demo')}}">
                                    <img class="img-fluid" src="{{ asset('assets/img/Picture2.png')}}" alt="Image">
                                </a>
                          
                                <a class="col-3" href="{{route('pricing.index')}}">
                                    <img class="img-fluid" src="{{ asset('assets/img/Picture3.png')}}" alt="Image">
                                </a>

                                <a class="col-3" href="{{route('login')}}">
                                    <img class="img-fluid" src="{{ asset('assets/img/Picture4.png')}}" alt="Image">
                                </a>
    
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-lg-4">
                            <p class="section-title text-white h5 mb-4">تواصل معنا<span></span></p>
                            <div class="position-relative w-100 mt-3">
                                <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="البريد الإلكتروني" style="height: 48px;">
                                <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="container px-lg-5">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                 <a class="border-bottom" href="#"> </a> جميع الحقوق محفوظة.. 
                                
                                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                تم تصميمه بواسطة  &copy; <a class="border-bottom" href="/">خريج</a>
                            </div>
                            <div class="col-md-6 text-center text-md-end">
                                <div class="footer-menu">
                                    <a href="/">الرئيسية</a>
                                    <a href="{{route('terms')}}">الشروط والأحكام</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js')}}"></script>

    <script src="{{ asset('admin_assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets\js\bootstrap.main.js') }}"></script>
    <script src="{{ asset('admin_assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('admin_assets\js\ajaxActions.js') }}"></script>
    <script src="{{ asset('admin_assets\js\sweetalert2.js') }}"></script>
    <script>

        $(".navbar-toggler").click(function(event) {
            if($('.navbar-toggler').attr('open') == 'open')
            {
                $(".navbar-collapse").addClass('hide');
                $('.navbar-toggler').removeAttr('open'); 
            }
            else 
            {
                $('.navbar-toggler').attr('open',true);
                $(".navbar-collapse").removeClass('hide');
            }
        });

        $(document).scroll(function(){
            var scrollTop = $("html").scrollTop();
            if(scrollTop > 150){
                $(".show-first").removeClass('d-none');
            }
            else
                $(".background2").fadeOut();
            })
    </script>
    @yield('js')
</body>

</html>