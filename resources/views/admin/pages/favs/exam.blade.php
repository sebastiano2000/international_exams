@extends('admin.layout.master')
@section('content')
<div class="main-wrapper" style="background: linear-gradient(to right, #d4f0fc, #ecf7ff);">
      <!-- QUIZ ONE -->
    <section class="section-1 question-card" id="section-1" style="margin-top: 20px;">
        <main class="question-main">
            <div class="{{in_array($slice->first()->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'click active active-2 active-3' : 'click' }}" question_id="{{$slice->first()->id}}" style="float: left;">
                <span class="{{in_array($slice->first()->id, Auth::user()->list->pluck('question_id')->toArray()) ? 'star ti ti-star test' : 'star ti ti-star' }}"></span>
                <div class="ring"></div>
                <div class="ring2"></div>
            </div>
            <div class="text-container">
                <h3>اختبار للأسئلة المفضلة</h3>
                @if($slice->first()->paragraph)<p class="test-paragraph" style="text-align: left; direction: ltr;" onmousedown="return false" onselectstart="return false">{!! nl2br($slice->first()->paragraph->title) !!}</p>@endif
                <p style="font-size: 24px;" onmousedown="return false" onselectstart="return false">{{$slice->first()->title}}</p>
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
                <div class="d-flex">
                    <a id="btn" type="submit" href="{{route('question.fav')}}">انهاء الاختبار</a>
                </div>
            </form>
        </main>
    </section>
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
    })

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
            url: '{{ route("save.test") }}',
            method: 'post',
            data: {question_id: $(this).attr("question_id"), answer_id: $(this).attr('answer_id')},
            success: (data) => {
                for(let label of document.querySelectorAll("label")){
                    label.classList.remove('false_input')
                }

                $(`.radio-label`).addClass('false_input')
                $(`.radio-label[answer_id='${data}']`).removeClass('false_input').addClass('true_input')
            }
        });
    });
</script>
@endsection