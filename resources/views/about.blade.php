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


<style>
    #main-wrapper .container
    {
        margin-top: 100px;
    }
    .footer
    {
        margin-right: 0!important;
        width: 100%!important;
    }
    #main-wrapper .policy-container
    {
        margin-top: 50px;
    }
    #main-wrapper .policy-container h2
    {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    #main-wrapper .policy-container ul li
    {
        font-size: 18px;
        margin-bottom: 7px;
    }
    .lead
    {
        font-size: 20px;
        margin-top: 10px;
    }
    h2
    {
        position: relative;
    }
    h2:before
    {
        width: 50px;
        height: 2px;
        background: #FC8422;
        bottom: 0;
        right: 0;
        font-size: 22px;
        content: "";
        position: absolute;
        color: #ccc;
        top: 35px;
    }
    </style>
    
    <div class='container'>
        
        <h1 class='text-center'>نبذة عن النظام</h1>
        <div class='policy-container'>
            
            <h2>مرحبًا بك في خريج </h2>

            <p class='lead'>
الغرض الأساسي من توفير النظام الذكي لبنك الأسئلة هو التسهيل على الطلبة المقبلين على التخرج من المرحلة الثانوية إيجاد مكان متخصص للتدريب على الاختبار الوطني الكويتي -قسم اللغة الإنجليزية حيث يشمل الموقع عدد كبير يصل إلى 15 ألف سؤال من الأسئلة المتنوعة والشاملة لتغطي كافة المستويات، والتي نقوم دورياً بتحديثها حسب اعتمادها من المتخصصين في اللغة الإنجليزية.
            </p>
            
            <p class='lead'>
نقدم لكم النظام الذكي لبنك الأسئلة عبر موقع (خريج) الذي يساعد المستخدم في المراجعة الشاملة للاختبار الوطني الكويتي- قسم اللغة الإنجليزية والذي يتضمن ثلاث أجزاء (القواعد النحوية، الكلمات، القراءة والاستيعاب) كما يمكن للمستخدم البدء باختبار أحد هذه الأجزاء أو البدء باختبار شامل مكوّن من 85 سؤال، 
            </p>
            
            <p class='lead'>
يعتبر بنك الأسئلة وسيلة إضافية للطلبة المقبلين على الاختبار الوطني للتدريب المكثف مما يمكّنهم من زيادة فرصة تحقيقهم لدرجات عالية، وعلى الطلبة مسؤولية البحث والتحري عن أسباب حلول الأسئلة، فالنجاح الحقيقي يكمن في قدرة الطالب على تطوير مداركه في اللغة من أي وسيلة مشروعة. 
            </p>
            
            <p class='lead'>
سيتمكن جميع المشتركين في باقة بنك الأسئلة من الاستفادة من النظام حتى يوم السبت الموافق 1 يونيو 2024 بعدد غير محدود من المحاولات لأخذ الاختبارات الذكية.
            </p>
            
            <p class='lead'>
لا يغطي بنك الأسئلة أي مواد إضافية عدا اللغة الإنجليزية.
            </p>
            
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