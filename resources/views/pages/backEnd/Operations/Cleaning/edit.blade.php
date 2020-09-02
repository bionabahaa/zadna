@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
        var report = false;
        var level_id = 1;
    var operation_page=1;
  </script>
<script src="{{ asset('public') }}/js/backEnd/cleaning.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
<div class="row m-0">
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
        <div>
            <div class="row  mt-0 mr-4 ml-4 mb-4">
                <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                    <li class="nav-item selected ">
                        <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails"
                            aria-selected="false" style="border: none;
        padding: 4px;
        font-size: 22px;">المواصفات العامة</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link linkColor " id="irrigPlane-tab" data-toggle="tab" href="#irrigPlane" role="tab" aria-controls="irrigPlane"
                            aria-selected="false" style="border: none;
        padding: 4px;
        font-size: 22px;">خطة الري</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="resource" aria-selected="false"
                            style="border: none;
        padding: 4px;
        font-size: 22px;">موارد عملية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true"
                            style="border: none;
        padding: 4px;
        font-size: 22px;">الملاحظات</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false"
                            style="border: none;
        padding: 4px;
        font-size: 22px;">توصيات</a>
                    </li>
                </ul>
                <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">
                    <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <form action="POST" id="EditCleaningForm">
                                    <input type="hidden" value="{{ $info->id }}" name="id" id="id">
                        <div class="row m-4 tab-top">
                               
                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <table class="table borderless table1">
                                    <thead>
                                        <tr>
                                        
                                            <th scope="col"> التنفيذ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border_bottom">
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" name="implementation" value="2" @if($info->implementation) checked @endif class="form-check-input td-edit" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1"></label>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-lg-12 col-sm-12 col-12 ">
                                <table class="table borderless table1 " style="margin-top: 7%">
                                    <thead>
                                        <tr>
                                            <th scope="col">عدد النخل</th>
                                            <th scope="col">تاريخ البدايه</th>
                                            <th scope="col">القائم بالتنفيذ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <tr class="border_bottom">
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input type="number" name="palm_tree" value="{{ $info->palm_tree }}" class="form-control numric td-edit">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-inline">
                                                        <div class="col-6">
                                                            من:
                                                            <input type="date" name="start_date" value="{{ $info->start_date }}" class="form-control numric td-edit" >
                                                        </div>
                                                        <br>
                                                        <div class="col-6">
                                                            :الى
                                                            <input type="date" name="end_date" value="{{ $info->end_date }}" class="form-control numric td-edit" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                            <select class="form-control filter-form filter1" name="user_id">
                                                                    <option value="">أختار الموظفين </option>
                                                                    @foreach ($Users as $value)
                                                                        <option value="{{ $value->id }}" @if($info->user_id==$value->id) selected @endif> {{ $value->username }}</option>
                                                                    @endforeach
                                                            </select>
                                                    </div>
                                                </td>
    
                                            </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>

                        <div class="col pl-5">

                            @if($healper->check_permission(18,6))
                                 <button id="SubmitButton" type="button" class="btn edit-btn ml-5" style="background-color:green">تعديل</button>
                            @endif
                            <button type="button" class="btn save-btn ml-5 save-edit-tabs " hidden="">حفظ</button>
                        </div>

                    </div>
                    <div class="tab-pane fade  " id="irrigPlane" role="tabpanel" aria-labelledby="irrigPlane-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <div class="Mparent">
                            <div class="Tparent">
                                <div class="row m-4">
                                    <div class="col-lg-2  col-6">
                                    </div>
                                    <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">
                                        <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addPlaneModal" data-toggle="modal">أضافة </button>
                                    </div>
                                </div>
                                <div class="row m-3 justify-content-center ">
                                    <div class="col-lg-12 ">
                                        <table class="table zadnatable mainTable notesTable" tableId="15">
                                            <thead>
                                                <tr>
                                                    <th>الكود</th>
                                                    <th>كمية المياه</th>
                                                    <th>التكرار</th>
                                                    <th>توقيت الري</th>
                                                    <th class="actions">
                                                        <i class="fas fa-bars"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($PlanningIrrigation as $value)
                                                    <tr>
                                                        <td>{{ $value->code }}</td>
                                                        <td>{{ $value->qyt }} لتر</td>
                                                        <td>{{ $value->repeat }}</td>
                                                        <td>{{ $value->irrigation_date }}</td>
                                                        <td><button class="delete_PlanningIrrigation"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="addPlaneModal" class="modal fade" role="dialog" currTable page-link="planting-tissue-view">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content modalbg-add">
                                            <div class="modal-header d-flex flex-row-reverse">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h5 class="modal-title text-center ">اضافة</h5>
                                            </div>
                                            <div class="modal-body">

                                                <form action="" id="PlanningIrrigation">
                                                    <input type="hidden" name="planting_id" value="{{ $info->id }}">
                                                    <div class="row mb-4">
                                                        {{--<div class="col-12 form-inline">--}}
                                                            {{--<label class="col-4" for="mahbs">المحبس</label>--}}
                                                            {{--<select name="irrigation_id" class="form-control col-val col-5 " id="mahbs" value="1">--}}
                                                                {{--@foreach ($Irrigation as $value)--}}
                                                                    {{--<option value="{{ $value->id }}">{{ $value->code }}</option>--}}
                                                                {{--@endforeach--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                        <div id="irrigation_id_demo"></div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4">فترة الري</label> من :
                                                            <input name="start_date_plan" type="date" class="border-style col-4 ">
                                                        </div>
                                                        <div id="start_date_plan_demo"></div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4"></label> الي :
                                                            <input name="end_date_plan" type="date" class="border-style col-4 ">
                                                        </div>
                                                        <div id="end_date_plan_demo"></div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4" for="Diameter">كمية المياه:</label>
                                                            <input name="qyt" type="number" id="Diameter" class="col-val border-style col-4 mr-4 mes">
                                                            <select class="form-control unit col-3 float-right col-val " value="سم">
                                                                <option>سم</option>
                                                            </select>
                                                        </div>
                                                        <div id="qyt_demo"></div>
                                                    </div>


                                                    <div class="row mb-4 ">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4">عدد مرات التكرار</label>
                                                            <input name="repeat" type="number" class="border-style col-4 col-val">
                                                        </div>
                                                        <div id="repeat_demo"></div>
                                                    </div>

                                                    <div class="row mb-4 form-inline">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4">توقيت الري</label>
                                                            <input name="irrigation_date" type="date" class="border-style col-4 col-val">
                                                        </div>
                                                        <div id="irrigation_date_demo"></div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12 form-inline">
                                                            <label class="col-4">الملاحظات</label>
                                                            <textarea name="note" class="border-style col-8 "></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="saveDataPlanningIrrigation" class="danger btn btn-primary btnSave ">حفظ</button>
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
                            'moduel_id'=>3,
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