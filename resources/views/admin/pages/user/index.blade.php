
@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">{{ __('pages.users') }}</h3>
                        </div>
                        <div class="col-sm-5 col">
                            <a href="{{ route('user.upsert') }}" class="btn btn-primary float-end mt-2">  <i class="ti-plus"></i> {{ __('pages.add_user') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <form class="form" action="{{ route('user.filter') }}" method="get">
                                        <div class="form-group d-flex align-items-center">
                                            <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name" class="form-control d-block search_input w-50" value="{{request()->input('name')}}">
                                            <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search') }}</button>
                                        </div>
                                    </form>
                                    <table id="example" class=" display  table table-hover table-center mb-0"  filter="{{ route('user.filter') }}">
                                        <thead>
                                            <tr>
                                                <th>{{ __('pages.name') }}</th>
                                                <th>{{ __('pages.mobile') }}</th>
                                                <th>{{ __('pages.role') }}</th>
                                                <th>اسم الجامعة</th>
                                                <th>حالة الدفع</th>
                                                <th>حالة الاشتراك</th>
                                                <th>حالة التسجيل</th>
                                                <th>الحد الأقصي للأجزة</th>
                                                <th class="text-end">{{ __('pages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr class="record">
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    @if($user->role_id == '1')
                                                        <td>{{ __('pages.admin') }}</td>
                                                    @elseif($user->role_id == '2')
                                                        <td>المتدرب</td>
                                                    @endif
                                                    <td>{{ $user->high }}</td>
                                                    <td>
                                                        @if($user->financials()->first())
                                                            {{$user->financials()->first()->paid ? 'مدفوع' : 'غير مدفوع'}}
                                                        @else
                                                            غير مدفوع
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($user->role_id != 1)
                                                            <label class="switch switch_user_status" style="width: 50px; height: 25px;">
                                                                <input type="checkbox" class="user_status" @if($user->activation) value="1" @else value="0" @endif user_id="{{ $user->id }}" name="user_suspend" style="width: 15px; height: 15px;">
                                                                <span class="slider round" style="border-radius: 25px;"></span>
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($user->role_id != 1)
                                                            <label class="switch switch_user_status" style="width: 50px; height: 25px;">
                                                                <input type="checkbox" class="user_otp" @if($user->otp) value="1" @else value="0" @endif user_id="{{ $user->id }}" name="user_otp" style="width: 15px; height: 15px;">
                                                                <span class="slider round" style="border-radius: 25px;"></span>
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control session_limit" value="{{ $user->session_limit }}"  user_id="{{ $user->id }}" name="session_limit" style="width: 80px; height: 25px; text-align: center;" >
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <a href="#" onclick="edit_partner(this)"
                                                                data-target="#edit_partner"
                                                                data-toggle="modal"
                                                                data-id="{{$user->id}}"
                                                                data-full_name="{{$user->name}}"
                                                                data-role="{{$user->role_id}}"
                                                                data-phone="{{$user->phone}}"
                                                                data-high="{{$user->high}}"
                                                                class="btn btn-sm bg-success-light"
                                                            >
                                                                <i class="ti-pencil"></i> {{ __('pages.edit') }}  
                                                            </a>
                                                            <a href="#" onclick="edit_password(this)"
                                                                data-target="#edit_password"
                                                                data-toggle="modal"
                                                                data-id="{{$user->id}}"
                                                                class="btn btn-sm bg-info-light"
                                                            >
                                                                <i class="ti-pencil"></i> تعديل كلمة السر 
                                                            </a>
                                                            <a href="{{ route('log.filter', ['name' =>  $user->name]) }}" class="btn btn-sm bg-info-light">
                                                                عمليات المستخدم
                                                            </a>
                                                            @if($user->role_id != 1)
                                                                <a data-bs-toggle="modal" href="#" class="btn btn-sm bg-danger-light btn_delete" route="{{ route('user.delete',['user' => $user->id])}}">
                                                                    <i class="ti-trash"></i> {{ __('pages.delete') }}
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>  
                                    </table>
                                    <nav aria-label="Page navigation example" class="mt-2">
                                        <ul class="pagination">
                                            @for($i = 1; $i <= $users->lastPage(); $i++)
                                                    <li class="page-item @if(request()->input('page')== $i ) active @else @endif"><a class="page-link" href="?name={{request()->input('name')}}&page={{$i}}">{{$i}}</a></li>
                                            @endfor
                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
                <div id="edit_partner" class="modal fade">   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modelHeading">{{ __('pages.edit_user_info') }}</h4>
                                <span class="button" data-dismiss="modal" aria-label="Close">   <i class="ti-close"></i> </span>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" action="{{ route('user.modify') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('user') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 mb-2 control-label">{{ __('pages.name') }}</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="full_name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                            <p class="error error_name"></p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="mb-2">{{ __('pages.Phone') }}</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input placeholder="{{ __('pages.Phone') }}" type="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="">
                                                <p class="error error_phone"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <x-country-phone-code></x-country-phone-code>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 mb-2 control-label">{{ __('pages.high') }}</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="high" name="high" placeholder="{{ __('pages.high') }}" value="" maxlength="50" required="">
                                            <p class="error error_high"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">{{ __('pages.save') }}
                                        </button>
                                    </div>
                                </form>
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
    function edit_partner(el) {
        var link = $(el);
        var modal = $("#edit_partner");
        var full_name = link.data('full_name');
        var id = link.data('id');
        var high = link.data('high');
        var phone = link.data('phone');
    
        modal.find('#full_name').val(full_name);
        modal.find('#id').val(id);
        modal.find('#high').val(high);
        modal.find('#phone').val(phone);
    }

    $(".user_status").on("change", function(){   
        if ($(this).is(":checked"))
        {
            $(this).val(1);
        }   
        else {
            $(this).val(0);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: '{{ route("user.status") }}',
            method: 'post',
            data: {id: $(this).attr("user_id"), activation: $(this).val()},
            success: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: "{{ __('pages.sucessdata') }}"
                });
            }
        });
    });

    $(".user_otp").on("change", function(){   
        if ($(this).is(":checked"))
        {
            $(this).val(1);
        }   
        else {
            $(this).val(0);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: '{{ route("user.otp") }}',
            method: 'post',
            data: { id: $(this).attr("user_id"), otp: $(this).val() },
            success: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: "{{ __('pages.sucessdata') }}"
                });
            }
        });
    });

    $(".session_limit").on("change", function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: '{{ route("user.limit") }}',
            method: 'post',
            data: {id: $(this).attr("user_id"), limit: $(this).val()},
            success: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: "{{ __('pages.sucessdata') }}"
                });
            }
        });
    });
    
    $(document).ready(function(){
        for(let status of $('.user_status')){
            if (status.value == 1)
            {
                status.checked = true;
            } 
            else{
                status.checked = false;
            }
        }

        for(let status of $('.user_otp')){
            if (status.value == 1)
            {
                status.checked = true;
            } 
            else{
                status.checked = false;
            }
        }
    });
</script>

@endsection