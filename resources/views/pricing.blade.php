@extends('layouts.master')
<style>
    @media (max-width: 991.98px) {
        .hero-header {
            padding: 3rem 0 !important;
        }
    }
</style>
@section('content')
<div class=" bg-primary hero-header">

</div>


<div class="container-xxl ">
    <div class="container  px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
        </div>

        <div id="pricing" class="pricing-tables">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="section-heading">
                            <h5 class="section-title text-secondary justify-content-center"><span></span>قائمه الأسعار <span></span></h5>
                        </div>
                    </div>
                    @foreach($prices as $key => $price)
                        <div class="col-lg-4 mb-4">
                            <div @if(count($prices) == 1 || $key == 1) class="pricing-item-pro" @else class="pricing-item-regular" @endif>
                                <span class="price"> {{ $price->price }} د ك</span>
                                <h4>{{ $price->name }}</h4>
                                <div class="icon">
                                    <img src="{{ asset('assets/img/pricing-table-01.png')}}" alt="">
                                </div>
                                <div class="border-button">
                                    <a href="{{route('register')}}" 
                                        @if(Auth::user())
                                            onclick="payment(this)" 
                                            data-target="#payment" 
                                            data-toggle="modal" 
                                            data-id="{{$price->id}}" 
                                            data-user_id="{{Auth::user()->id}}"
                                        @endif
                                    >اشترك الان</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div id="payment" class="modal fade">   
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">الملاحظات</h4>
                <span class="button" data-dismiss="modal" aria-label="Close"><i class="bi-x-square"></i> </span>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}">
                    @csrf
                    <input type="hidden" name="package_number" id="id">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label class="mb-2">
                            سيتمكن كل متدرب من الدخول للنظام عن طريق متصفحين اثنين (أو جهازين) كحد أقصى
                            لا يسمح بمشاركة الحساب الخاص بك مع أي شخص آخر
                            استخدام الـ VPN سيؤدي لاحتساب أكثر من جهاز عند الدخول
                            آخر يوم لصلاحية الاشتراك هو يوم السبت الموافق 1 يونيو 2024
                        </label>
                    </div>
                    <div class="col-sm-offset-2 col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">موافق
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>


@endsection

@section('js')
<script>
    function payment(el) {
        var link = $(el);
        var modal = $("#payment");
        var id = link.data('id');
        // var phone = link.data('phone');
    
        modal.find('#id').val(id);
        // modal.find('#phone').val(phone);
    }

    $('#payment').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{route('payment.subscription')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type: "POST",
                async: false,
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({ 
                    package_number: $('#id').val(),
                }),
                success: function(data){            
                    window.location.href = data;
                }
            });
        });
</script>
@endsection