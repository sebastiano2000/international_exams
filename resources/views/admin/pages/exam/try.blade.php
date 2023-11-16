@extends('layouts.master')
@section('css')
@endsection
<link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">
<style>
    .footer {
    position: static !important;
    }
    @media (max-width: 991.98px) {
        .hero-header {
            padding: 3rem 0 !important;
        }
    }
</style>
@section('content')

<div class=" bg-primary hero-header">

</div>
<div class="container-xxl">
    <div class=" py-5 px-lg-5">
        <div class="">
            <div class="container" style="">
                <!-- QUIZ ONE -->
                <div class="section-1 question-card" id="section-1" style="margin-top: 20px; overflow-y: auto;">
                    <div class="question-main">

                        <div class="text-container">
                            <h3 class="exam-title"><p @if($slice->paragraph)style="font-size: 18px;" @endif>{{$slice->subject->name}}</p>Demo</h3>
                            <p>السؤال {{ $page }} من {{ $total }}</p>
                            @if($slice->paragraph)<p class="question" style="text-align: left; direction: ltr;" style="font-size: 22px;" onmousedown="return false" onselectstart="return false">{!! nl2br($slice->paragraph->title) !!}</p>@endif
                            <p class="question" style="font-size: 24px;" onmousedown="return false" onselectstart="return false">{{$slice->title}}</p>
                        </div>
                        <form>
                            <div class="quiz-options">
                                @foreach($slice->answers as $key => $answer)
                                    <input type="radio" question_id="{{$slice->id}}" answer_id="{{$answer->id}}" class="input-radio" number="one-{{$key}}" id="one-{{$key + 1}}" name="answer-{{$slice->id}}" required>
                                    <label class="radio-label" style="direction: ltr; text-align: left; display:inline-flex;" for="one-{{$key + 1}}" answer_id="{{$answer->id}}">
                                        <span class="alphabet">
                                            @if($key == 0)
                                                A
                                            @elseif($key == 1)
                                                B
                                            @elseif($key == 2)
                                                C
                                            @elseif($key == 3)
                                                D
                                            @endif
                                        </span> {{ $answer->title }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="d-none hint-note" 
                                    style="background: #fff;
                                    padding: 20px;
                                    border-radius: 10px;
                                    margin-bottom: 35px;
                                    box-shadow: 0px 0px 10px #ccc;
                                    font-size: 18px;">
                            </div>
                            <div class="d-flex">
                                @if($slice->notes)
                                    <a href="#" class="d-none help-btn">
                                        <i class="ti-help"></i>
                                    </a>
                                @endif
                                @if($page < $total)
                                    @php
                                        $pageno = $page + 1; 
                                    @endphp
                                    <a id="btn" type="submit" href="try?subject_id={{$slice->subject_id}}&page={{ $pageno }}">التالي</a>
                                @else
                                    @if(Auth::user())
                                        <a id="btn" type="submit" href="{{route('home')}}">انهاء الاختبار</a>

                                    @else
                                        <a id="btn" type="submit" href="{{route('success')}}">انهاء الاختبار</a>

                                    @endif
                                @endif
                            </div>
                        </form>
                    </div>
                    <a 
                        id="btn" 
                        class="back-btn" 
                        style="max-width: 150px !important; min-width: 150px !important;"
                        href="#" onclick="report(this)"
                        data-target="#report"
                        data-toggle="modal"
                        data-id="{{$slice->id}}"
                    >
                        ابلاغ  
                    </a>
                </div>
                <div id="report" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modelHeading">ابلاغ خطاء في السؤال</h4>
                                <span class="button" data-dismiss="modal" aria-label="Close">   <i class="ti-close"></i> </span>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" action="{{ route('report.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}">
                                    @csrf
                                    <input type="hidden" name="question_id" id="question_id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">{{ __('pages.note') }}</label>
                                        <div class="col-sm-12">
                                            <textarea type="text" class="form-control" id="notes" name="notes" placeholder="{{ __('pages.note') }}" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">{{ __('pages.submit') }}
                                        </button>
                                    </div>
                                </form>
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
<script>
    // $('.click').click(function() {
    //     if ($('.star').hasClass("test")) {
    //             $('.click').removeClass('active')
    //         setTimeout(function() {
    //             $('.click').removeClass('active-2')
    //         }, 30)
    //             $('.click').removeClass('active-3')
    //         setTimeout(function() {
    //             $('.star').removeClass('test')
    //         }, 15)

    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': '{{csrf_token()}}'
    //             },
    //             url: '{{ route("save.list") }}',
    //             method: 'post',
    //             data: {question_id: $(this).attr("question_id"), result: false},
    //             success: (data) => {}
    //         });
    //     } else {
    //         $('.click').addClass('active')
    //         $('.click').addClass('active-2')
    //         setTimeout(function() {
    //             $('.star').addClass('test')
    //         }, 150)
    //         setTimeout(function() {
    //             $('.click').addClass('active-3')
    //         }, 150)

    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': '{{csrf_token()}}'
    //             },
    //             url: '{{ route("save.list") }}',
    //             method: 'post',
    //             data: {question_id: $(this).attr("question_id"), result: true},
    //             success: (data) => {}
    //         });
    //     }
    // });

    function report(el) {
        var link = $(el)
        var modal = $("#report")
        var question_id = link.data('id')

        modal.find('#question_id').val(question_id);
    }

    $('.input-radio').on('change', function(){
        let number = 0;
        for(let label of document.querySelectorAll("label")){
            label.classList.remove('active')
        }

        if($(this).attr('number').split('one-')[1] == '1'){
            number = $(this).attr('number').split('one-')[1] - 1 + 2;
        }
        else if($(this).attr('number').split('one-')[1] == '2'){
            number = $(this).attr('number').split('one-')[1] - 1 + 3;
        }
        else if($(this).attr('number').split('one-')[1] == '3'){
            number = $(this).attr('number').split('one-')[1] - 1 + 4;
        }

        $(this).siblings().eq(number).addClass('active');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: '{{ route("save.data") }}',
            method: 'post',
            data: {question_id: $(this).attr("question_id"), answer_id: $(this).attr('answer_id')},
            success: (data) => {
                for(let label of document.querySelectorAll("label")){
                    label.classList.remove('false_input')
                }
                $('.help-btn').removeClass('d-none')
                $(`.radio-label`).addClass('false_input')
                $(`.radio-label[answer_id='${data}']`).removeClass('false_input').addClass('true_input')
            }
        });
    });

    $('.help-btn').click(function(){

        $('.hint-note').html(`
        @if ($slice->notes)
            <p class="text-center m-0"> {{ $slice->notes }} </p>
        @endif
        `)

        $('.hint-note').toggleClass('d-none')
    })

    $(document).ready(function(){
        if(/[A-Za-z]/.test($('.question').text())){
            $('.question').css({ direction: 'ltr' });
        }
    });
</script>
@endsection