@extends('layouts.master')

@section('content')

<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="row justify-content-center">
                        <div class="container" style="margin: 200px 0 200px 0;">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="payment">
                                        <div class="payment_header">
                                            <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                                        </div>
                                        <div class="content text-center">
                                            <h2 class="text-success">تم الدفع بنجاح </h2>
                                            <h1 class="text-dark thanks_div">
                                                شكرا للاشتراك في خريج
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            window.location.href = "{{ route('home') }}";
        }, 3000);
    });
</script>
@endsection