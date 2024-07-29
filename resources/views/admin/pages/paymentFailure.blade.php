@extends('layouts.master')

@section('content')

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
                                            <div class="payment_header payment_header1 ">
                                                <div class="check"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
                                            </div>
                                            <div class="content text-center">
                                                <h2 class="text-danger"> لقد حدث خطأ في عملية الدفع</h1>
                                                <h1 class="text-dark">يرجى المحاولة مرة أخرى </h2>
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
            window.setTimeout(function () {
                location.href = "{{ route('home') }}";
            }, 3000);
        });
    </script>
@endsection