@extends('layouts.master')

@section('content')
<div class="  bg-primary hero-header">
    <div class="container my-5  px-lg-5">
        <div class="row g-5 ">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">تسجيل الدخول</h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl ">
    <div class="container px-lg-5">
        <div class="card text-black shadow" style="border-radius: 25px;">
            <div class=" card-body row g-5 align-items-center">
                
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="POST">
                        @csrf
                        <p class="section-title text-secondary">تسجيل الدخول لبنك الأسئلة <span></span></p>
                        <div class="skill mb-4">
                            @if (session('message'))
                                <div class="alert alert-danger">{{ session('message') }}</div>
                            @endif
                            @error('session')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <input class="form-control col-12" type="text" required="" placeholder="رقم الهاتف" name="phone">
                            </div>
                            @error('phone')
                            <div class="col-12 mb-4 mt-2 ">
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                            @enderror
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                    <input class="form-control" type="password" required="" placeholder="كلمة السر"
                                        name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="skill mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center justify-content-between">
                                        <a href="{{ route('forget-password.reset') }}" class="text-muted">
                                            نسيت كلمة السر؟
                                        </a>
                                        <a href="{{ route('register') }}" class="text-muted">
                                          إنشاء حساب جديد 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <button class="btn btn-primary py-sm-3 px-sm-5 form-control rounded-pill jus  btn-khareej" type="submit">تسجيل
                            الدخول</button>
                    </form>
                        <a class=" text-center " href="https://wa.me/+96596615789">
                            <h2 class="my-4">
                                <span class="mt-4">
                                تواصل معنا 
                                </span>
                                <img style="margin-top: -7px;" src="{{ asset('admin_assets/images/whatsapp.png') }}" alt="whatsapp" width="40px">
                            </h1>
                        </a>
                </div>  
                <div class="col-lg-6">
                    <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/img/Mobile login-pana.svg') }}">
                </div>
            </div>

        </div>
    </div>
</div>
{{-- <section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100 flex-column">
            <div class=" col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                        @endif
                        @error('session')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}"
                            method="POST">
                            @csrf

                            <h3 class="text-center m-b-20">تسجيل الدخول لبنك الأسئلة الموضوعية </h3>
                            <div class="form-group">
                                <input class="form-control" type="text" required="" placeholder="رقم الهاتف"
                                    name="phone">
                                @error('phone')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" required="" placeholder="كلمة السر"
                                    name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <div class="form-group text-center">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">تسجيل
                                    الدخول</button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center justify-content-between">
                                    <a href="{{ route('forget-password.reset') }}" class="text-muted">
                                        نسيت كلمة السر؟
                                    </a>
                                    <a href="{{ route('register') }}" class="text-muted">
                                        ليس لديك حساب؟
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="https://wa.me/+96596615789">
                    <h2 style="text-">
                        WhatsApp
                        <img src="{{ asset('admin_assets/images/whatsapp.png') }}" alt="whatsapp" width="40px">
                    </h1>
                </a>
            </div>
        </div>
    </div>
</section> --}}
@endsection


@section('js')

<script>

</script>
@endsection