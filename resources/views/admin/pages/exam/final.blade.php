@extends('admin.layout.master')
@section('content')
<div class="main-wrapper" style="background: linear-gradient(to right, #d4f0fc, #ecf7ff);">
      <!-- QUIZ ONE -->
    <section class="section-1 question-card" id="section-1" style="margin-top: 20px; overflow-y: auto;">
        <main class="question-main">
            <div class="{{in_array($slice->first()->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'click active active-2 active-3' : 'click' }}" question_id="{{$slice->first()->id}}" style="float: left;">
                <span class="{{in_array($slice->first()->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'star ti ti-star test' : 'star ti ti-star' }}"></span>
                <div class="ring"></div>
                <div class="ring2"></div>
            </div>
            <div class="text-container">
                <h3>اختبار تجريبي {{$slice->first()->subject->name}}</h3>
                <p>السؤال {{ $page }} من {{ $total }}</p>
                @if($slice->first()->paragraph)<p class="test-paragraph" style="text-align: left; direction: ltr;" onmousedown="return false" onselectstart="return false">{!! nl2br($slice->first()->paragraph->title) !!}</p>@endif
                <p class="question" style="font-size: 24px;" onmousedown="return false" onselectstart="return false">{{$slice->first()->title}}</p>
            </div>
            <form>
                <div class="quiz-options">
                    @foreach($slice->first()->answers as $key => $answer)
                        <input type="radio" question_id="{{$slice->first()->id}}" answer_id="{{$answer->id}}" class="input-radio" number="one-{{$key}}" id="one-{{$key + 1}}" name="answer-{{$slice->first()->id}}" required>
                        <label class="radio-label" style="direction: ltr; text-align: left;" for="one-{{$key + 1}}" answer_id="{{$answer->id}}">
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
                    @if($slice->first()->notes)
                        <a href="#" class="d-none help-btn">
                            <i class="ti-help"></i>
                        </a>
                    @endif
                    @if($page < $total)
                        @php
                            $pageno = $page + 1; 
                        @endphp
                        <a id="btn" type="submit" href="final-exam?page={{ $pageno }}">التالي</a>
                    @else
                        <a id="btn" type="submit" href="{{route('total.result') . '?total_id=' . $slice->first()->subject_id}}">انهاء الاختبار</a>
                    @endif
                </div>
            </form>
        </main>
        <a 
            id="btn" 
            class="back-btn" 
            style="max-width: 150px !important; min-width: 150px !important;"
            href="#" onclick="report(this)"
            data-target="#report"
            data-toggle="modal"
            data-id="{{$slice->first()->id}}"
        >
            ابلاغ  
        </a>
    </section>
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
@endsection

@section('js')
<script>
    $('.click').click(function() {
        if ($('.star').hasClass("test")) {
                $('.click').removeClass('active')
            setTimeout(function() {
                $('.click').removeClass('active-2')
            }, 30)
                $('.click').removeClass('active-3')
            setTimeout(function() {
                $('.star').removeClass('test')
            }, 15)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: '{{ route("save.list") }}',
                method: 'post',
                data: {question_id: $(this).attr("question_id"), result: false},
                success: (data) => {}
            });
        } else {
            $('.click').addClass('active')
            $('.click').addClass('active-2')
            setTimeout(function() {
                $('.star').addClass('test')
            }, 150)
            setTimeout(function() {
                $('.click').addClass('active-3')
            }, 150)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: '{{ route("save.list") }}',
                method: 'post',
                data: {question_id: $(this).attr("question_id"), result: true},
                success: (data) => {}
            });
        }
    });

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
            url: '{{ route("total.data") }}',
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
        @if ($slice->first()->notes)
            <p class="text-center m-0"> {{ $slice->first()->notes }} </p>
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