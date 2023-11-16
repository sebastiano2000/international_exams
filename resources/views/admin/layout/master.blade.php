<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<meta http-equiv='cache-control' content='no-cache'>-->
    <!--<meta http-equiv='expires' content='0'>-->
    <!--<meta http-equiv='pragma' content='no-cache'>-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/خريج.svg')}}">
    <title>خريج</title>
    <!-- chartist CSS -->
    <link href="{{ asset('admin_assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('admin_assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('admin_assets/css/style.min.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('admin_assets/css/pages/dashboard1.css') }}" rel="stylesheet">

    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('admin_assets\css\select2.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('admin_assets\css\fileupload.css') }}" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>

<body class="skin-blue fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">خريج</p>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="background: #fc8423;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <b class="small-icon">
    
                            <img src="{{ asset('admin_assets/images/logo.svg') }}" alt="homepage" class="light-logo d-lg-none "
                                style="max-height: 50px; min-width: 50px;" /> 
                        </b>
                        <span>
                            <!-- <img src="{{ asset('admin_assets/images/logo.svg') }}" alt="homepage"
                                class="dark-logo me-2" style="max-height: 50px" /> -->
                            <img src="{{ asset('admin_assets/images/logo.svg') }}" class="light-logo me-2"
                                alt="homepage" style="max-height: 50px; width: 150px;"/>
                        </span>
                    </a>
                </div>
                <div class=" navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a
                            class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                            href="javascript:void(0)"><i class="icon-arrow-left-circle" style="font-size: 30px; margin-right: 10px;"></i><i class="icon-arrow-right-circle xl" style="font-size: 30px;"></i></a></li>
                        <li class="nav-item"><a
                            class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                            href="javascript:void(0)"><i class="icon-arrow-left-circle" style="font-size: 30px; margin-right: 10px;"></i><i class="icon-arrow-right-circle xl" style="font-size: 30px;"></i></a></li>
                    </ul>
                    @if(Auth::user()->isAdmin())
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light"
                                    href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                        </ul>
                    @endif
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <div class="p-2 text-right" style="font-size: 16px; font-weight: bold;">
                        مرحباً بك
                    </div>
                    <div class="text-center" style="font-size: 22px; font-weight: bold;">
                        {{ Auth::user()->name }}
                    </div>
                    <ul id="sidebarnav">
                        @if(Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('user') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2"">
                                    <div>{{ __('pages.users') }}</div>
                                    <div style="text-align: end;">Users</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('subject') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>المادة</div>
                                    <div style="text-align: end;">Subject</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('paragraph') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>اسئلة القطعة</div>
                                    <div style="text-align: end;">Paragraph Questions</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('question') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الاسئلة</div>
                                    <div style="text-align: end;">Questions</div>                                    
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('result') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>نتائج الاختبار</div>
                                    <div style="text-align: end;">Exam Result</div>                                  
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('total') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>نتائج الاختبار الشامل</div>
                                    <div style="text-align: end;">Full Test Result</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('preparator') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>محضرين</div>
                                    <div style="text-align: end;">Preparators</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('prices') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الاسعار</div>
                                    <div style="text-align: end;">Pricing</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الابلاغات</div>
                                    <div style="text-align: end;">Reports</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact.admin') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>رسائل تواصل معنا</div>
                                    <div style="text-align: end;">Contact Messagese</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('log') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>سجل العمليات</div>
                                    <div style="text-align: end;">Log</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('financial_transaction') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>سجل عمليات الدفع</div>
                                    <div style="text-align: end;">Financial Transactions</div>
                                </a>
                            </li>
                        @elseif(Auth::user()->suspend)
                            <li>
                                <a href="{{ route('home') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الصفحة الرئسية</div>
                                    <div style="text-align: end;">Homepage</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('question.fav') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الاسئلة المفضلة</div>
                                    <div style="text-align: end;">Favourite Questions</div>
                                </a>
                            </li>
                            @foreach(\App\Models\Subject::all() as $subject)
                                <li>
                                    <a href="{{ route('exam', ['subject_id' => $subject->id]) }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        <div>اختبار تجريبي {{ ($subject->name == 'Grammar' ? 'القواعد' : $subject->name == 'Vocabulary') ? 'الكلمات' : 'القراءة و الاستيعاب' }}</div>
                                        <div style="text-align: end;">{{$subject->name}} Practice Test</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('exam.test', ['subject_id' => $subject->id]) }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        <div>مراجعة {{ ($subject->name == 'Grammar' ? 'القواعد' : $subject->name == 'Vocabulary') ? 'الكلمات' : 'القراءة و الاستيعاب' }}</div>
                                        <div style="text-align: end;">{{$subject->name}} Review</div>
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('exam.final') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الأختبار الشامل</div>
                                    <div style="text-align: end;">Full Test</div>
                                </a>
                            </li>
                            @foreach(\App\Models\Preparator::all() as $preparator)
                                <li>
                                    <a href="{{ asset('/preparators/'.$preparator->picture->name) }}" target="_blank" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        مذكرات {{$preparator->name}}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @foreach(\App\Models\Subject::all() as $subject)
                                <li>
                                    <a href="{{ route('pricing.index') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        <div>ديمو {{ ($subject->name == 'Grammar' ? 'القواعد' : $subject->name == 'Vocabulary') ? 'الكلمات' : 'القراءة و الاستيعاب' }}</div>
                                        <div style="text-align: end;">{{$subject->name}} Demo</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pricing.index') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        <div>اختبار تجريبي {{ ($subject->name == 'Grammar' ? 'القواعد' : $subject->name == 'Vocabulary') ? 'الكلمات' : 'القراءة و الاستيعاب' }}</div>
                                        <div style="text-align: end;">{{$subject->name}} Practice Test</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pricing.index') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                        <div>مراجعة {{ ($subject->name == 'Grammar' ? 'القواعد' : $subject->name == 'Vocabulary') ? 'الكلمات' : 'القراءة و الاستيعاب' }}</div>
                                        <div style="text-align: end;">{{$subject->name}} Review</div>
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('pricing.index') }}" class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2">
                                    <div>الأختبار الشامل</div>
                                    <div style="text-align: end;">Full Test</div>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a 
                                href="#"
                                onclick="edit_password(this)"
                                data-target="#edit_password"
                                data-toggle="modal"
                                data-id="{{Auth::user()->id}}"
                                class="sidebar-container d-flex justify-content-between align-items-center p-2 mb-2"
                            >
                                <div>تعديل كلمة المرور</div>
                                <i class="icon-refresh"></i>
                                <div style="text-align: end;">Reset Password</div>
                            </a>
                        </li>
                        <li><a class="waves-effect waves-dark sidebar-container d-flex justify-content-between align-items-center p-2 mb-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                aria-expanded="false">
                                <div>تسجيل الخروج</div>
                                <i class="icon-logout"></i>
                                <div style="text-align: end;">{{ __('pages.Logout') }}</div>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span>
                        </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a>
                                </li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a>
                                </li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark"
                                        class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark"
                                        class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a>
                                </li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark"
                                        class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark"
                                        class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark"
                                        class="megna-dark-theme ">12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div id="edit_password" class="modal fade">   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">تغير كلمة السر</h4>
                    <span class="button" data-dismiss="modal" aria-label="Close">   <i class="ti-close"></i> </span>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('user.password') }}" class="ajax-form" swalOnSuccess="{{ __('pages.sucessdata') }}" title="{{ __('pages.opps') }}" swalOnFail="{{ __('pages.wrongdata') }}" redirect="{{ route('home') }}">
                        @csrf
                        <input type="hidden" name="id" id="password_id">
                        <div class="form-group">
                            <label class="mb-2">كلمة السر</label>
                            <div class="col-md-12">
                                <input class="form-control text-start" id="password" type="text" name="password" placeholder="كلمة السر" >
                                <p class="error error_password"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-2">تاكيد كلمة السر</label>
                            <div class="col-md-12">
                                <input class="form-control text-start" id="confirm_password" type="text" name="password_confirmation" placeholder="كلمة السر" >
                                <p class="error error_email"></p>
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
    <script src="{{ asset('admin_assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('admin_assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('admin_assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('admin_assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('admin_assets/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('admin_assets/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <script src="{{ asset('admin_assets\js\select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/select2.js')}}"></script>

    <script src="{{ asset('admin_assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('admin_assets/node_modules/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('admin_assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/dashboard1.js') }}"></script>
    <script src="{{ asset('admin_assets/js/custom1.js') }}"></script>
    <script src="{{ asset('admin_assets/js/script.js') }}"></script>
    <script src="{{ asset('admin_assets/js/lighthouse.js') }}"></script>
    <script src="{{ asset('admin_assets\js\lighthouse.js') }}"></script>
    <script src="{{ asset('admin_assets\js\ajaxActions.js') }}"></script>
    <script src="{{ asset('admin_assets\js\sweetalert2.js') }}"></script>
    <script src="{{ asset('admin_assets\js\bootstrap.main.js') }}"></script>
    <script src="{{ asset('admin_assets\js\dropify.js') }}"></script>
    <script src="{{ asset('admin_assets\js\fileupload.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function(){
            let table = new DataTable('#example', {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                ],
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
            
            $(".sorting").css({ 'text-align': 'right' });
            $("#example_filter").css({ 'margin-bottom': "20px" });
            $(".buttons-excel").css({ 'background': "#fc8423", 'margin-right': "10px !important" });
            $(".dt-buttons").css({ 'padding-top': "15px" });

            function route(){
                return $(this).attr('route');
            }

            function placeholder(){
                return $(this).attr('placeholder');
            }
            
            $(".select2").select2({
                ajax: {
                    url: route,
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function (term) {
                        return {
                            term: term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: $.map(response, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        }
                    },
                    cache: true,
                    templateResult: formatRepo,
                    placeholder: placeholder,
                },
            });

            function formatRepo (item) {
                return item.name;
            }
        });

        function edit_password(el) {
            var link = $(el);
            var modal = $("#edit_password");
            var password = link.data('password');
            var id = link.data('id');
            var confirm_password = link.data('confirm_password');
        
            modal.find('#password').val(password);
            modal.find('#password_id').val(id);
            modal.find('#confirm_password').val(confirm_password);
        }

        $('.dropify').dropify();
      
        $('.btn_delete').on('click',function(){
            Swal.fire({
                title: '{{ __("pages.slow_down") }}',
                text: "{{ __('pages.the_deleted_data_cant_be_restored') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("pages.confirm") }}',
                cancelButtonText: '{{ __("pages.cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: 'success',
                        title: '{{ __("pages.your_file_has_been_deleted") }}',
                    });

                    $($(this).parent().parent().siblings().eq(0).attr("data-bs-target")).remove();
                    $(this).closest('.record').remove();
                    
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: $(this).attr('route'),
                        method: 'POST'
                    });
                }
            });
        });
        
        $(".sidebartoggler").on('click', function () {
            if ($("body").hasClass("mini-sidebar")) {
                $(".left-sidebar").removeClass("d-none");
            }
            else {
                $(".left-sidebar").addClass("d-none");
            }
        });
        
        $.ajax({
            url: "/verified",
            method: "post"
        });

        $('body').bind('copy',function(e){
            e.preventDefault();

            return false;
        });
    </script>
    @yield('js')
</body>

</html>