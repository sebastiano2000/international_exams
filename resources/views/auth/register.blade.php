@extends('layouts.master')

@section('content')
<div class="  py-3 bg-primary hero-header">
    <div class="container my-5 py-5  register-container px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">تسجيل حساب جديد
                </h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
    </div>
</div>

<section class="container-xxl">
    <div class=" h-100">
        <div class=" d-flex align-items-center h-100">
            <div class="col-lg-12 col-xl-11 m-3">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-1 order-lg-1">

                                <p class="section-title text-secondary  mx-md-auto mt-4">تسجيل الدخول لبنك الأسئلة الموضوعية</p>

                                <form method="POST" action="{{ route('register.create')}}" onsubmit="validate()">
                                    @csrf
                                    <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="name">
                                            {{__('pages.Full name')}}
                                        </label>
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" required autocomplete="name">
                                    </div>

                                    <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="phone">
                                            {{__('pages.Phone')}}
                                        </label>
                                        <div class="input-group">
                                            <!-- <x-country-phone-code></x-country-phone-code> -->
                                            <input id="phone" type="text"
                                                class="form-control mr-2 @error('phone') is-invalid @enderror"
                                                style="width: 33% !important;"
                                                placeholder="رقم الهاتف" name=" phone" value="{{ old('phone') }}"
                                                required autocomplete="phone">
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="name">
                                            {{__('pages.Email Address')}}
                                        </label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                    </div>

                                    <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="name">
                                            اسم الجامعة
                                        </label>
                                        <input id="high" type="text" class="form-control" name="high"
                                            value="{{ old('high') }}" required autocomplete="high">
                                    </div>

                                    <!-- <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="password">
                                            كلمة المرور
                                        </label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline flex-fill mb-2">
                                        <label class="form-label" for="confirm-password">
                                            تأكيد كلمة المرور
                                        </label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div> -->
                                    <div class="skill mb-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="vehicle3" type="checkbox" type="checkbox"  id="vehicle3" name="vehicle3" >
                                                <label for="vehicle3"> الموافقه علي  <a href="{{route('terms')}}">  الشروط   والأحكام </a> </label><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button class="btn btn-primary py-sm-3 px-sm-5 form-control rounded-pill jus  btn-khareej disabled" type="submit">
                                            التسجيل بالدورة
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="{{ asset('assets/img/Sign up-cuate.png') }}"
                                    class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

<script>
    function validate() {
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var high = document.getElementById("high").value;
        var password = document.getElementById("password").value;
        var password_confirmation = document.getElementById("password-confirm").value;
        var name = document.getElementById("name").value;

        if (phone == "" || name == "" || high == "" || email == "") {
            event.preventDefault();
            alert("يجب ملئ جميع الحقول");
        }

        // if (password != password_confirmation) {
        //     event.preventDefault();
        //     alert("كلمة المرور غير متطابقة");
        // }

        if (isNaN(phone)) {
            event.preventDefault();
            alert("رقم الهاتف يجب أن يكون أرقام فقط");
        }
    }
    var chk1 = $("input[type='checkbox'][value='1']");

    $( document ).ready(function() {
    $('.vehicle3').val($(this).is(':checked'));

        $('.vehicle3').change(function() {
            if($(this).is(":checked")) {
                $('.btn-khareej').removeClass("disabled");
            }
            else {
                $('.btn-khareej').addClass("disabled");
            }
        });
    });


</script>

@endsection
