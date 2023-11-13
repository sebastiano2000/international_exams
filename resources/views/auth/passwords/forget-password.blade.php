@extends('layouts.master')
@section('content')

<div class=" py-5 bg-primary hero-header">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated slideInDown">إعادة تعيين كلمة المرور </h1>
                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                <nav aria-label="breadcrumb">

                </nav>
            </div>
        </div>
    </div>
</div>
<section class="vh-100">
    <div class="container ">
        <div class="card text-black shadow" style="border-radius: 25px;">  
        <div class=" card-body  row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 col-xl-6">
                    <div class=" p-3">
                        <form method="POST" action="{{ route('forget-password.check') }}">
                            @csrf
                            <div class="form-outline flex-fill mb-4">
                                <label class="form-label" for="phone">
                                    {{__('pages.Phone')}}
                                </label>
                                <div class="input-group">
                                    <x-country-phone-code></x-country-phone-code>
                                    <input style="width: 50%;" id="phone" type="text"
                                        class="form-control mr-2 @error('phone') is-invalid @enderror"
                                        placeholder="رقم الهاتف" name=" phone" value="{{ old('phone') }}" required
                                        autocomplete="phone">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        بدء إعادة تعيين كلمة المرور
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="{{ asset('assets/img/Mobile login-pana.svg') }}">
            </div>
        </div>
    </div>
</section>

@endsection