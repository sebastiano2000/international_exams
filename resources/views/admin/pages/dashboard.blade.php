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
                                        بنك الأسئلة <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('attachments') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/video.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        تسجيل المحاضرات <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('preparators') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/note.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        مذكرات المحاضرين <br> 
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a 
                                href="#" 
                                onclick="send_question(this)" 
                                data-target="#send_question" 
                                data-toggle="modal"
                            >
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/note.svg'); width: 411px; height: 411px;">
                                    <h1 style="font-size: 24px; margin-top: -320px;">
                                        وجّه سؤالك<br> 
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
        <div id="send_question" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading">وجّه سؤالك</h4>
                        <span class="button" data-dismiss="modal" aria-label="Close"><i class="ti-close"></i></span>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('ask.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('home') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">السؤال</label>
                                <div class="col-sm-12">
                                    <textarea type="text" class="form-control" id="question" name="question" placeholder="السؤال" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">ارسال السؤال
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
@endsection

@section('js')
<script>
    function send_question(el) {
        var link = $(el);
        var modal = $("#send_question");
    }
</script>
@endsection