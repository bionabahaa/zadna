@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var report=false;
    var operation_page=1;
  </script>
<script src="{{ asset('public') }}/js/backEnd/well.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/op-steps.js"></script>
<script src="{{ asset('public/styles/backEnd') }}/dist/js/add-type.js"></script>
<script src="{{ asset('public') }}/js/backEnd/planting.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
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
                                <form role="form" class="m-auto formstyle" id="AddPlantingForm">
                                    <input type="hidden" id="id" value="">
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
                                                                        <input type="date" class="form-control numric td-edit " required="required" name="start_date">
                                                                    </div>
                                                                    <div id="start_datePlant_demo"></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input type="date" class="form-control numric td-edit "required="required" name="end_date">
                                                                    </div>
                                                                    <div id="end_datePlant_demo"></div>
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
                                                                            <select onchange="get_crop(this.value)" class="form-control col-val" name="box_id" id="type">
                                                                                    <option value="">أختار كود المريع</option>
                                                                                @foreach (@$Boxes as $value)
                                                                                    <option value="{{ $value->id }}">{{ $value->code }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div id="box_id_demo"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                            <select name="type_id" class="form-control filter-form filter1">
                                                                                    <option value="">أختار النوع </option>
                                                                                    <option value="1"> فسيلة</option>
                                                                                    <option value="2">نسيج</option>
                                                                                </select>
                                                                        <div id="type_id_demo"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input name="config[planting_num_palm_trees]" type="number" class="form-control numric td-edit">
                                                                    </div>
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
                                                                      <select name="plamtree[crop][]" class="form-control numric typescrop td-edit mySelectCrop"  style="width: 100%;"> 
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="sq-row">
                                                                    <div class="form-group InputGroup">
                                                                        <input type="number" name="plamtree[row][]"class="form-control numric td-edit">
                                                                    </div>
                                                                </td>
                                                                <td class="sq-col">
                                                                    <div class="form-group InputGroup">
                                                                        <input type="number" name="plamtree[column][]"class="form-control numric td-edit">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <nav class="progress-nav ">
                                                <ul class="pager ">
                                                    <li class="next">
                                                        <button type="" class="nextBtn">التالي</button>
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
                                                                        <input type="text" name="config[irrigation_location]" class="form-control numric td-edit">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input name="config[irrigation_implementation]" type="checkbox" value="1" class="form-check-input td-edit" id="exampleCheck1">
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
                                                                        <input name="config[irrigation_num_palm_trees]" type="number" class="form-control numric td-edit">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <div class="col-6">
                                                                            من:
                                                                            <input name="config[irrigation_start_date]" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-6">
                                                                            :الى
                                                                            <input name="config[irrigation_end_date]" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                            <select class="form-control col-val mySelectUser" name="irrigation_user_id" id="type">
                                                                            </select>
                                                                            <div id="irrigation_user_id_demo"></div>
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
                                                        <button class="nextBtn ">التالي </button>
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
                                                                        <select class="form-control col-val" name="config[protection_pesticide]" id="type">
                                                                            @foreach ($Matriels as $value)
                                                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                                            @endforeach
                                                                                </select>
                                                                        <div id="irrigation_user_id_demo"></div>
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
                                                                            <input  name="config[protection_start_date]" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-5">
                                                                            :الى
                                                                            <input  name="config[protection_end_date]" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-inline">
                                                                        <input name="config[protection_palm_qyt]" type="number" id="Diameter" class=" border-style  mr-4 mes td-edit"><span>لتر</span>
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
                                                                        <input name="config[protection_total_amount]" type="number" id="Diameter" class=" border-style  mr-4 mes td-edit "><span>لتر</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <select name="protection_user_id" class="form-control numric select2 typescrop td-editv mySelectUser" style="width: 100%;">
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input td-edit" id="exampleCheck1" name="config[protection_implementation]">
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
                                                                        <textarea name="config[protection_how_to_use]" class="form-control numric td-edit"></textarea>
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
                                                        <button class="nextBtn ">التالي </button>
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
                                                                            <input name="config[fertilization_start_date]" type="date" class="form-control numric td-edit">
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-5">
                                                                            :الى
                                                                            <input name="config[fertilization_end_date]" type="date" class="form-control numric td-edit">
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
                                                                       < <input name="config[fertilization_row]" type="number" id="Diameter" class=" border-style  mr-4 mes td-edit">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <input name="config[fertilization_column]" type="number" id="Diameter" class=" border-style  mr-4 mes td-edit">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group InputGroup">
                                                                        <select name="fertlize_crop_id" class="form-control numric typescrop td-edit mySelectCrop"  style="width: 100%;">
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="config[fertilization_fertilizer]" id="Diameter" class=" border-style  mr-4 mes td-edit">
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
                                                                                <input name="config[fertilization_palm_qyt]" type="number" id="Diameter" class=" border-style  mr-4 mes td-edit"><span>لتر</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input name="config[fertilization_implementation]" value="1" type="checkbox" class="form-check-input td-edit" id="exampleCheck1" required="required">
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
                                                                        <textarea name="config[fertilization_how_to_use]" class="form-control numric td-edit"></textarea>
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
                                                    
                                                        <button type="button" id="SubmitButton" class="nextBtn">حفظ</button>
                                                        
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection