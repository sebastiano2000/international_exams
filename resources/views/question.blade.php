@extends('layouts.master')

@section('content')

<div class=" bg-primary hero-header">
    <div class=" container-xxl px-lg-5">
        <div class="col-12 text-center">
            <h1 class="text-white animated slideInDown">DEMO   </h1>
            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
    </div>
</div>

<div class="container-xxl">
    <div class=" py-3 px-lg-5 card shadow" style="border-radius: 25px;">
        <div class=" py-5 px-lg-5">
            <div class="row row-cols-2 justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('exam.try', ['subject_id' => $subjects->first()->id]) }}">
                        <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/vocab-demo.svg'); width: 411px; height: 411px;"></div>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('exam.try', ['subject_id' => $subjects->get(1)->id]) }}">
                        <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/grammar-demo.svg'); width: 411px; height: 411px;"></div>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('exam.try', ['subject_id' => $subjects->last()->id]) }}">
                        <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/reading-demo.svg'); width: 411px; height: 411px;"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
