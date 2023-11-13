@extends('layouts.master')
@section('css')
@endsection

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
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column align-items-center">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                تم تسجيل حسابك بنجاح
                            </p>

                            <a href="{{route('login')}}" class="btn btn-primary">
                                تسجيل الدخول
                            </a>

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
</script>

@endsection