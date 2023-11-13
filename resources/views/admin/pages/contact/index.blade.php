@extends('admin.layout.master')
@section('content')
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid"> 
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">رسائل تواصل معنا</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">رسائل تواصل معنا</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <form class="form" action="{{ route('contact.filter') }}" method="get">
                                        <div class="form-group d-flex align-items-center">
                                            <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name" class="form-control d-block search_input w-25" value="{{request()->input('name')}}">
                                            <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search') }}</button>
                                        </div>
                                    </form>
                                    <table id="contact" class="table display table-hover table-center mb-0"  filter="{{ route('contact.filter') }}">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>الاسم</th>
                                                <th>رقم الجوال</th>
                                                <th>الرسالة</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach($contacts as $contact)
                                                <tr class="record">
                                                    <td>#{{ $contact->id }}</td>
                                                    <td>{{ $contact->name }}</td>
                                                    <td>{{ $contact->phone }}</td>
                                                    <td>{{ $contact->message }}</td>
                                                    <td class="text-end">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            @if(!count($contacts))
                                                <td colspan="4">
                                                    <p class="mb-0 text-center">{{ __('pages.no_data_to_display') }}</p>
                                                </td>
                                            @endif  
                                        </tbody>
                                    </table>
                                    <nav aria-label="Page navigation example" class="mt-2">
                                        <ul class="pagination">
                                            @for($i = 1; $i <= $contacts->lastPage(); $i++)
                                                    <li class="page-item @if(request()->input('page')== $i ) active @else @endif"><a class="page-link" href="?name={{request()->input('name')}}&page={{$i}}">{{$i}}</a></li>
                                            @endfor
                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>	
        		
        </div>
        <!-- /Page Wrapper -->

    </div>
@endsection

@section('js')
@endsection