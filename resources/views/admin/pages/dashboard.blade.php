@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <a href="{{ route('exams') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/review.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        المواد <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('attachments') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/review.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        المرفقات <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('preparators') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/review.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        المحضرين <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->isAdmin())
                    <div class="container_dashboard col-md-3">
                        <a href="{{ route('financial_transaction') }}">
                            <div class="card row">
                                <div class="card-count-container">
                                    <div class="card-count">{{$financial}}</div>
                                </div>
                                
                                <div class="card-content">
                                    <h4>عدد عمليات الدفع</h4>
                                </div>

                            </div>
                        </a>
                    </div>
                @endif
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
<script>
</script>
@endsection