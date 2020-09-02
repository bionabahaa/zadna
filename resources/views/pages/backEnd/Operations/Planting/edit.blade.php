@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var operation_page=1;
    var report=false;
  </script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/op-steps.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/add-type.js"></script>
<script src="{{ asset('public') }}/js/backEnd/planting.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{dd('hi')}}
    <div class="row m-0">
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
            <div>
                <div class="row  mt-0 mr-4 ml-4 mb-4">
                    <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                        <li class="nav-item selected ">
                            <a class="nav-link linkColor active " id="plant-tab" data-toggle="tab" href="#Gdetails"
                                role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">خطة الغرس</a>
                        </li>

                         <li class="nav-item ">
                            <a class="nav-link linkColor " id="irrigPlane-tab" data-toggle="tab" href="#irrigPlane"role="tab" aria-controls="irrigPlane" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">خطةالري</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="resource" aria-selected="false"
                                style="border: none;padding: 4px;font-size: 22px;">موارد عملية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true"
                                style="border: none;padding: 4px;font-size: 22px;">الملاحظات</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false"
                                style="border: none;padding: 4px;font-size: 22px;">توصيات</a>
                        </li> 
                    </ul>


                    <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">


                        <div class="tab-pane pb-3 fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="plant-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <div class="row m-4 border-prog">
                                <div class="stepwizard2">
                                    <div class="progress center-block">
                                        <div class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 13%">
                                        </div>
                                    </div>
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step ">
                                            <a href="#step-1" type="button" class="btn btn-success btn-circle" aria-="true">
                                                <P hidden>11</P>
                                            </a>
                                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/radm l goura 1.png" width=30px style="z-index:222; position:absolute; top: -20%; left: 44%;" />
                                            <p>
                                                <small>الغرس</small>
                                            </p>
                                        </div>
                                        <div class="stepwizard-step ">
                                            <a href="#step-2" type="button" class="btn btn-circle btn-circle" aria-="true" disabled>
                                                <p hidden>22</p>
                                            </a>
                                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/8asel 1.png" width=30px style="z-index:222; position:absolute; top: -20%; left: 44%;" />
                                            <p>
                                                <small>الري</small>
                                            </p>
                                        </div>
                                        <div class="stepwizard-step ">
                                            <a href="#step-3" type="button" class="btn  btn-circle btn-default" aria-="true" disabled>
                                                <p hidden>33</p>
                                            </a>
                                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/tat7er-1.png" width=30px style="z-index:222; position:absolute;top:-25%;left: 44%;" />
                                            <p>
                                                <small>الوقاية</small>
                                            </p>
                                        </div>
                                        <div class="stepwizard-step ">
                                            <a href="#step-4" type="button" class="btn  btn-circle btn-default" aria-="true" disabled>
                                                <p hidden>44</p>
                                            </a>
                                            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/5edma-1.png" width=30px style="z-index:222; position:absolute; top: -24%;left:45%;" />
                                            <p>
                                                <small>التسميد</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <form role="form" class="m-auto formstyle" id="EditPlantingForm">
                                    <input type="hidden" id="id" name="id" value="{{$info->id}}">
                                    <div class="panel panel-primary setup-content" id="step-1">
                                        <div class="panel-body">
                                            <div class="row m-4 tab-top">

                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1 " style="margin-top: 7%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">تاريخ البداية</th>
                                                                <th scope="col">تاريخ النهاية</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input type="date"  class="form-control numric td-edit " required="required" name="start_date" value="{{$info->start_date}}">
                                                                    </div>
                                                                    <div id="start_date_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input type="date" class="form-control numric td-edit "required="required" name="end_date"  value="{{$info->end_date}}">
                                                                    </div>
                                                                    <div id="end_date_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row m-4 tab-top">
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"> المربع</th>
                                                                <th scope="col"> نوع الغرس</th>
                                                                <th scope="col"> عدد النخل</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                            <select required onchange="get_crop(this.value)" class="form-control col-val" name="box_id" id="type">
                                                                                    <option value="">أختار كود المريع</option>
                                                                                @foreach (@$Boxes as $value)
                                                                                    <option value="{{ $value->id }}" @if($info->box_id==$value->id)selected @endif>{{ $value->code }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>
                                                                </td>
                                                                <div id="box_id_demo"></div>
                                                                <span class="error-txt text-danger"></span>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                            <select required name="type_id"  class="form-control filter-form filter1">
                                                                                    <option disabled selected value="">أختار النوع </option>
                                                                                    <option value="1" @if($info->type_id==1)selected @endif > فسيلة</option>
                                                                                    <option value="2" @if($info->type_id==2)selected @endif>نسيج</option>
                                                                                </select>
                                                                    </div>
                                                                </td>
                                                                <div id="type_id_demo"></div>
                                                                <span class="error-txt text-danger"></span>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input name="config[planting_num_palm_trees]" required  value="{{$info->planting_num_palm_trees}}" type="text" class="form-control numric td-edit">
                                                                    </div>
                                                                    <div id="planting_num_palm_trees_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row m-4 tab-top">
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1 " style="margin-top: 7%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">اصناف النخل</th>
                                                                <th scope="col">الصف</th>
                                                                <th scope="col">العمود</th>
                                                                <th scope="col">
                                                                    {{--<i class="far fa-plus-square " onclick="add()" style="cursor: pointer"></i>--}}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="Ttyps">
                                                            <tr class="border_bottom" id="TRCopy">
                                                                <td class="types">
                                                                    <div class="form-group InputGroup">
                                                                        
                                                                      
                                                                        <select name="plamtree[crop][]" required class="form-control numric typescrop td-edit mySelectCrop"  style="width: 100%;">
                                                                            @foreach($Crops as $crop)
                                                                                <option value="{{$crop->id}}" @if($crop->id==$crop_detail->Crop->id) selected @endif>{{$crop->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div id="plamtreecrop_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                                <td class="sq-row">
                                                                    <div class="form-group InputGroup">
                                                                        <input type="text" name="plamtree[row][]" required value="{{$crop_detail->row}}" class="form-control numric td-edit">
                                                                    </div>
                                                                    <div id="plamtreerow_demo"></div>
                                                                </td>
                                                                <td class="sq-col">
                                                                    <div class="form-group InputGroup">
                                                                        <input type="text" name="plamtree[column][]" required value="{{$crop_detail->column}}" class="form-control numric td-edit">
                                                                    </div>
                                                                    <div id="plamtreecolumn_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <nav class="progress-nav ">
                                                <ul class="pager ">
                                                    <li class="next">
                                                        <button type="button" class="nextBtn">التالي</button>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary setup-content" id="step-2">
                                        <div class="panel-body">
                                            <div class="row m-4 tab-top">
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"> الموقع</th>
                                                                <th scope="col"> التنفيذ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>

                                                                    <div class="form-group InputGroup">
                                                                        <input type="text" name="config[irrigation_location]" value="{{$info->irrigation_location}}" class="form-control numric td-edit">
                                                                    </div>
                                                                    <div id="irrigation_location_demo"></div>
                                                                    <span class="error-txt text-danger"></span>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input name="config[irrigation_implementation]" type="checkbox"  @if($info->irrigation_implementation==1) checked @endif value="1" class="form-check-input td-edit" id="exampleCheck1">
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
                                                                    <div  class="form-group InputGroup">
                                                                        <input name="config[irrigation_num_palm_trees]" required value="{{$info->irrigation_num_palm_trees}}" type="number" class="form-control numric td-edit">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <div class="col-6">
                                                                            من:
                                                                             <input name="config[irrigation_start_date]" required value="{{$info->irrigation_start_date}}" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-6">
                                                                            :الى
                                                                             <input name="config[irrigation_end_date]" required value="{{$info->irrigation_end_date}}" type="date" class="form-control numric td-edit">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                            <select class="form-control col-val mySelectUser" required name="irrigation_user_id" id="type">
                                                                                <option selected disabled>اختر المستخدم</option>
                                                                            @foreach($users as $user)
                                                                                    <option value="{{$user->id}}" @if($info->user_irrigation->id==$user->id) selected @endif>{{$user->username}}</option>
                                                                            @endforeach
                                                                            </select>
                                                                            <div id="irrigation_user_id_demo"></div>
                                                                        <span class="error-txt text-danger"></span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <nav class="progress-nav  ">

                                                <ul class="pager">
                                                    <li class="previous ">
                                                        <button class="prevBtn "> رجوع</button>
                                                    </li>
                                                    <li class="next ">
                                                        <button type="button" class="nextBtn ">التالي </button>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary setup-content" id="step-3">
                                        <div class="panel-body">
                                            <div class="row m-4 tab-top">
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">اسم المبيد</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <select class="form-control col-val mySelectUser" name="config[protection_pesticide]" id="type">
                                                                            <option selected disabled>اختر اسم المبيد</option>
                                                                            @foreach ($Matriels as $value)
                                                                                <option value="{{ $value->id }}" @if($value->id==$info->protection_pesticide) selected @endif>{{ $value->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div id="irrigation_user_id_demo"></div>
                                                                        <span class="error-txt text-danger"></span>
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
                                                                <th scope="col">تاريخ المكافحة</th>
                                                                <th scope="col">الكمية للنخله</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <div class="col-5">
                                                                            من:
                                                                            <input  name="config[protection_start_date]" required value="{{$info->protection_start_date}}" type="date" class="form-control numric td-edit">
                                                                            <div id="protection_start_date_demo"></div>
                                                                            <span class="error-txt text-danger"></span>
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-5">
                                                                            :الى

                                                                            <input  name="config[protection_end_date]" required value="{{$info->protection_end_date}}" type="date" class="form-control numric td-edit">

                                                                            <div id="protection_end_date_demo"></div>
                                                                            <span class="error-txt text-danger"></span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <input name="config[protection_palm_qyt]" required type="number" value="{{$info->protection_palm_qyt}}" id="Diameter" class=" border-style  mr-4 mes td-edit"><span>لتر</span>

                                                                       <div id="protection_palm_qyt_demo"></div>
                                                                            <span class="error-txt text-danger"></span>
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
                                                                <th scope="col">الكمية الكلية</th>
                                                                <th scope="col">تنفذ بواسطة</th>
                                                                <th scope="col">التنفيذ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <input name="config[protection_total_amount]" type="number" value="{{$info->protection_total_amount}}" id="Diameter" class=" border-style  mr-4 mes td-edit "><span>لتر</span>
                                                                        <div id="protection_total_amount_demo"></div>
                                                                            <span class="error-txt text-danger"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <select class="form-control col-val mySelectUser" name="protection_user_id" id="type">
                                                                            <option selected disabled>اختر المستخدم</option>
                                                                            @foreach($users as $user)
                                                                                <option value="{{$user->id}}" @if($info->user_protection->id==$user->id) selected @endif>{{$user->username}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                                 <input type="checkbox" class="form-check-input td-edit" @if($info->protection_implementation=='on') checked @endif id="exampleCheck1" name="config[protection_implementation]">
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
                                                                <th scope="col">طريقة الاستخدام</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <textarea name="config[protection_how_to_use]" class="form-control numric td-edit">{{$info->protection_how_to_use}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <nav class="progress-nav  ">
                                                <ul class="pager">
                                                    <li class="previous ">
                                                        <button class="prevBtn "> رجوع</button>>
                                                    </li>
                                                    <li class="next ">
                                                        <button type="button" class="nextBtn ">التالي </button>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary setup-content" id="step-4">
                                        <div class="panel-body">
                                            <div class="row m-4 tab-top">
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"> التاريخ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <div class="col-5">
                                                                            من:
                                                                            <input  name="config[fertilization_start_date]" value="{{$info->fertilization_start_date}}" required type="date" class="form-control numric td-edit">
                                                                            <div id="fertilization_start_date_demo"></div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-5">
                                                                            :الى
                                                                            <input name="config[fertilization_end_date]"  value="{{$info->fertilization_end_date}}" required type="date" class="form-control numric td-edit">
                                                                            <div id="fertilization_end_date_demo"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"> الصف</th>
                                                                <th scope="col"> العمود</th>
                                                                <th scope="col">الصنف المزروع</th>
                                                                <th scope="col">السماد</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                              <input name="config[fertilization_row]" type="number" value="{{$info->fertilization_row}}" required id="Diameter" class=" border-style  mr-4 mes td-edit">
                                                                        <div id="fertilization_row_demo"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                              <input name="config[fertilization_column]" type="number" value="{{$info->fertilization_column}}" required id="Diameter" class=" border-style  mr-4 mes td-edit">
                                                                        <div id="fertilization_column_demo"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <select name="fertlize_crop_id" required class="form-control numric typescrop td-edit mySelectCrop"  style="width: 100%;">
                                                                            @foreach($Crops as $crop)
                                                                                <option value="{{$crop->id}}" @if($crop->id==$info->crop_plant->id )selected @endif>{{$crop->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div id="fertlize_crop_id_demo"></div>
                                                                </td>
                                                                <td>
                                                                            <input type="text" name="config[fertilization_fertilizer]"  value="{{$info->fertilization_fertilizer}}" id="Diameter" class=" border-style  mr-4 mes td-edit">
                                                                    <div id="fertilization_fertilizer->demo"></div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-12 ">
                                                    <table class="table borderless table1 " style="margin-top: 7%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">الكمية للنخله</th>
                                                                <th scope="col">التنفيذ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                         <input name="config[fertilization_palm_qyt]" type="number" value="{{$info->fertilization_palm_qyt}}" required id="Diameter" class=" border-style  mr-4 mes td-edit"><span>لتر</span>
                                                                            </div>
                                                                            <div id="fertilization_palm_qyt_demo"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">

                                                                                 <input name="config[fertilization_implementation]" value="1" @if($info->fertilization_implementation==1) checked @endif type="checkbox" class="form-check-input td-edit" id="exampleCheck1" required="required">
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
                                                                <th scope="col">طريقة الاستخدام</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border_bottom">
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <textarea name="config[fertilization_how_to_use]" class="form-control numric td-edit">{{$info->fertilization_how_to_use}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <nav class="progress-nav ">
                                                <ul class="pager">
                                                    <li class="previous">
                                                        <a class="prevBtn"> رجوع</a>
                                                    </li>
                                                    <li class="next">
                                                        @if($healper->check_permission(16,6))
                                                        <button type="button" id="SubmitButton" class="nextBtn">حفظ</button>
                                                            @endif
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                       <div class="tab-pane fade  " id="irrigPlane" role="tabpanel" aria-labelledby="irrigPlane-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <div class="Mparent">
                                <div class="Tparent">
                                    <div class="row m-4">

                                        <div class="col-lg-2  col-6">

                                        </div>

                                        <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">
                                            {{--@if($healper->check_permission(16,8))--}}
                                                <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addPlaneModal" data-toggle="modal">أضافة </button>
                                            {{--@endif--}}
                                        </div>

                                    </div>

                                    <div class="row m-3 justify-content-center pb-5 ">
                                        <div class="col-lg-12 ">

                                            <table class="table zadnatable mainTable notesTable" tableId="15">
                                                <thead>
                                                    <tr>
                                                        <th>الكود</th>
                                                        <th>المحبس</th>
                                                        <th>كمية المياه</th>
                                                        <th>التكرار</th>
                                                        <th>توقيت الري</th>
                                                         <th>الملاحظات</th> 
                                                        <th class="actions">
                                                            <i class="fas fa-bars"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                       @foreach ($PlanningIrrigation as $value)
                                                            <tr>
                                                                <td>{{ $value->code }}</td>
                                                                <td>{{ $value->code_mahbas }}</td>
                                                                <td>{{ $value->qyt }}</td>
                                                                <td>{{ $value->repeat }}</td>
                                                                <td>{{ date('Y-m-d',strtotime($value->irrigation_date)) }}</td>
                                                                <td>{{ $value->note }}</td>
                                                                <td>
                                                                        <button class="delete_plan"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                                                </td>
                                                            </tr>
                                                       @endforeach
                                                    
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
                                                    <form action="" id="OperationPlanAdd">
                                                        <input type="hidden" name="planting_id" value="{{ $info->id }}">
                                                        <div class="row mb-4">
                                                            {{--<div class="col-12 form-inline">--}}
                                                                {{--<label class="col-4" for="mahbs">المحبس</label>--}}
                                                                {{--<select name="irrigation_id" class="form-control col-val col-5 " id="mahbs" value="1">--}}
                                                                    {{--@if($Irrigation)--}}
                                                                        {{--@foreach ($Irrigation as $value)--}}
                                                                            {{--<option value="{{ $value->id }}">{{ $value->code }}</option>--}}
                                                                        {{--@endforeach--}}
                                                                   {{--@endif--}}
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
                                                    <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="saveDatePlan" class="danger btn btn-primary btnSave ">حفظ</button>
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
                                'moduel_id'=>2,
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