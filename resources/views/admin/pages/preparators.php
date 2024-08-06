@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <!-- @if(!Auth::user()->suspend)
                    <div class="row row-cols-2 justify-content-center"> 
                        <div class="col-auto mt-30">
                            <a href="{{ route('exam.try', ['subject_id' => $subjects->first()->id]) }}">
                                <div class="container-tenant mb-4" style=" width: 411px; height: 411px;">
                                    <img src="{{ asset('admin_assets/images/vocab-demo.jpg') }}" alt="homepage" class="imgage-fluid" style="height: 100%;width:100%; " /> 
                                    <div class="card-footer bg-primary w-100 text-white ">DEMO</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto mt-30">
                            <a href="{{ route('exam.try', ['subject_id' => $subjects->get(1)->id]) }}">
                                <div class="container-tenant mb-4" style=" width: 411px; height: 411px;">
                                    <img src="{{ asset('admin_assets/images/grammar-demo.jpg') }}" alt="homepage" class="imgage-fluid" style="height: 100%;width:100%;" /> 
                                    <div class="card-footer bg-primary w-100 text-white ">DEMO</div>
                                </div>                            
                            </a>
                        </div>
                        <div class="col-auto mt-30">
                            <a href="{{ route('exam.try', ['subject_id' => $subjects->last()->id]) }}">
                                <div class="container-tenant mb-4" style=" width: 411px; height: 411px;">
                                    <img src="{{ asset('admin_assets/images/reading-demo.jpg') }}" alt="homepage" class="imgage-fluid" style="height: 100%;width:100%;" /> 
                                    <div class="card-footer bg-primary w-100 text-white ">DEMO </div>
                                </div>                             
                            </a>
                        </div>
                    </div>
                @endif -->
                @if(!Auth::user()->isAdmin())
                    <div class="row justify-content-center">
                        <!-- <div class="col-auto">
                            <a @if(Auth::user()->suspend) href="{{ route('exam.final') }}" @else href="{{ route('pricing.index') }}" @endif>
                                <div class="container-tenant mb-4" style="background-image: url('/admin_assets/images/final.svg'); width: 411px; height: 411px;"></div>
                            </a>
                        </div> -->
                        @foreach($preparators as $preparator)
                            @if($preparator->picture)
                                <div class="col-auto">
                                    <div class="container-tenant mb-4">
                                        <div class="">
                                            <h2>
                                                مذكرات {{$preparator->name}}
                                            </h2>
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