@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/add-well.css">
@endsection
@section('page_script')
<script>
    $(function () {
      $(".select2").select2();
    });
    var report={{$report }};
    var operation_page=1;

  </script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

@include('pages.backEnd.AllModuels')
  <!--بدايه اصناف المحصول-->
  <section class="content cropType">
    <div class="top-bar">
        <h6>اعدات عامة > الابار > تعديل بئر</h6>
    </div>

    <div class="row m-4">
        <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
            <li class="nav-item selected">
                <a class="nav-link linkColor active show" id="puplic-tab" data-toggle="tab" href="#puplic" role="tab" aria-controls="puplic"
                    aria-selected="true" style="border: none;
padding: 4px;
font-size: 22px;">المواصفات العامة</a>
            </li>

            @if($operation_page)
                <li class="nav-item ">
                    <a class="nav-link linkColor " id="water-tab" data-toggle="tab" href="#water" role="tab" aria-controls="water" aria-selected="false"
                        style="border: none;padding: 4px; font-size: 22px;">كميه المياه</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link linkColor " id="analyse-tab" data-toggle="tab" href="#analyse" role="tab" aria-controls="analyse" aria-selected="false" style="border: none; padding: 4px; font-size: 22px;">تحليل المياه</a>
                </li>
            @endif

            @if($healper->check_permission(8,7))
            <li class="nav-item ">
                <a class="nav-link  linkColor " id="maintain-tab" data-toggle="tab" href="#maintain" role="tab" aria-controls="Gdetails" aria-selected="true" style="border: none;padding: 4px;font-size: 22px;">الصيانه الدورية</a>
            </li>
            @endif

            @if($healper->check_permission(8,12))
            <li class="nav-item ">
                <a class="nav-link linkColor " id="techni-tab" data-toggle="tab" href="#techni" role="tab" aria-controls="water" aria-selected="false"
                    style="border: none;padding: 4px;font-size: 22px;">المواصفات الفنيه</a>
            </li>
            @endif

            @if($operation_page)
                    <li class="nav-item ">
                        <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="analyse" aria-selected="false"
                            style="border: none;padding: 4px;font-size: 22px;">موارد العمليات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true"
                            style="border: none;padding: 4px;font-size: 22px;">الملاحظات</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="analyse" aria-selected="false"
                            style="border: none;padding: 4px;font-size: 22px;">توصيات</a>
                    </li>
            @endif
        </ul>



        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="puplic" role="tabpanel" aria-labelledby="puplic-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                <form id="EditWellForm" method="POST" style="width: 100%;">
                    <input type="hidden" name="id" id="id" value="{{$info->id}}">
                <div class="weels m-5">
                    <div class="row p-4 m-2">
                        <div class="col-md-3 col-xs-12">
                            <label>الاسم</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="" value="{{ $info->title }}" name="title" class="form-control numric">
                            </div>
                            <div id="title_demo"></div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <label>الحالة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <select class="form-control filter-form" name="status">
                                    <option selected disabled>Select Status</option>
                                    @foreach ($type_well as $key=>$value)
                                    <option value="{{ $key }}" @if($info->status==$key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="status_demo"></div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <label>تاريخ الحفر</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="date" name="date_of_excavation" value="{{ $info->date_of_excavation }}" class="form-control numric">
                            </div>
                            <div id="date_of_excavation_demo"></div>
                        </div>

                    </div>

                    <div class="row p-4 m-2">
                        <div class="col-md-3 col-xs-12">
                            <label>
                                الاحداثيات</label>
                            <hr>
                            <td class="InputNum td-rep" >


                                <div class="form-group ">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" name="point1" value="{{$point1}}" class="form-control numric loc"
                                                   placeholder="نقطه1">
                                            <div id="point1_demo"></div>
                                        </div>

                                        <div id="point2_demo"></div>
                                        <div class="col-sm-7">
                                            <div class="box_point1">
                                                <div class="row">
                                                    <div class="col-sm-3 p-0">
                                                        <input type="text" name="north" value="{{$location_north[0]}}" class="form-control numric loc"
                                                               placeholder="شمال ">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="degree[]" type="text" value="{{$location_north[1]}}" class="form-control numric loc1"
                                                               placeholder="درجه">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="minute[]" type="text" value="{{$location_north[2]}}" class="form-control numric loc1"
                                                               placeholder="دقيقه">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="second[]" type="text" value="{{$location_north[3]}}" class="form-control numric loc1"
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
                                                        <input type="text" name="east" value="{{$location_east[0]}}"  class="form-control numric loc"
                                                               placeholder="شرق ">
                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="degree[]" type="text" value="{{$location_east[1]}}"  class="form-control numric loc1"
                                                               placeholder="درجه">

                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="minute[]" type="text" value="{{$location_east[2]}}"  class="form-control numric loc1"
                                                               placeholder="دقيقه">

                                                    </div>
                                                    <div class="col-sm-3 p-0">

                                                        <input name="second[]" type="text" value="{{$location_east[3]}}"  class="form-control numric loc1"
                                                               placeholder="ثانيه">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <div id="locations_demo"></div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <label>العمق</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="depth" value="{{ $info->depth }}" name="config[depth]" class="form-control numric">
                            </div>
                            <div id="depth_demo"></div>
                        </div>

                        <div class="col-md-3 col-xs-12">
                            <label>قطر البئر</label>
                            <hr>
                            <!--                ذودت قطر البئر-->
                            <div class="form-group InputGroup">
                                <input type="text" value="{{ $info->well_radius }}" name="config[well_radius]" value{{$info->well_radius}} class="form-control numric">

                            </div>
                        </div>

                        <div class="col-md-3 col-xs-12">
                            <label>التكلفة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="cost" value="{{ $info->cost }}" name="config[cost]" class="form-control numric">
                            </div>
                            <div id="cost_demo"></div>
                        </div>
                    </div>
                    <div class="row p-4 m-2">
                        <div class="col-md-6 col-xs-12">
                            <label>الاحد الادنى لكمية المياة</label>
                            <hr>
                            <div class="form-group InputGroup">
                                <input type="text" id="minimum_water_quantity" class="form-control numric" value="{{ $info->minimum_water_quantity }}" name="config[minimum_water_quantity]" id="well-lowest-amount-of-water">
                            </div>
                            <div id="minimum_water_quantity_demo"></div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>الملف الجيولوجى للبئر </label>
                            <hr>
                            <div class="button-cont">
                                
                                <input type="file" name="geological_profile_file" id="file-0" class="inputfile  inputfile-1 "
                                     />
                                    
                                <label for="file-0">
                                    <span>تحميل ملف&hellip;</span>
                                </label>
                                <a target="_blank" href="{{asset('public/images/Uploads/well/'.str_replace(' ','',$info->geological_profile_file)  )}}"> الملف </a>
                                <label class="water-date-lable">تاريخ</label>
                                <input name="config[geological_profile_date]" value="{{ $info->geological_profile_date }}"  type="date" class="water-date numric">

                            </div>

                        </div>

                    </div>
                    <table class="table tableborder">

                        <thead>
                        <tr>
                            <th scope="col" style="text-align: right;">الملاحظات</th>
                            @if($operation_page)
                                <th>توقيع </th>
                                <th> ملف توقيع </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="InputNum" style="width: 60%">
                                <div class="form-group">
                                    <input type="text" name="config[note]" value="{{ $info->note }}" class="form-control numric">                                </div>
                            </td>
                            @if($operation_page)
                                <td>
                                    <input type="checkbox" name="signed" value="1" @if($info->signed==1) checked @endif title="توقيع البير">
                                </td>
                                <td>
                                    <input type="file" data-id="form_upload" name="signed_file" id="file-1" class="inputfile inputfile-1"
                                    />
                                    <label for="file-1">
                                        <span>تحميل ملف&hellip;</span>
                                    </label>
                                    <a target="_blank" href="{{asset('public/images/Uploads/well/'.@$info->signed_file )}}"  id="uploaded_file">الملف</a>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
                </form>

                <div class="row">
                    <div class="col pl-5">
                        @if($healper->check_permission(8,6))
                            <button type="button" class="btn save-btn ml-5 " id="SubmitButton">حفظ</button>
                        @endif
                    </div>
                </div>
                <hr>
                </div>


                @if($operation_page)
                    <div class="tab-pane fade  " id="water" role="tabpanel" aria-labelledby="water-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <div class="Tparent">
                            <div class="row m-3 justify-content-center ">
                                <div class="col-lg-12 ">
                                    <table class="table zadnatable mainTable" style="    margin: 45px auto;    width: 60%;">
                                        <thead>
                                            <tr>
                                                <th>كمية المياه</th>
                                                <th>تاريخ</th>
                                                @if($healper->check_permission(8,2))
                                                <th class="actions">
                                                    <i class="far fa-plus-square" data-target="#QuantityWaterModel" data-toggle="modal" style="cursor: pointer"></i>
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($water_quantity as $value)
                                                <tr>
                                                    <th>{{ $value->qyt }} لتر</th>
                                                    <th>{{ date('Y-m-d',strtotime($value->datetime)) }}</th>
                                                    @if($healper->check_permission(8,2))
                                                    <th class="actions">
                                                        <button type="button" class="delete_statistics_water"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                    </th>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="analyse" role="tabpanel" aria-labelledby="analyse-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                        <div class="row m-3 justify-content-center ">
                            <div class="col-lg-12 ">

                                <table class="table zadnatable mainTable" style="    margin: 45px auto;    width: 60%;">
                                    <thead>
                                        <tr>
                                            <th>ملف</th>
                                            <th>تاريخ</th>
                                            @if($healper->check_permission(8,2))
                                            <th class="actions">
                                                <i class="far fa-plus-square" data-target="#AnalysisWaterModel" data-toggle="modal" style="cursor: pointer"></i>
                                            </th>
                                                @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($water_analysis as $value)
                                            <tr>
                                                <th><a href="{{ url('public//images/Uploads/well/') . '/' . $value->file }}" >ملف</a></th>
                                                <th>{{ date('Y-m-d',strtotime($value->datetime)) }}</th>
                                                @if($healper->check_permission(8,2))
                                                <th class="actions">
                                                    <button type="button" class="delete_statistics_water"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                </th>
                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                @endif


                    <div class="tab-pane fade " id="maintain" role="tabpanel" aria-labelledby="maintain-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <div class="Mparent">

                            <div class="Tparent">
                                <div class="row m-4">
                                    @if($healper->check_permission(8,8))
                                    <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                                        <button type="button" class="add-crepto mr-2 mb-2 addNewRow " data-target="#addDateModal2" data-toggle="modal">أضافة موعد صيانه </button>
                                    </div>
                                     @endif
                                </div>
                                <div class="row m-3 justify-content-center ">
                                    <div class="col-lg-12 ">
                                            @php
                                                $test_duration=[
                                                    1=>'يوم',
                                                    2=>'اسبوع',
                                                    3=>'شهر',
                                                    4=>'سنه',
                                                ];
                                            @endphp
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
                                                @foreach ($info->WellTest as $value)
                                                    <tr>
                                                        <td>{{ $value->code }}</td>
                                                        <td>{{ $value->title }}</td>
                                                        <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                                        <td>{{ $value->test_num }}  {{ $test_duration[$value->test_duration] }}</td>
                                                        <td>{{ $value->extension }} سنة</td>
                                                        <td class="query-td">
                                                            @if($healper->check_permission(8,9))
                                                              <button type="button" class="delete_test"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

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
                                                <form action="POST" id="WellTestAdd">
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <label class="col-4" for="descrep">الوصف:</label>
                                                            <textarea id="descrep" class="col-val border-style col-6" name="title"></textarea>
                                                            <input type="hidden" name="well_id" value="{{ $info->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <label class="col-4" for="date">التاريخ:</label>
                                                            <input type="date" id="date" class="col-val border-style col-6" name="datetime">
                                                            <div id="datem_demo"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            التكرار:
                                                            <label class="span col-2 offset-1" for="every">كل</label>
                                                            <input type="number" name="test_num" id="every" class=" col-val border-style col-2" min="0">
                                                            <div id="test_num_demo"></div>
                                                            <div class="  border-style col-4 float-right mr-4">
                                                                <select name="test_duration" class="form-control col-val col-10 unit">
                                                                    @foreach ($test_duration as $key=>$value)
                                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div id="test_duration_demo"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="span col-2 offset-2 mt-4" for="time">لمده</label>
                                                            <input name="extension" type="number" id="time" class=" col-val border-style col-2 ml-4" min="0">
                                                            <div id="extension_demo"></div>
                                                            <span class="col-2">سنة</span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="saveDateTest" type="button" class="danger btn btn-primary btnSave ">حفظ</button>
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
                                                    @if($healper->check_permission(13,2))
                                                    {{--<div class="button-cont">--}}
                                                        {{--<input type="file" name="file-2[]" id="file-2" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"--}}
                                                            {{--multiple />--}}
                                                        {{--<label for="file-2">--}}
                                                            {{--<span>تحميل ملف&hellip;</span>--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                    @endif
                                                </div>
                                                @if($healper->check_permission(13,1))
                                                <div class="col-md-2">
                                                    <button type="button" class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal" data-toggle="modal">إضافة</button>
                                                </div>
                                               @endif

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
                                                    @foreach ($info->Pipes as $value)
                                                        <tr rowid="1">
                                                            <td> {{ $value->code }} </td>
                                                            <td> {{ $WellTech_type_Pipes[$value->type] }} </td>
                                                            <td> {{ $value->diameter }} </td>
                                                            <td> {{ $value->length }} </td>
                                                            <td> {{ $value->desc }} </td>
                                                            <td>
                                                                <button class="delete_Tec" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

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
                                                    @if($healper->check_permission(13,2))
                                                    {{--<div class="button-cont">--}}
                                                        {{--<input type="file" name="file-3[]" id="file-3" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"--}}
                                                            {{--multiple />--}}
                                                        {{--<label for="file-3">--}}
                                                            {{--<span>تحميل ملف&hellip;</span>--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                   @endif
                                                </div>
                                                @if($healper->check_permission(13,1))
                                                <div class="col-md-2">
                                                    <button type="button" class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal12" data-toggle="modal">إضافة</button>
                                                </div>
                                                    @endif

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
                                                    @foreach ($info->External_pipes_coating as $value)
                                                        <tr rowid="1">
                                                            <td> {{ $value->code }} </td>
                                                            <td> {{ $WellTech_type_External_pipes_coating[$value->type] }} </td>
                                                            <td> {{ $value->diameter }} </td>
                                                            <td> {{ $value->length }} </td>
                                                            <td> {{ $value->desc }} </td>
                                                            <td>
                                                                <button class="delete_Tec" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                            <form action="POST" id="WellPipesAdd">
                                            <input type="hidden" name="tec_type" value="1">
                                            <input type="hidden" name="well_id" value="{{ $info->id }}">
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <label class="col-4" for="type1">النوع:</label>
                                                    <div class="form-group  col-3 float-right m-0 p-0 ">
                                                        <select class="form-control" name="type" id="type1" value="1">
                                                            @foreach ($WellTech_type_Pipes as $key=>$value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="Diameter">القطر:</label>
                                                    <input type="number" name="diameter" id="Diameter" class="col-val border-style col-3 mes" min="0">
                                                    كم
                                                </div>
                                            </div>

                                            <div class="row mb-4">

                                                <div class="col">
                                                    <label class="col-4" for="len">الطول:</label>
                                                    <input type="number" name="length" id="len" class="col-val border-style col-3 mes" min="0">
                                                    كم
                                                </div>

                                            </div>
                                            <div class="row mb-4">

                                                <div class="col-12">
                                                    <label class="col-4" for="desc">الوصف:</label>
                                                    <input type="text" name="desc" id="desc" class="col-val border-style col-6 mes">

                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveDatePipes" class="danger btn btn-primary btnSave ">حفظ</button>
                                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="addModal12" class="modal fade" role="dialog" currTable viewrow>
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content modalbg-add">
                                            <div class="modal-header d-flex flex-row-reverse">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h5 class="modal-title text-center ">اضافة</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="POST" id="WellExternalPipesAdd">
                                                <input type="hidden" name="tec_type" value="2">
                                                <input type="hidden" name="well_id" value="{{ $info->id }}">
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <label class="col-4" for="type1">النوع:</label>
                                                        <div class="form-group  col-3 float-right m-0 p-0 ">
                                                            <select class="form-control" name="type" id="type1" value="1">
                                                                @foreach ($WellTech_type_External_pipes_coating as $key=>$value)
                                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb-4">

                                                    <div class="col-12">
                                                        <label class="col-4" for="Diameter">القطر:</label>
                                                        <input type="number" name="diameter" id="Diameter" class="col-val border-style col-3 mes" min="0">
                                                        كم
                                                    </div>
                                                </div>

                                                <div class="row mb-4">

                                                    <div class="col">
                                                        <label class="col-4" for="len">الطول:</label>
                                                        <input type="number" name="length" id="len" class="col-val border-style col-3 mes" min="0">
                                                        كم
                                                    </div>

                                                </div>
                                                <div class="row mb-4">

                                                    <div class="col-12">
                                                        <label class="col-4" for="desc">الوصف:</label>
                                                        <input type="text" name="desc" id="desc" class="col-val border-style col-6 mes">

                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="saveDateExternalPipes" class="danger btn btn-primary btnSave ">حفظ</button>
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
                                                    @if($healper->check_permission(13,2))
                                                    {{--<div class="button-cont">--}}
                                                        {{--<input type="file" name="file-4[]" id="file-4" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"--}}
                                                            {{--multiple />--}}
                                                        {{--<label for="file-4">--}}
                                                            {{--<span>تحميل ملف&hellip;</span>--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                    @endif
                                                </div>
                                                @if($healper->check_permission(13,1))
                                                <div class="col-md-2">
                                                    <button type="button" class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal2" data-toggle="modal">إضافة</button>
                                                </div>
                                                @endif

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
                                                        @foreach ($info->Generator as $value)
                                                        <tr rowid="1">
                                                            <td> {{ $value->code }} </td>
                                                            <td> {{ $WellTech_type_Generator[$value->type] }} </td>
                                                            <td> {{ $value->ability }} </td>
                                                            <td> {{ $value->desc }} </td>
                                                            <td>
                                                                <p data-toggle="modal" class="show_tec_test" data-id="{{ $value->id }}"  style="text-decoration: underline">قراءه </p>
                                                            </td>
                                                            <td>
                                                                <button class="delete_Tec" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                                    @if($healper->check_permission(13,2))
                                                    {{--<div class="button-cont">--}}
                                                        {{--<input type="file" name="file-5[]" id="file-5" class="inputfile  inputfile-1 " data-multiple-caption="{count} files selected"--}}
                                                            {{--multiple />--}}
                                                        {{--<label for="file-5">--}}
                                                            {{--<span>تحميل ملف&hellip;</span>--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                   @endif
                                                </div>
                                                @if($healper->check_permission(13,1))
                                                <div class="col-md-2">
                                                    <button type="button" class="add-crepto mr-2 mb-2 addNewRow2 " data-target="#addModal21" data-toggle="modal">إضافة</button>
                                                </div>
                                                    @endif

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
                                                    @foreach ($info->Trumpet as $value)
                                                        <tr rowid="1">
                                                            <td> {{ $value->code }} </td>
                                                            <td> {{ $WellTech_type_Trumpet[$value->type] }} </td>
                                                            <td> {{ $value->ability }} </td>
                                                            <td> {{ $value->desc }} </td>
                                                            <td>
                                                                    <p data-toggle="modal" class="show_tec_test" data-id="{{ $value->id }}"  style="text-decoration: underline">قراءه </p>
                                                                </td>
                                                            <td>
                                                                <button class="delete_Tec" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

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
                                            <form action="POST" id="WellGeneratorAdd">
                                                <input type="hidden" name="tec_type" value="3">
                                                <input type="hidden" name="well_id" value="{{ $info->id }}">
                                                <div class="row mb-4">
                                                        <div class="col-12">
                                                                <label class="col-4" for="type1">النوع:</label>
                                                                <div class="form-group  col-3 float-right m-0 p-0 ">
                                                                    <select class="form-control" name="type" id="type1" value="1">
                                                                        @foreach ($WellTech_type_Generator as $key=>$value)
                                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <label class="col-4" for="ability">القدره:</label>
                                                            <input type="text" name="ability" id="ability" class="border-style col-6 col-val mes">
                                                        </div>
                                                        <div id="ability_demo"></div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <label class="col-4" for="descr">الوصف:</label>
                                                            <input type="text" name="desc" id="descr" class="border-style col-6 col-val mes">
                                                        </div>
                                                    </div>
                                                <div id="desc_demo"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveDateGenerator"  class="danger btn btn-primary btnSave ">حفظ</button>
                                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="addModal21" class="modal fade less-culs" role="dialog" currTable viewrow>
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content modalbg-add">
                                            <div class="modal-header d-flex flex-row-reverse">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h5 class="modal-title text-center ">اضافة</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="POST" id="WellTrumpetAdd">
                                                    <input type="hidden" name="tec_type" value="4">
                                                    <input type="hidden" name="well_id" value="{{ $info->id }}">
                                                    <div class="row mb-4">
                                                            <div class="col-12">
                                                                    <label class="col-4" for="type1">النوع:</label>
                                                                    <div class="form-group  col-3 float-right m-0 p-0 ">
                                                                        <select class="form-control" name="type" id="type1" value="1">
                                                                            @foreach ($WellTech_type_Generator as $key=>$value)
                                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                        </div>

                                                        <div class="row mb-4">

                                                            <div class="col-12">
                                                                <label class="col-4" for="ability">القدره:</label>
                                                                <input type="text" name="ability" id="ability" class="border-style col-6 col-val mes">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">

                                                            <div class="col">
                                                                <label class="col-4" for="descr">الوصف:</label>
                                                                <input type="text" name="desc" id="descr" class="border-style col-6 col-val mes">
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="saveDateTrumpet"  class="danger btn btn-primary btnSave ">حفظ</button>
                                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>

                    @if($operation_page)
                        @php
                        $process_array=[
                                'moduel_id'=>10
                            ];
                        @endphp
                        @include('pages.backEnd.Operations.process',$process_array)
                    @endif

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
                                        <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addDateModal3" data-toggle="modal">أضافة موعد صيانه  </button>
                                    </div>
                                </div>
                                <div class="row m-3 justify-content-center ">
                                    <div class="col-lg-12 ">
                                        <table class="table zadnatable" id="TestTableGenrator" tableId="15">
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
                                                <form action="POST" id="WellTecTestAdd">
                                                    <input type="hidden" id="well_tec_specifications_id" name="well_tec_specifications_id">
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <label class="col-4" for="descrep">الوصف:</label>
                                                        <textarea name="title" id="descrep" class="col-val border-style col-6 "></textarea>
                                                    </div>
                                                </div>
                                                    <div id="title_demo"></div>
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <label class="col-4" for="date">التاريخ:</label>
                                                        <input type="date" name="datetime" id="date" class="col-val border-style col-6 ">
                                                    </div>
                                                </div>
                                                 <div id="datetime_demo"></div>
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        التكرار:
                                                        <label class="span col-2 offset-1" for="every">كل</label>
                                                        <input name="test_num" type="number" id="every" class=" col-val border-style col-2" min="0">
                                                        <div class="  border-style col-4 float-right mr-4">
                                                            <select name="test_duration" class="form-control col-val col-10 unit">
                                                                <option value="1">يوم</option>
                                                                <option value="2">اسبوع</option>
                                                                <option value="3">شهر</option>
                                                                <option value="4">سنه</option>
                                                            </select>
                                                            <div id="test_duration_demo"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="span col-2 offset-2 mt-4" for="time">لمده</label>
                                                        <input type="number" name="extension" id="time" class=" col-val border-style col-2 ml-4" min="0">
                                                        <div id="extension_demo"></div>
                                                        <span class="col-2">سنة</span>
                                                    </div>
                                                </div>
                                            </form>
                                                <br>

                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" id="saveDateTecTest" class="danger btn btn-primary btnSave">حفظ</button>
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
                        <h5 class="modal-title text-center ">سيياضافه موعد صيانه</h5>
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