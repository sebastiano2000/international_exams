@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin() && Auth::user()->suspend)
                    <div class="row justify-content-center">
                        @foreach($subjects as $subject)
                            <div class="col-md-auto">
                                <a href="{{ route('exam.test', ['subject_id' => $subject->id]) }}">
                                    <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/review.svg'); width: 411px; height: 411px;">
                                        <h1 style="font-size: 24px; margin-top: -320px;">
                                            {{$subject->name}} <br> REVIEW 
                                        </h1>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-auto">
                                <a href="{{ route('exam', ['subject_id' => $subject->id]) }}">
                                    <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/test.svg'); width: 411px; height: 411px;">
                                        <h1 style="font-size: 24px; margin-top: -320px;">
                                            {{$subject->name}} <br> PRACTICE TEST 
                                        </h1>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="col-md-auto">
                            <a href="{{ route('exam.final') }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/final.svg'); width: 411px; height: 411px;"></div>
                            </a>
                        </div>
                        @foreach($preparators as $preparator)
                            @if($preparator->picture)
                                <div class="col-xl-5 col-8">
                                    <div class="container-tenant mb-4">
                                        <div class="wrapper-tenant">
                                            <h1>
                                                مذكرات {{$preparator->name}}
                                            </h1>
                                            <div class="button-wrapper">
                                                <a href="{{ asset('/preparators/'.$preparator->picture->name) }}" target="_blank"
                                                    class="btn-tenant fill-tenant">إبدأ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="row row-cols-2 justify-content-center">
                        <div class="col-md-auto">
                            <a href="{{ route('exam.try', ['subject_id' => 1]) }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/vocab-demo.svg'); width: 411px; height: 411px;"></div>
                            </a>
                        </div>
                        <div class="col-md-auto">
                            <a href="{{ route('exam.try', ['subject_id' => 2]) }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/grammar-demo.svg'); width: 411px; height: 411px;"></div>
                            </a>
                        </div>
                        <div class="col-md-auto">
                            <a href="{{ route('exam.try', ['subject_id' => 3]) }}">
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/reading-demo.svg'); width: 411px; height: 411px;"></div>
                            </a>
                        </div>
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