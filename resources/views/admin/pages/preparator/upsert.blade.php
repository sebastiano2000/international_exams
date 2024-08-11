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
                            <h3 class="page-title">اضف محضر </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">محضرين</a></li>
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
                                <form method="post" enctype="multipart/form-data" action="{{ route('preparator.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('preparator') }}">
                                    @csrf
                                    <div class="service-fields mb-3">
                                        <div class="form-group">
                                            <div class="row file-container">
                                                <div class="col-md-12 ps-5">
                                                    <label class="mb-2">اسم المحضر</label>
                                                    <input class="form-control" type="text" name="name" placeholder="{{ __('pages.name') }}" value="@isset($preparator->id){{$preparator->name}}@endisset">
                                                    <p class="error error_name"></p>
                                                </div>
                                                
                                                <div class="col-md-12 ps-5">
                                                    <label class="mb-2">مذكرات </label>
                                                    @forelse($preparator->picture as $picture)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="file" class="dropify" data-default-file="{{ asset('/preparators/'.$picture->name) }}" name="picture[]" />
                                                                <input type="hidden" class="old_image" name="old_picture[]" value="{{ $picture->name }}">
                                                                <p class="error error_picture"></p>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="file" class="dropify" data-default-file="" name="picture[]" />
                                                                <p class="error error_picture"></p>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @isset($preparator->id)
                                        <input type="hidden" value="{{$preparator->id}}" name="id">
                                    @endisset
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit" placeholder="submit">{{ __('pages.submit') }}</button>
                                    </div>
                                </form>
                                <!-- /Add Blog -->
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

    $(document).on("click", ".dropify-clear", function() {
        $(this).parent().siblings().eq(0).val(null);
    });

    $(document).on('change', '.dropify', function() {
        $('.file-container').append(`<div class="col-md-12 ps-5">
            <input type="file" class="dropify" data-default-file="" name="picture[]"/>
            <p class="error error_picture"></p>
        </div>`);

        $('.dropify').dropify()
    });
</script>
@endsection