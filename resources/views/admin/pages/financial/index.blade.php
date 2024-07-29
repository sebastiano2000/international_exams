@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">سجل عمليات الدفع</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">سجل عمليات الدفع</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <form class="form row" action="{{ route('financial_transaction.filter') }}"
                                    method="get">
                                    <div class="form-group col-md-11 d-flex align-items-center">
                                        <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name" class="form-control d-block search_input w-25" value="{{request()->input('name')}}">
                                        <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search')}}</button>
                                    </div>
                                </form>
                                <table id="exampleTable" class="table display table-hover table-center mb-0"
                                    filter="{{ route('financial_transaction.filter') }}">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>اسم المشتري</th>
                                            <th>رقم المشتري</th>
                                            <th>اسم الباقة</th>
                                            <th>تاريخ الدفع</th>
                                            <th>حالة الدفع</th>
                                            <th>المبلغ الإجمالي</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($financial_transactions as $financial_transaction)
                                            <tr class="record">
                                                <td>#{{ $financial_transaction->id}}</td>
                                                <td>{{ $financial_transaction->user->name }}</td>
                                                <td>{{ $financial_transaction->user->phone }}</td>
                                                <td>{{ $financial_transaction->package->name }}</td>
                                                <td>{{ $financial_transaction->paidOn}} </td>
                                                <td>{{ $financial_transaction->resultCode == 'CAPTURED' ? 'ناجح' : 'غير ناجح' }}</td>
                                                <td>{{ $financial_transaction->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example" class="mt-2">
                                    <ul class="pagination">
                                        @for($i = 1; $i <= $financial_transactions->lastPage(); $i++)
                                            <li class="page-item"><a class="page-link" href="?page={{$i}}">{{$i}}</a>
                                            </li>
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
<script>
    let table = new DataTable('#exampleTable', {
        order: [[3, 'desc']],
        dom: 'Bfrtip',
        buttons: [],
        searching: false,
        responsive: true,
        paging: false,
        info: false,
        language: {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });

</script>

@endsection