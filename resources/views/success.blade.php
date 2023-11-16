@extends('layouts.master')

@section('content')
<div class=" py-5 bg-primary hero-header">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">نشكركم علي تجربة النظام    </h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-3">
    <div class="container py-3 px-lg-5 card shadow" style="border-radius: 25px;">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center">
                        <img  style="margin:auto"  class="img-fluid  wow zoomIn justify-content-center text-center" data-wow-delay="0.5s" src="{{ asset('assets/img/success.png') }}">
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="text-center mb-5">بانتظارك   <span class="text-primary"> آلاف </span> الأسئلة الجديدة  
                            <br>
                            <a class="color-black" href="{{route('register')}}">
                                سجّل معنا الاّن
                            </a>      
                        </h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection