@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/add-well.css">
@endsection
@section('page_script')
<script>
    var report={{$report }};
    $(function () {
      $(".select2").select2();
    });
    var operation_page=1;
  </script>
  
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')

  <!--بدايه اصناف المحصول-->
  <section class="content cropType">
    <div class="top-bar">
        <h6>اعدات عامة > الابار > إضافة بئر</h6>
    </div>

    <div class="row m-4">
        <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
            <li class="nav-item selected">
                <a class="nav-link linkColor active show" id="puplic-tab" data-toggle="tab" href="#puplic" role="tab" aria-controls="puplic"
                    aria-selected="true" style="border: none;
padding: 4px;
font-size: 22px;">المواصفات العامة</a>
            </li>
        </ul>

        <form id="AddWellForm" method="POST" style="width: 100%;">
            <input type="hidden" name="id" id="id" value="">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="puplic" role="tabpanel" aria-labelledby="puplic-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                <div class="weels m-5">
                    <div class="row p-4 m-2">
                        <div class="col-md-4 col-xs-12">
                            <label>الاسم</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="" name="title" class="form-control ">
                            </div>
                            <div id="title_demo"></div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>الحالة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <select class="form-control filter-form" name="status">
                                    <option selected disabled>اختر الحاله</option>
                                    @foreach ($Status as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="status_demo"></div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>تاريخ الحفر</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="date" name="date_of_excavation" class="form-control numric">

                            </div>
                            <div id="date_of_excavation_demo"></div>
                        </div>

                    </div>

                    <div class="row p-4 m-2">
                        <div class="col-md-4 col-xs-12">
                            <label>الاحداثيات</label>
                            <hr>
                            <td class="InputNum td-rep" >
                                <div class="form-group ">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" name="point1" class="form-control numric loc"
                                                   placeholder="نقطه1">
                                            <div id="point1_demo"></div>
                                        </div>


                                        <div class="col-sm-7">
                                            <div class="box_point1">
                                                <div class="row">
                                                    <div class="col-sm-3 p-0">
                                                        <input type="text" name="north" class="form-control numric loc"
                                                               placeholder="شمال ">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="degree[]" type="text" class="form-control numric loc1"
                                                               placeholder="درجه">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="minute[]" type="text" class="form-control numric loc1"
                                                               placeholder="دقيقه">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="second[]" type="text" class="form-control numric loc1"
                                                               placeholder="ثانيه">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-7 offset-sm-4">
                                            <div class="box_point1">
                                                <div class="row">
                                                    <div class="col-sm-3 p-0">
                                                        <input type="text" name="east" class="form-control numric loc"
                                                               placeholder="شرق ">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="degree[]" type="text" class="form-control numric loc1"
                                                               placeholder="درجه">

                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="minute[]" type="text" class="form-control numric loc1"
                                                               placeholder="دقيقه">

                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="second[]" type="text" class="form-control numric loc1"
                                                               placeholder="ثانيه">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <span class="error-txt text-danger"></span>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <label>العمق</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="depth" name="config[depth]" class="form-control numric">
                            </div>
                            <span class="error-txt text-danger"></span>
                        </div>

                        <div class="col-md-4 col-xs-12" style="display:none">
                            <label>قطر البئر</label>
                            <hr>
                            <!--                ذودت قطر البئر-->
                            <div class="form-group InputGroup">
                                <input type="text" name="config[well_radius]" class="form-control numric">

                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12">
                            <label>التكلفة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="cost" name="config[cost]" class="form-control numric">
                            </div>
                            <span class="error-txt text-danger"></span>
                        </div>
                    </div>
                    <div class="row p-4 m-2">
                        <div class="col-md-6 col-xs-12">
                            <label>الاحد الادنى لكمية المياة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="minimum_water_quantity" class="form-control numric" name="config[minimum_water_quantity]" id="well-lowest-amount-of-water">

                            </div>
                            <span class="error-txt text-danger"></span>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>الملاحظات</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" name="config[note]" class="form-control numric">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12" style="display:none">
                            <label>الملف الجيولوجى للبئر </label>
                            <hr>
                            <div class="button-cont">

                                <input type="file" name="geological_profile_file" id="file-0" class="inputfile  inputfile-1 "
                                     />
                                <label for="file-0">
                                    <span>تحميل ملف&hellip;</span>
                                </label>

                                <label class="water-date-lable">تاريخ</label>
                                <input name="config[geological_profile_date]" type="date" class="water-date numric">
                            </div>

                        </div>

                    </div>


                    <div class="row p-4 m-2" style="display:none">
                        <div class="col-md-6 col-xs-12">
                            <label>كمية المياة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" class="form-control numric" name="config[water_quantity_num]">
                                <select name="config[water_quantity_term]" class="form-control numric">
                                    <option value="1">لتر</option>
                                    <option value="2">كم</option>
                                </select>
                                <label class="water-date-lable">تاريخ</label>
                                <input type="date" name="config[water_quantity_date]" class="form-control numric">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>تحليل المياه</label>
                            <hr>
                            <div class="button-cont">

                                <input type="file" name="water_analysis_file" id="file-1" class="inputfile  inputfile-1 "
                                     />
                                <label for="file-1">
                                    <span>تحميل ملف&hellip;</span>
                                </label>

                                <label class="water-date-lable">تاريخ</label>
                                <input type="date" name="config[water_quantity_date]" class="water-date numric">
                            </div>
                        </div>
                    </div>

                    <div class="row p-4 m-2">
                        <div class="col-md-6 col-xs-12" style="display:none">
                            <label>التوصية</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input name="config[recommendation]" type="text" class="form-control numric">

                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col pl-5">
                        <button type="button" id="SubmitButton" class="btn save-btn ml-5 ">حفظ</button>
                    </div>
                </div>
                <hr>
             </div>
        </div>
        </form>

            <div class="tab-pane fade " id="maintain" role="tabpanel" aria-labelledby="maintain-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                <div class="Mparent">

                    <div class="Tparent">



                        <div class="row m-4">



                            <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">

                                <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addDateModal2" data-toggle="modal">أضافة موعد صيانه </button>

                            </div>

                        </div>

                        <div class="row m-3 justify-content-center ">
                            <div class="col-lg-12 ">

                                <table class="table zadnatable mainTable" tableId="10">
                                    <thead>
                                        <tr>
                                            <th>الكود</th>
                                            <th>الوصف</th>
                                            <th>التاريخ</th>
                                            <th>التكرار</th>
                                            <th>لمدة</th>
                                            <th class="actions">
                                                <i class="fas fa-bars"></i>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr rowId="31">
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="text" class="form-control td-input" value="1" disabled>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="text" class="form-control td-input" value="1" disabled>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="text" class="form-control td-input" value="1" disabled>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="text" class="form-control td-input" value="مزارع" disabled>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group InputGroup">
                                                    <input type="text" class="form-control  td-input" value="محاسب" disabled>

                                                </div>
                                            </td>


                                            <td class="query-td">
                                                <i class="fas fa-eye view-row"></i>
                                            </td>

                                        </tr>
                                </table>
                            </div>
                        </div>
                        <div id="addDateModal2" class="modal fade " role="dialog" currtable>
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content modalbg-add">
                                    <div class="modal-header d-flex flex-row-reverse">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h5 class="modal-title text-center ">اضافه</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-4">

                                            <div class="col-12">
                                                <label class="col-4" for="descrep">الوصف:</label>
                                                <textarea id="descrep" class="col-val border-style col-6 "></textarea>

                                            </div>
                                        </div>
                                        <div class="row mb-4">

                                            <div class="col-12">
                                                <label class="col-4" for="date">التاريخ:</label>
                                                <input type="date" id="date" class="col-val border-style col-6 ">
                                            </div>
                                        </div>

                                        <div class="row mb-4">

                                            <div class="col-12">
                                                التكرار:
                                                <label class="span col-2 offset-1" for="every">كل</label>
                                                <input type="number" id="every" class=" col-val border-style col-2" min="0">
                                                <div class="  border-style col-4 float-right mr-4">
                                                    <select class="form-control col-val col-10 unit" value="اسبوع">
                                                        <option>يوم</option>
                                                        <option>اسبوع</option>
                                                        <option>شهر</option>
                                                        <option>سنه</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="span col-2 offset-2 mt-4" for="time">لمده</label>
                                                <input type="number" id="time" class=" col-val border-style col-2 ml-4" min="0">
                                                <span class="col-2">سنة</span>

                                            </div>

                                        </div>

                                        <br>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" id="saveDate" class="danger btn btn-primary btnSave ">حفظ</a>
                                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade " id="techni" role="tabpanel" aria-labelledby="techni-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                <div class="Mparent">

                    <!--table1    -->
                    <div class="Tparent">
                        <div class="row m-4">
                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div style="   cursor: pointer;" data-toggle="collapse" href="#collapseExample">
                                            <a class="fas fa-caret-left " style="color:green"></a>
                                            <span class="faults-types1"> المواسير: </span>

                                        </div>
                                        <hr class="weellight-hr1">
                                    </div>



                                </div>


                                <div class="collapse   table-responsive " id="collapseExample">


                                    <div class="row p-0 m-0">
                                        <div class="col-md-2 offset-8">

                                            <div class="button-cont">
                                                <input type="file" name="file-2[]" id="file-2" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"
                                                    multiple />
                                                <label for="file-2">
                                                    <span>تحميل ملف&hellip;</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal" data-toggle="modal">إضافة</button>
                                        </div>

                                    </div>
                                    <table class="table  table-bordered table2 mainTable " tableid="11">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th scope="col">الكود</th>
                                                <th scope="col">النوع</th>
                                                <th scope="col">القطر</th>
                                                <th scope="col">الطول</th>
                                                <th scope="col">الوصف</th>
                                                <th scope="col">
                                                    <i class="fas fa-bars"></i>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr rowid="1">
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="444" disabled> </div>
                                                </td>

                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>

                                                    <i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target="#addModal"></i>

                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--table2    -->
                    <div class="Tparent">
                        <div class="row m-4">
                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div style="   cursor: pointer;" data-toggle="collapse" href="#collapseExample1">
                                            <a class="fas fa-caret-left " style="color:green"></a>
                                            <span class="faults-types1"> الغلاف الخارجى للمواسير: </span>

                                        </div>
                                        <hr class="weellight-hr1">
                                    </div>




                                </div>



                                <div class="collapse   table-responsive" id="collapseExample1">
                                    <div class="row p-0 m-0">
                                        <div class="col-md-2 offset-8">

                                            <div class="button-cont">
                                                <input type="file" name="file-3[]" id="file-3" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"
                                                    multiple />
                                                <label for="file-3">
                                                    <span>تحميل ملف&hellip;</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal" data-toggle="modal">إضافة</button>
                                        </div>

                                    </div>
                                    <table class="table  table-bordered table2 mainTable" tableid="12">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th scope="col">الكود</th>
                                                <th scope="col">النوع</th>
                                                <th scope="col">القطر</th>
                                                <th scope="col">الطول</th>
                                                <th scope="col">الوصف</th>
                                                <th scope="col">
                                                    <i class="fas fa-bars"></i>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr rowid="2">

                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="444" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="نوع1" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="5_سم" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="20_كم" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="وصف1" disabled>

                                                    </div>
                                                </td>
                                                <td>

                                                    <i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target="#addModal"></i>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--add pipe modal-->
                    <div id="addModal" class="modal fade" role="dialog" currTable viewrow>
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content modalbg-add">
                                <div class="modal-header d-flex flex-row-reverse">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h5 class="modal-title text-center ">اضافة</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <label class="col-4" for="type1">النوع:</label>
                                            <div class="form-group  col-3 float-right m-0 p-0 ">
                                                <select class="form-control " id="type1" value="1">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                            <div class="form-group  col-3 float-right m-0 p-0 " style="margin-left: 4.5rem!important;">
                                                <select class="form-control col-val " value="1">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>



                                        </div>

                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <label class="col-4" for="Diameter">القطر:</label>
                                            <input type="number" id="Diameter" class="col-val border-style col-3 mes" min="0">
                                            <select class="form-control unit col-3 float-right col-val " value="سم">
                                                <option>سم</option>
                                                <option>مم</option>
                                                <option>كم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col">
                                            <label class="col-4" for="len">الطول:</label>
                                            <input type="number" id="len" class="col-val border-style col-3 mes" min="0">
                                            <select class="form-control unit col-3 float-right col-val" value="سم">
                                                <option>سم</option>
                                                <option>مم</option>
                                                <option>كم</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <label class="col-4" for="desc">الوصف:</label>
                                            <input type="text" id="desc" class="col-val border-style col-6 mes">

                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a href="#" id="btnSave" class="danger btn btn-primary btnSave ">حفظ</a>
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="Mparent">
                    <div class="Tparent">
                        <!--table3    -->
                        <div class="row m-4">
                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div style="   cursor: pointer;" data-toggle="collapse" href="#collapseExample2">
                                            <a class="fas fa-caret-left " style="color:green"></a>
                                            <span class="faults-types1"> المولد: </span>

                                        </div>
                                        <hr class="weellight-hr1">
                                    </div>
                                </div>
                                <div class="collapse   table-responsive" id="collapseExample2">
                                    <div class="row p-0 m-0">
                                        <div class="col-md-2 offset-8">

                                            <div class="button-cont">
                                                <input type="file" name="file-4[]" id="file-4" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"
                                                    multiple />
                                                <label for="file-4">
                                                    <span>تحميل ملف&hellip;</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal2" data-toggle="modal">إضافة</button>
                                        </div>

                                    </div>
                                    <table class="table  table-bordered table2 mainTable " tableid="13">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th scope="col">الكود</th>
                                                <th scope="col">النوع</th>
                                                <th scope="col">القدره</th>
                                                <th scope="col">الوصف</th>
                                                <th scope="col">جدول الصيانه</th>
                                                <th scope="col">
                                                    <i class="fas fa-bars"></i>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="static-col">
                                            <tr rowid="3">
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="444" disabled> </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <p data-toggle="modal" data-target="#MaintainModal" style="text-decoration: underline">قراءه </p>
                                                </td>
                                                <td>

                                                    <i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target="#addModal2"></i>


                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="Tparent">
                        <!--table4    -->
                        <div class="row m-4">
                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <div class="row mt-4 ">
                                    <div class="col-md-3">
                                        <div style="   cursor: pointer;" data-toggle="collapse" href="#collapseExample3">
                                            <a class="fas fa-caret-left " style="color:green"></a>
                                            <span class="faults-types1">الطرمبة :</span>

                                        </div>
                                        <hr class="weellight-hr1">
                                    </div>



                                </div>



                                <div class="collapse  table-responsive" id="collapseExample3">
                                    <div class="row p-0 m-0">
                                        <div class="col-md-2 offset-8">

                                            <div class="button-cont">
                                                <input type="file" name="file-5[]" id="file-5" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"
                                                    multiple />
                                                <label for="file-5">
                                                    <span>تحميل ملف&hellip;</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal2" data-toggle="modal">إضافة</button>
                                        </div>

                                    </div>
                                    <table class="table  table-bordered table2 mainTable " tableid="14">
                                        <thead style="text-align: center">
                                            <tr>
                                                <th scope="col">الكود</th>
                                                <th scope="col">النوع</th>
                                                <th scope="col">القدره</th>
                                                <th scope="col">الوصف</th>
                                                <th scope="col">جدول الصيانه</th>
                                                <th scope="col">
                                                    <i class="fas fa-bars"></i>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="static-col">
                                            <tr rowid="4">
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" value="444" disabled> </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control  td-input" disabled>

                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="text" class="form-control td-input" disabled>

                                                    </div>
                                                </td>
                                                <td>
                                                    <p data-toggle="modal" data-target="#MaintainModal" style="text-decoration: underline">قراءه </p>
                                                </td>
                                                <td>

                                                    <i class="fas fa-eye view-row" title="View" data-toggle="modal" data-target="#addModal2"></i>


                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="addModal2" class="modal fade less-culs" role="dialog" currTable viewrow>
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content modalbg-add">
                                <div class="modal-header d-flex flex-row-reverse">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h5 class="modal-title text-center ">اضافة</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <label class="col-4" for="type">النوع:</label>
                                            <div class="form-group  col-3 float-right m-0 p-0 ">
                                                <select class="form-control col-val  " id="type" value="1">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                            <div class="form-group  col-3 float-right m-0 p-0 " style="margin-left: 4.5rem!important;">
                                                <select class="form-control " value="1">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-12">
                                            <label class="col-4" for="ability">القدره:</label>
                                            <input type="text" id="ability" class="border-style col-6 col-val mes">
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col">
                                            <label class="col-4" for="descr">الوصف:</label>
                                            <input type="text" id="descr" class="border-style col-6 col-val mes">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#"  class="danger btn btn-primary btnSave ">حفظ</a>
                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--add pipe modal-->
        <div id="addModal" class="modal fade" role="dialog" currTable>
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">اضافة</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="type1">النوع:</label>
                                <input type="text" id="type1" class="border-style col-6">

                            </div>

                        </div>
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="Diameter">القطر:</label>
                                <input type="text" id="Diameter" class="border-style col-6">
                            </div>
                        </div>

                        <br>
                        <div class="row mb-4">

                            <div class="col">
                                <label class="col-4" for="len">الطول:</label>
                                <input type="text" id="len" class="border-style col-6">

                            </div>

                        </div>
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="desc">الوصف:</label>
                                <input type="text" id="desc" class="border-style col-6">

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" id="btnSave" class="danger btn btn-primary btnSave ">حفظ</a>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>
        <div id="addModal2" class="modal fade" role="dialog" currTable>
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">اضافة</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="type">النوع:</label>
                                <input type="text" id="type" class="border-style col-6">

                            </div>

                        </div>
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="ability">القدره:</label>
                                <input type="text" id="ability" class="border-style col-6">
                            </div>
                        </div>

                        <br>
                        <div class="row mb-4">

                            <div class="col">
                                <label class="col-4" for="descr">الوصف:</label>
                                <input type="text" id="descr" class="border-style col-6">

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#"  class="danger btn btn-primary btnSave ">حفظ</a>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>
        <div id="MaintainModal" class="modal fade" currTabletabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modalbg" >
                    <div class="modal-header modal-border">
                        <h5 class="modal-title">جدول الصيانه </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 432px;">
                        <div class="Mparent">

                            <div class="Tparent">



                                <div class="row m-4">



                                    <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">

                                        <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addDateModal3" data-toggle="modal">أضافة موعد صيانه </button>

                                    </div>

                                </div>

                                <div class="row m-3 justify-content-center ">
                                    <div class="col-lg-12 ">

                                        <table class="table zadnatable mainTable" tableId="15">
                                            <thead>
                                                <tr>
                                                    <th>الكود</th>
                                                    <th>الوصف</th>
                                                    <th>التاريخ</th>
                                                    <th>التكرار</th>
                                                    <th>لمدة</th>
                                                    <th class="actions">
                                                        <i class="fas fa-bars"></i>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                <tr rowId="35">
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" class="form-control td-input" value="1" disabled>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" class="form-control td-input" value="1" disabled>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" class="form-control td-input" value="1" disabled>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" class="form-control td-input" value="مزارع" disabled>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" class="form-control  td-input" value="محاسب" disabled>

                                                        </div>
                                                    </td>


                                                    <td class="query-td">
                                                        <i class="fas fa-eye view-row"></i>
                                                    </td>

                                                </tr>








                                        </table>
                                    </div>




                                </div>


                                <div id="addDateModal3" class="modal fade" role="dialog" currtable>
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content modalbg-add">
                                            <div class="modal-header d-flex flex-row-reverse">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h5 class="modal-title text-center ">اضافه</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-4">

                                                    <div class="col-12">
                                                        <label class="col-4" for="descrep">الوصف:</label>
                                                        <textarea id="descrep" class="col-val border-style col-6 "></textarea>

                                                    </div>
                                                </div>
                                                <div class="row mb-4">

                                                    <div class="col-12">
                                                        <label class="col-4" for="date">التاريخ:</label>
                                                        <input type="date" id="date" class="col-val border-style col-6 ">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">

                                                    <div class="col-12">
                                                        التكرار:
                                                        <label class="span col-2 offset-1" for="every">كل</label>
                                                        <input type="number" id="every" class=" col-val border-style col-2" min="0">
                                                        <div class="  border-style col-4 float-right mr-4">
                                                            <select class="form-control col-val col-10 unit" value="اسبوع">
                                                                <option>يوم</option>
                                                                <option>اسبوع</option>
                                                                <option>شهر</option>
                                                                <option>سنه</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="span col-2 offset-2 mt-4" for="time">لمده</label>
                                                        <input type="number" id="time" class=" col-val border-style col-2 ml-4" min="0">
                                                        <span class="col-2">سنة</span>

                                                    </div>

                                                </div>

                                                <br>

                                            </div>
                                            <div class="modal-footer ">
                                                <a href="#"  class="danger btn btn-primary btnSave">حفظ</a>
                                                <a href="#"  aria-hidden="true" class="btn btn-danger btn-cancel">الغاء</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="modal-footer footer-border mt-5">
                            <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="addDateModal" class="modal fade" role="dialog" currTable>
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">اضافه موعد صيانه</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="descrep">الوصف:</label>
                                <input type="text" id="descrep" class="border-style col-6">

                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col-12">
                                <label class="col-4" for="date">التاريخ:</label>
                                <input type="date" id="date" class="border-style col-6">
                            </div>
                        </div>

                        <div class="row mb-4">

                            <div class="col-12">
                                التكرار:
                                <label class="span col-2 offset-1" for="every">كل</label>
                                <input type="text" id="every" class="border-style col-2">
                                <label class="span col-2" for="time">لمده</label>
                                <input type="text" id="time" class="border-style col-2">

                            </div>

                        </div>

                        <br>

                    </div>
                    <div class="modal-footer ">
                        <a href="#"  class="danger btn btn-primary btnSave ">حفظ</a>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>

</section>
@endsection