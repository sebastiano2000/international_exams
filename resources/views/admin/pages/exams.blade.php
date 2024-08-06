@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                    <div class="row justify-content-center">
                        @foreach($subjects as $subject)
                            <div class="col-auto">
                                <a @if(Auth::user()->suspend) href="{{ route('exam.test', ['subject_id' => $subject->id]) }}" @else href="{{ route('pricing.index') }}" @endif>
                                    <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/review.svg'); width: 411px; height: 411px;">
                                        <h1 style="font-size: 24px; margin-top: -320px;">
                                            {{$subject->name}} <br> 
                                        </h1>
                                    </div>
                                </a>
                            </div>
                        @endforeach
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