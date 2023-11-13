@extends('layouts.master')

@section('content')
<div class=" bg-primary hero-header">
    <div class=" container px-lg-5">
        <div class="row g-5 align-items-end">
            <div class="col-lg-6 text-center text-lg-start">
                <h3 class="text-white pb-3 animated slideInDown">ثبت معلوماتك و استعد لاختباراتك مع اختبارات خريج الذكية المبنية على اختبارات سابقة و تعالج نقاط ضعفك      </h1>
                <p class="text-white mb-4 animated slideInDown">كل اللي تحتاجه
                    للتفوق بمكان واحد</p>
                <a href="{{route('login')}}" class="btn btn-secondary py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft">التسجيل والاشتراك</a>
                <a href="{{route('contact')}}" class="btn btn-light py-sm-3 px-sm-5 rounded-pill animated slideInRight">تواصل معنا</a>
            </div>
            <div class="col-lg-6 text-center text-lg-start">
                <img class="img-fluid animated zoomIn" src="{{ asset('assets/img/hero.png')}}" alt="">
            </div>
        </div>
    </div>
</div>

<div class=" ">
    <div class=" py-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5"></h1>
                <div class="skill mb-4">
                    <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/img/about.png')}}">

                </div>
                <a href="{{route('login')}}" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3">التسجيل والاشتراك</a>
            <div class="col-lg-6">
            </div>
        </div>
    </div>
</div>
<div class="container-xxl ">
    <div class="container  px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center"><span></span>خدماتنا<span></span></p>
        </div>
        <div class="container  py-3">
            <div class=" py-5 px-lg-5">
                <div class="row g-4">
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <a  href="https://wa.me/+96599870752" >
                            <div class="feature-item bg-light rounded text-center p-4">
                                <h5 class="mb-3">التواصل معنا</h5>
                                <img class="img-fluid" src="{{ asset('assets/img/Picture1.png')}}" alt="Image">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <a href="{{route('register')}}">
                            <div class="feature-item bg-light rounded text-center p-4">
                                <h5 class="mb-3">تجربة النظام Demo  </h5>
                                <img class="img-fluid" src="{{ asset('assets/img/Picture2.png')}}" alt="Image">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                        <a href="{{route('pricing.index')}}">
                            <div class="feature-item bg-light rounded text-center p-4">
                                <h5 class="mb-3">الأسعار</h5>
                                <img class="img-fluid" src="{{ asset('assets/img/Picture3.png')}}" alt="Image">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                        <a href="{{route('login')}}">
                            <div class="feature-item bg-light rounded text-center p-4">
                                <h5 class="mb-3">التسجيل والاشتراك  </h5>
                                <img class="img-fluid" src="{{ asset('assets/img/Picture4.png')}}" alt="Image">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-3">
    <div class="container py-3 px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center"><span></span>تواصل معنا <span></span></p>
            <h1 class="text-center mb-5">تواصل معنا  للحصول على أي استفسار</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
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
        </div>
    </div>
</div>
@endsection
