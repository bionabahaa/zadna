@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/disease.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @if($healper->check_permission(41,1))
    <div class="top-bar">

        @if($healper->check_permission(41,2))
             <span class="add-crepto mr-2 mb-2"  data-target="#adddise" data-toggle="modal">إضافة امراض</span>
        @endif
    </div>
    <!--بدايه اعدادت عامه -->
    <section class="generalSet">
        <div class="row  m-0 p-lr-7 " style="margin-top: 10% !important">
            @php $count=0; @endphp
            @if($healper->check_permission(42,1))
                @php $count=1; @endphp
            <div class="col-lg-2 offset-lg-1 col-sm-4 col-12">
                <a href="{{url('Disease/disease/cur_disease')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/Diseases report.png')}}" class="mx-auto img-fluid">
                        <h6> الامراض الحالية</h6>

                    </div>
                </a>
            </div>
            @endif

            @php $count=0; @endphp
            @if($healper->check_permission(43,1))
                @php $count=1; @endphp
            <div class="col-lg-2 offset-lg-2  col-sm-4 col-12">
                <a href="{{url('Disease/disease/disease_record')}}">
                    <div id="disease_record" class="settings mx-auto text-center">
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/current Diseases.png')}}" class="mx-auto img-fluid">
                        <h6>سجل الامراض </h6>

                    </div>
                </a>
            </div>
            @endif

            @php $count=0; @endphp
            @if($healper->check_permission(44,1))
                @php $count=1; @endphp
            <div class="col-lg-2 offset-lg-2  col-sm-4 col-12">
                <a href="{{url('Disease/disease/looses_disease')}}">
                    <div class="settings mx-auto text-center">
                        <img src="{{asset('public/styles/backEnd/dist/imgs/icons/current Diseases.png')}}" class="mx-auto img-fluid">
                        <h6>سجل الفاقد </h6>

                    </div>
                </a>
            </div>
                @endif

        </div>
        @if($count==0)
            <h1 style="text-align: center;color: #28a745;">ليس لديك صلاحيه للتحكم فى صفحات  التكاليف</h1>
        @endif
    </section>
    <!--نهايه اعدادت عامه -->
<form id="form_add_disease" method="post">
    <div id="adddise" class="modal fade " role="dialog" currtable="" page-link="planting-tissue-view">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title text-center ">إضافة امراض</h5>
                </div>
                <div class="modal-body">



                    <div class="row mb-4">

                        <div class="col-12 form-inline">
                            <label class="col-5" for="col">إسم المرض:</label>
                            <input name="title" type="text" class="border-style col-6 ">
                            <div id="title_demo"></div>
                        </div>


                    </div>

                    <div class="row mb-4">

                        <div class="col-12 form-inline">
                            <label class="col-5" for="col">وصف المرض:</label>
                            <textarea name="desc" class="border-style col-6 "></textarea>
                            <div id="desc_demo"></div>
                        </div>
                    </div>




                    <div class="row mb-4  mt-5">
                        <div class="col-12 form-inline">
                            <label class="col-5" for="col">ملف الأمراض:</label>

                            <div class="col-6 ">

                                <label id="upload" >
                                    <input type="file" name="import_excel" for="#upload" hidden>
                                    <span class="upload-excel mr-2 mb-2 text-center" style="width:100%"> إدخال ملف</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @if(Session()->has('invalid_format'))
                        <p class="alert alert-danger">{{Session::get('invalid_format')}}</p>
                   @endif

                </div>
                <div class="modal-footer">
                    <a href="#" id="SubmitButton_add_disease" class="danger btn btn-primary btnSave ">حفظ</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                </div>
            </div>

        </div>
    </div>
</form>

        @else
        <h1 style="text-align: center;color: #28a745; margin-top: 150px">ليس لديك صلاحيه للتحكم فى صفحات الامراض</h1>

@endif




@endsection