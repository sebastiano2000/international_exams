@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                @if(!Auth::user()->isAdmin())
                    <div class="row justify-content-center">
                        @foreach($attachments as $attachment)
                            @if($attachment->picture)
                                <div class="col-auto">
                                    <div class="container-tenant mb-4">
                                        <div class="">
                                            <h2>
                                                مرفق {{$attachment->name}}
                                            </h2>
                                            <video oncontextmenu="return false;" class='myVideo' id="myVideo" height='320px' controls controlsList="nodownload">
                                                <source src="{{ route('getVideo', ['attachment' => $attachment->id])  }}" type="video/mp4"> 
                                            </video>
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