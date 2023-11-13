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
     
                            
                           @if(isset($price->name)&&$price->name!=null)
                            <h3 class="page-title">
                            تعديل الباقة                           
                                </h3>
                           @else
                           <h3 class="page-title">
اضف باقة جديدة
                        </h3>
                        @endif
                           

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:(0);">
                                        الباقة
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
                                <form method="post" enctype="multipart/form-data" action="{{ route('prices.modify') }}"
                                    class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}"
                                    title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}"
                                    redirect="{{ route('prices') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="@isset($price->id){{$price->id}}@endisset">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-2">
                                                اسم الباقة
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="{{ __('pages.name') }}"
                                                value="@isset($price->id){{$price->name}}@endisset">
                                            <p class="error error_name"></p>
                                        </div>
    
                                        <div class="col-md-6">
                                            <label class="mb-2">
                                                سعر الباقة
                                            </label>
                                            <input class="form-control" type="number" name="price"
                                                placeholder="سعر الباقة"
                                                value="@isset($price->id){{$price->price}}@endisset">
                                            <p class="error error_name"></p>
                                        </div>
                                    </div>

                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit"
                                            placeholder="submit">{{ __('pages.submit') }}</button>
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

</script>
@endsection