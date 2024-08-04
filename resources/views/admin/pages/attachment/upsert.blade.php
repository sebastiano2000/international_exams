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
                                اضف مادة جديدة
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">
                                        المادة
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
                                <form method="post" enctype="multipart/form-data" action="{{ route('attachment.modify') }}"
                                    class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}"
                                    title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}"
                                    redirect="{{ route('attachment') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="@isset($attachment->id){{$attachment->id}}@endisset">
                                    <div class="col-md-12 ps-5">
                                        <label class="mb-2">اسم المرفق</label>
                                        <input class="form-control" type="text" name="name" placeholder="{{ __('pages.name') }}" value="@isset($attachment->id){{$attachment->name}}@endisset">
                                        <p class="error error_name"></p>
                                    </div>
                                    <div class="col-md-12 ps-5">
                                        <label class="mb-2">مذكرات </label>
                                        <input type="file" class="dropify" data-default-file="@if($attachment->picture){{ asset('/attachments/' . $attachment->picture->name) }}@endif" name="attachment"/>
                                        <p class="error error_picture"></p>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit"
                                            placeholder="submit">{{ __('pages.submit') }}</button>
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
    $('.dropify').dropify();
</script>
@endsection