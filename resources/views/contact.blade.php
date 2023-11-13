@extends('layouts.master')

@section('content')
<div class=" py-5 bg-primary hero-header">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">تواصل معنا  </h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-3">
    <div class="container py-3 px-lg-5 card shadow" style="border-radius: 25px;">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center"><span></span>تواصل معنا <span></span></p>
            <h1 class="text-center mb-5">تواصل معنا  للحصول على أي استفسار</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <form method="post" enctype="multipart/form-data" action="{{ route('contact.modify') }}"class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}"title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}">
                         @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input  name="name" type="text" class="form-control mt-3" id="name" placeholder="Your Name">
                                    <label for="name">الإسم</label>
                                    <p class="error error_name"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="email" type="email" class="form-control mt-3" id="email" placeholder="Your Email">
                                    <label for="email">البريد الإلكتروني</label>
                                    <p class="error error_email"></p>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-floating">
                                    <input name="phone" type="phone" class="form-control" id="phone" placeholder="phone">
                                    <label for="subject">رقم الجوال </label>
                                    <p class="error error_phone"></p>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-floating">
                                    <textarea name="message" class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                    <label for="message">محتوي الرساله</label>
                                    <p class="error error_message"></p>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-primary w-100 py-3" type="submit">إرسال</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <img  style="height: 450px"  class="img-fluid  wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/img/Contact us-bro.png') }}">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection