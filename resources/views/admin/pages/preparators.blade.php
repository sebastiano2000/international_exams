@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                    <div class="row justify-content-center">
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