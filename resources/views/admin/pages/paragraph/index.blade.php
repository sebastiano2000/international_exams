@extends('admin.layout.master')
@section('content')
<div class="main-wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-8 col-auto">
                        <h3 class="page-title">اسئلة القطعة</h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('paragraph.upsert') }}" class="btn btn-primary float-end mt-2">
                            <i class="ti-plus"></i>
                            اضف سؤال للقطعة
                        </a>
                    </div>
                </div>

            </div>
            <div class="card">
                <h2 class="card-header">رفع ملف اسئلة القطعة
                    <form action="{{ route('paragraph.dest') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('paragraph') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn bg-danger-light float-end">
                            <i class="ti-trash"></i>
                            حذف جميع الاسئله 
                        </button>
                    </form>
                </h2>

                <div class="card-body p-3">
                    <form action=" {{ route('paragraph.import') }}" class="mt-2 w-50" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label class="mb-2">اسم المادة</label>
                        <select class="form-control" name="subject_id" required>
                            @foreach($subjects as $subject)
                                @if($subject->id == 3)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <p class="error error_name"></p>
                        <input type="file" name="file" class="form-control" required>
                        <br>
                        <button class="btn btn-primary mt-1">
                            رفع ملف الأسئلة
                        </button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <form class="form" action="{{ route('paragraph.filter') }}" method="get">
                                    <div class="form-group d-flex align-items-center">
                                        <input type="search" placeholder="{{ __('pages.search_by_name') }}" name="name"
                                            class="form-control d-block search_input w-50"
                                            value="{{request()->input('name')}}">
                                        <button class="btn btn-primary mx-2 btn-search">{{ __('pages.search')}}</button>
                                    </div>
                                </form>
                                <table id="example" class=" display  table table-hover table-center mb-0"
                                    filter="{{ route('paragraph.filter') }}">
                                    <thead>
                                        <tr>
                                            <th>القطعة</th>
                                            <th>رأس السؤال</th>
                                            <th class="text-end">{{ __('pages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $question)
                                            <tr class="record">
                                                <td>{{ $question->paragraph->title }}</td>
                                                <td>{{ $question->title }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('paragraph.upsert',['question' => $question->id]) }}"
                                                            class="btn btn-sm bg-success-light">
                                                            <i class="ti-pencil"></i> {{ __('pages.edit') }}
                                                        </a>
                                                        <a data-bs-toggle="modal" href="#"
                                                            class="btn btn-sm bg-danger-light btn_delete"
                                                            route="{{ route('paragraph.delete',['question' => $question->id])}}">
                                                            <i class="ti-trash"></i> {{ __('pages.delete') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <nav aria-label="Page navigation example" class="mt-2">
                                <ul class="pagination">
                                    @for($i = 1; $i <= $questions->lastPage(); $i++)
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
</div>
@endsection


@section('js')
<script>
</script>
@endsection
