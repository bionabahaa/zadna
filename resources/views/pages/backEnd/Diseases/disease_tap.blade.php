@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/disease.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });

        var addPest = function () {
            var row = ' <div class="row" >\n' +
            '                                                                        <div class="col-10">\n' +
            '                                                                            <div class="row form-inline">\n' +
            '                                                                                <label class="col-4" for="row">المبيد:</label>\n' +
            '                                                                                <select  name="pesticide[]" id="pesticide" class="select2 reset_select col-6"  style="width: 246px;">\n' +
            '                                                                                    {{--<option  disabled>اختر المبيد</option>--}}\n' +
            '                                                                                    @foreach($material_type as $material)\n' +
            '                                                                                        <option value="{{$material->id}}">{{$material->title}}</option>\n' +
            '                                                                                    @endforeach\n' +
            '                                                                                </select>\n' +
            '                                                                                <div id="pesticide_demo"></div>\n' +
            '                                                                            </div>\n' +
            '                                                                        </div>\n' +

                '                                                                    </div>\n' +
                '\n' +
                '                                                                    <div class="row mb-4 mt-4">\n' +
                '                                                                        <div class="row form-inline">\n' +
                '                                                                            <label class="col-5" for="col">الكميه للنخله</label>\n' +
                '                                                                            <input name="amount[]" id="amount" type="number" class="border-style col-7 col-val" min="0" style="width: 246px;">\n' +
                '                                                                            <div id="amount_demo"></div>\n' +
                '                                                                        </div>\n' +
                '                                                                    </div>'

            $(".plane-detail").append(row);
            $(".select2").select2();


        }

    </script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    <section class="content cropType">
        <div class="top-bar">

            <h6> الامراض > الامراض الحالية</h6>
        </div>

    </section>

    <div class="row m-0">

        <div class="col-sm-12 col-12 p-0">

            <div>
                <div class="row  mt-0 mr-4 ml-4 mb-4">
                    <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                        <li class="nav-item selected ">
                            <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails"
                               role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none;
                    padding: 4px;
                    font-size: 22px;">المواصفات
                                العامة</a>
                        </li>
                        @if($healper->check_permission(41,6))
                            <li class="nav-item  ">
                                <a class="nav-link linkColor  " id="dise-trace-tab" data-toggle="tab" href="#dise-trace"
                                   role="tab" aria-controls="dise-trace" aria-selected="false" style="border: none;
                padding: 4px;
                font-size: 22px;">تتبع
                                    المرض</a>
                            </li>
                        @endif
                        @if($healper->check_permission(41,8))
                            <li class="nav-item ">
                                <a class="nav-link linkColor " id="plane-tab" data-toggle="tab" href="#plane" role="tab"
                                   aria-controls="plane" aria-selected="false" style="border: none;
                padding: 4px;
                font-size: 22px;">خطة
                                    مكافحة الامراض </a>
                            </li>
                        @endif
                        <li class="nav-item ">
                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab"
                               aria-controls="analyse" aria-selected="false" style="border: none;
                padding: 4px;
                font-size: 22px;">موارد
                                العمليات</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab"
                               aria-controls="notes" aria-selected="true" style="border: none;
            padding: 4px;
            font-size: 22px;">الملاحظات</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab"
                               aria-controls="requests" aria-selected="false" style="border: none;
            padding: 4px;
            font-size: 22px;">توصيات</a>
                        </li>
                    </ul>


                    <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">


                        <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab"
                             style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <form id="form_edit_disease" method="post">
                                <input type="hidden" id="id" value="{{$info->id}}" name="disease_id">

                            <div class="row m-4 tab-top">
                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <table class="table borderless table1">
                                        <thead>
                                        <tr>
                                            <th scope="col"> اسم المرض</th>
                                            <th scope="col">وصف المرض</th>
                                            <th scope="col">المربع</th>
                                            <th scope="col">النخل المصاب</th>
                                            <th>تاريخ الاصابة</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border_bottom">
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="hidden" name="disease_code" id="disease_code" value="{{$info_detail->code}}">
                                                    <input type="text" name="title" class="form-control numric td-edit" value="{{$info->title}}">
                                                </div>
                                                <div id="title_demo"></div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                        <textarea type="text" name="desc" class="form-control numric td-edit ">{{$info->desc}}</textarea>
                                                </div>
                                                <div id="desc_demo"></div>
                                            </td>

                                            <td>
                                                <div class="form-group InputGroup ">
                                                    <select name="box_id" id="choose_box"  class="numric select2 typescrop col-val col-6"  style="width: 50%;" >
                                                        @foreach($boxes as $box)
                                                            <option value="{{$box->id}}" @if($info_detail->box_id==$box->id) selected @endif>{{$box->code}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="palms_demo"></div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <select name="palms[]" id="plam_tree_code" class=" form-control  select2 typescrop col-val col-6"
                                                            style="width: 100%;" multiple>
                                                        @foreach($plam_tree_code as $palm)
                                                            <option value="{{$palm}}" @if(in_array($palm,$palms)) selected @endif >{{$palm}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="palms_demo"></div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="date" name="date" id="ExCost" class="form-control  border-style col-6 col-val" value="{{$info_detail->date}}">
                                                </div>
                                                <div id="date_demo"></div>
                                            </td>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <table class="table borderless table1 " style="margin-top: 7%">
                                        <thead>
                                        <tr>
                                            <th scope="col">  المكافحة بواسطه</th>
                                            <th scope="col">الحاله بعد المكافحة</th>
                                            <th scope="col">اسباب الفقد</th>
                                            <th scope="col">نسبة الشفاء</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border_bottom">
                                            <td>
                                                <select name="user_id" class=" numric select2 typescrop col-val col-6"  style="width: 50%;" >
                                                    <option selected disabled>المكافحه بواسطه</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" @if($info_detail->user_id==$user->id) selected @endif>{{$user->username}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" onclick="showInput('looses_reason')" value="0" id="customRadio1" @if($info_detail->status==0) checked   @endif name="status" class="custom-control-input">
                                                    <label class="custom-control-label" @if($info_detail->status==0) style="color: red;" @endif for="customRadio1">تم الفقد</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" onclick="showInput('recovery_percent')" value="1" id="customRadio2" @if($info_detail->status==1) checked @endif name="status"  class="custom-control-input">
                                                    <label class="custom-control-label"  @if($info_detail->status==1) style="color: red;" @endif for="customRadio2">تم
                                                        الشفاء</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                        <textarea id="looses_reason" name="looses_reason" type="text" class="form-control numric td-edit " @if($info_detail->status==1) style="display: none;"  @endif  >{{$info_detail->losses_reason}}</textarea>
                                                </div>
                                            </td>
                                            <td>
                                                <input id="recovery_percent"  name="recovery_percent" value="{{$info_detail->recovery_percent}}" type="text" class="form-control border-style text-center td-edit " @if($info_detail->status==0) style="display: none;"  @endif>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         @if($record==false)
                            <div class="col pl-5">
                                @if($healper->check_permission(42,5))
                                <button type="button" id="SubmitButton" class="btn edit-btn ml-5" style="background-color:green">تعديل</button>
                                <button type="button" class="btn save-btn ml-5 save-edit-tabs " hidden="">حفظ</button>
                                @endif

                            </div>
                          @endif
                    </form>

                    </div>

                        <div class="tab-pane fade   " id="dise-trace" role="tabpanel" aria-labelledby="dise-trace-tab"
                             style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                            <div class="dis-steps m-3 ">
                                <div class="row  justify-content-center">
                                    <div class=" col-12  mt-3 float-left text-right ">
                                        @if($healper->check_permission(41,7))
                                        @if($record==false)
                                        <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addTraceModal"
                                                data-toggle="modal">إضافة </button>
                                        @endif
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <table id="DataTable_DiseaseFollow" class="table zadnatable mt-5">
                                            <thead>
                                            <tr>
                                                <th>الملاحظة</th>
                                                <th>تاريخ الملاحظة</th>
                                                <th>كتبت بواسطة </th>
                                            </tr>
                                            </thead>
                                        </table>

                                    </div>
                                </div>
                            </div>

<form id="form_addDisease_follow" method="post">
                            <div id="addTraceModal" class="modal fade" role="dialog" currTable page-link="planting-tissue-view">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modalbg-add">
                                        <div class="modal-header d-flex flex-row-reverse">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h5 class="modal-title text-center ">اضافة</h5>
                                        </div>
                                        <div class="modal-body">


                                            <div class="row mb-4">

                                                <div class="col-12 form-inline">
                                                    <label class="col-5" for="row">الملاحظه:</label>
                                                    <textarea  name="note" class="border-style col-6 col-val"></textarea>
                                                </div>
                                                <div id="note_demo"></div>


                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-12 form-inline">
                                                    <label class="col-5" for="col">تاريخ الملاحظه:</label>
                                                    <input name="note_date" type="date" class="border-style col-6 col-val" min="0">
                                                    <div id="note_date_demo"></div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <a href="#" id="submutButton_addDisease_follow" class="danger btn btn-primary btnSave ">حفظ</a>
                                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
</form>

                        </div>


                        <div class="tab-pane fade  " id="plane" role="tabpanel" aria-labelledby="plane-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <div class="Mparent">
                                <div class="Tparent">



                                    <div class="row m-4">

                                        <div class="col-lg-2  col-6">

                                        </div>

                                        <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">

                                            @if($healper->check_permission(41,9))
                                            <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addPlaneModal"
                                                    data-toggle="modal" id="addDiseasePlan">أضافة </button>
                                             @endif

                                        </div>

                                    </div>

                                    <div class="row m-3 justify-content-center ">
                                        <div class="col-lg-12 ">

                                            <table id="dataTableDiseasePlan" class="table zadnatable mainTable notesTable" tableId="15">
                                                <thead>
                                                <tr>
                                                    <th style="width: 6%;">الكود</th>
                                                    <th>المبيد</th>
                                                    <th>طريقة الاستخدام</th>
                                                    <th>عدد مرات التكرار</th>
                                                    <th>التاريخ</th>
                                                    <th class="actions">
                                                        <i class="fas fa-bars"></i>
                                                    </th>

                                                </tr>
                                                </thead>
                                                </table>
                                        </div>
                                    </div>



                                    <div id="addPlaneModal" class="modal fade " role="dialog" currTable view-tab="view-plane">

                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h5 class="modal-title text-center ">اضافة</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form_add_plan_disease" method="post">
                                                        <input type="hidden" id="plan_disease_id" value="">


                                                            <div class="row mb-4">
                                                                <div class="col-6" style="
    border-left: 1px solid #0000002b;
">
                                                                    <div class="plane-detail" id="pesticide">
                                                                    <div class="row">
                                                                        <div class="col-10">
                                                                            <div class="row form-inline">
                                                                                <label class="col-4" for="row">المبيد:</label>

                                                                                <select  name="pesticide[]"  class="select2 reset_select col-6"   style="width: 246px;">
                                                                                    @foreach($material_type as $material)
                                                                                        <option value="{{$material->id}}">{{$material->title}}</option>
                                                                                     @endforeach

                                                                                </select>
                                                                                <div id="pesticide_demo"></div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <i class="far fa-plus-square ml-4 " onclick="addPest()" style="cursor: pointer"></i>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-4 mt-4">
                                                                        <div class="row form-inline">
                                                                            <label class="col-5" for="col">الكميه للنخله</label>
                                                                            <input name="amount[]" id="amount" type="number" class="border-style col-7 col-val" min="0" style="width: 246px;">
                                                                            <div id="amount_demo"></div>
                                                                        </div>
                                                                    </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="row mb-4">

                                                                        <div class="col-12 ">
                                                                            <label class="col-4" for="mahbs">طريقة التنفيذ:</label>
                                                                            <textarea name="used_way" id="used_way" style="width: 246px;"></textarea>
                                                                            <div id="used_way_demo"></div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row mb-4">

                                                                        <div class="col-12">
                                                                            <label class="col-4" for="mahbs">عدد مرات التكرار</label>
                                                                            <input name="repeat" id="repeat" type="number" class="border-style col-6 col-val" min="0" style="width: 246px;border: 1px solid">
                                                                            <div id="repeat_demo"></div>
                                                                        </div>
                                                                    </div>

                                                                            <div class="row mb-4">
                                                                                <div class="col-12">
                                                                                    <label class="col-4" for="mahbs">التاريخ:</label>
                                                                                    <input name="date" id="date" type="date" class="border-style col-6 col-val">
                                                                                    <div id="date_demo"></div>
                                                                                </div>
                                                                            </div>
                                                                </div>

                                                            </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">

                                                    @if($healper->check_permission(2,2))
                                                    <a href="#" id="SubmitButton_plan_disease" class="danger btn btn-primary SaveNew ">حفظ</a>
                                                    @endif
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $process_array=[
                                'moduel_id'=>15,
                                'box_id'=>$info->box_id
                            ];
                        @endphp
                        @include('pages.backEnd.Operations.process',$process_array)
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection