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
                                                <a href="#" class="btn-tenant fill-tenant">إبدأ</a>
                                                @foreach($preparator->picture as $picture)
                                                    <input hidden value="{{ asset('/preparators/'.$picture->name)}}" class="preparator-files" />
                                                @endforeach
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
    $(document).on('click', '.fill-tenant', function() {
        let preparator_files = $(this).siblings('.preparator-files');
        let files = [];
        preparator_files.each(function() {
            files.push($(this).val());
        });
        let i = 0;
        let interval = setInterval(() => {
            if(i < files.length) {
                window.open(files[i]);
                i++;
            } else {
                clearInterval(interval);
            }
        }, 0);
    });
</script>
@endsection