@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="content container-fluid">
                <!-- Page Header -->

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">
                                اضف مرفق جديد
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">
                                    المرفق
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body custom-edit-service p-3">
                                <!-- Add Blog -->
                                <!--<form method="post" enctype="multipart/form-data" action="{{ route('attachment.modify') }}"-->
                                    <!--class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}"-->
                                    <!--title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}"-->
                                    <!--redirect="{{ route('attachment') }}">-->
                                    <!--@csrf-->
                                    <input type="hidden" name="id" value="@isset($attachment->id){{$attachment->id}}@endisset">
                                    <div class="col-md-12 ps-5">
                                        <label class="mb-2">اسم المرفق</label>
                                        <input class="form-control name" id="name" type="text" name="name" placeholder="{{ __('pages.name') }}" value="@isset($attachment->id){{$attachment->name}}@endisset">
                                        <p class="error error_name"></p>
                                    </div>
                                    <div class="col-md-12 ps-5">
                                        <!--<label class="mb-2">مذكرات </label>-->
                                        <!--<input type="file" class="dropify" data-default-file="@if($attachment->picture){{ asset('/attachments/' . $attachment->picture->name) }}@endif" name="attachment"/>-->
                                        <!--<p class="error error_picture"></p>-->
                                        <div class="card-body">
                                            <div id="upload-container" class="text-center">
                                                <button id="browseFile" disabled class="btn btn-primary ">Browse File</button>
                                            </div>
                                            <div  style="display: none" class="progress mt-3" style="height: 25px">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                            </div>
                                        </div>
                                        <div class="card-footer p-4" style="display: none">
                                            <video id="videoPreview" src="" controls style="width: 100%; height: auto" name="attachment"></video>
                                        </div>
                                    </div>
                                    <!--<div class="submit-section">-->
                                    <!--    <button class="btn btn-primary submit-btn" type="submit" name="form_submit"-->
                                    <!--        placeholder="submit">{{ __('pages.submit') }}</button>-->
                                    <!--</div>-->
                                <!--</form>-->
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
    $('.dropify').dropify();
</script>
<script type="text/javascript">
    $('.name').on('input', function(){
        if($('.name').val().length > 0) {
            $('#browseFile').prop("disabled", false);
        } else {
            $('#browseFile').prop("disabled", true);
        }
    });
        
    let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: '{{ route('attachment.modify') }}',
        query: function() {
            return {
                _token: '{{ csrf_token() }}',
                name: document.getElementById('name').value
            };
        },
        fileType: ['mp4', 'mov'],
        chunkSize: 10*1024*1024,
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        // $('#videoPreview').attr('src', response.path);
        // $('.card-footer').show();
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: 'success',
            title: '{{ __("pages.your_file_has_been_deleted") }}',
        });
        
        setTimeout(function(){
            window.location.href = 'https://inv.khereej.org/admin/attachment';
		}, 3000);
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert('file uploading error.')
    });

    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
</script>
@endsection