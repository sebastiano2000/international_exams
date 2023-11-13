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

<section class="">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-lg-7 col-xl-7">
                <div class="card text-black shadow" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <form class="form-horizontal form-material" method="POST"
                            action="{{ route('forget-password.change-password.store') }}">
                            @csrf


                            <input type="hidden" name="phone" value="{{ $phone }}">
                            <h3 class="text-center m-b-20">إعادة تعيين كلمة المرور</h3>
                            <div class="form-group">
                                <input type="password" class="form-control mb-3" name="password"
                                    placeholder="كلمة المرور" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="تأكيد كلمة المرور" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-lg btn-info btn-rounded">إعادة
                                    تعيين كلمة
                                    المرور</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection