@extends('layouts.backEnd') @section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css"> @endsection @section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/js/op-steps.js"></script>
<script>
    $(function () {
        $(".select2").select2();
    });

    var add = function () {
        var CopyTR = '<tr>' + $(".tr-rep").html() + '</tr>';
        $(".Ttyps").append(CopyTR);

    }
    var add2 = function () {
        var CopyTR = '<tr>' + $(".tr-rep2").html() + '</tr>';
        $(".Ttyps2").append(CopyTR);

    }
</script>
<script>
    var report = false;
</script>
<script src="{{ asset('public') }}/js/backEnd/jura.js"></script>

@endsection @section('page_header') @endsection @section('page_content') @inject('healper', 'App\Http\Controllers\BladeController')
{{-- @include('pages.backEnd.AllModuels') --}}
<div class="row m-0">
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
        <div>
            <div class="row  mt-0 mr-4 ml-4 mb-4">
                <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #AAA; margin-bottom: 0px">

                    <li class="nav-item selected ">
                        <a class="nav-link linkColor active" id="water-tab" data-toggle="tab" href="#water" role="tab" aria-controls="water" aria-selected="false"
                            style="border: none;padding: 4px;font-size: 22px;">تجهيز الجورة</a>
                    </li>
                </ul>
                <div class="tab-content pb-5 tabProgress" id="myTabContent">
                    <div class="tab-pane fade show active  " id="water" role="tabpanel" aria-labelledby="water-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <div class="row m-4 border-prog">
                            <div class="stepwizard">
                                <div class="progress center-block">
                                    <div class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 13%">
                                    </div>
                                </div>

                                <div class="stepwizard-row setup-panel">

                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-1" type="button" class="btn btn-success btn-circle" aria-disabled="true" disabled>
                                            <span hidden>1</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/3mlyat zra3ya.png" width=30px style="z-index:222; position:absolute; top: -15%; left: 41%;"
                                        />
                                        <p>
                                            <small>إعداد</small>
                                        </p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-2" type="button" class="btn btn-circle btn-circle" aria-disabled="true" disabled>
                                            <span hidden>2</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/7afr.png" width=30px style="z-index:222; position:absolute; top: -19%; left: 42%;"
                                        />
                                        <p>
                                            <small>الحفر</small>
                                        </p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-3" type="button" class="btn  btn-circle btn-default" aria-disabled="true" disabled>
                                            <span hidden>3</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/27lal-1.png" width=30px style="z-index:222; position:absolute;top:-13%;left: 41%;"
                                        />
                                        <p>
                                            <small>احلال</small>
                                        </p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-4" type="button" class="btn  btn-circle btn-default" aria-disabled="true" disabled>
                                            <span hidden>4</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/5edma-1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 42%;"
                                        />
                                        <p>
                                            <small>الخدمة</small>
                                        </p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-5" type="button" class="btn  btn-circle btn-default" aria-disabled="true" disabled>
                                            <span hidden>5</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/radm l goura 1.png" width=30px style="z-index:222; position:absolute; top: -22%;left: 44%;"
                                        />
                                        <p>
                                            <small>ردم الجورة</small>
                                        </p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-6" type="button" class="btn  btn-circle btn-default" aria-disabled="true" disabled>
                                            <span hidden>6</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/8asel 1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 45%;"
                                        />
                                        <p>
                                            <small>غسيل وتطهير</small>
                                        </p>
                                    </div>
                                    {{--
                                    <div class="stepwizard-step col-xs-3">
                                        <a href="#step-7" type="button" class="btn  btn-circle btn-default" aria-disabled="true" disabled>
                                            <span hidden>7</span>
                                        </a>
                                        <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/tat7er-1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 42%;"
                                        />
                                        <p>
                                            <small>طهير</small>
                                        </p>
                                    </div> --}}
                                </div>
                            </div>

                            <form role="form" class="m-auto formstyle" id="AddJuraForm">
                                <input type="hidden" id="id" name="id" value="">
                                <div class="panel panel-primary setup-content" id="step-1">
                                    <div class="panel-body">
                                        <div class="row m-4 tab-top">
                                            <div class="col-lg-12 col-sm-12 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> كود المربع</th>
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <select class="form-control col-val" name="box_id" id="type">
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
                                                                    <input type="date" name="start_date" class="form-control numric">
                                                                </div>
                                                                <div id="start_date_demo"></div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="end_date" class="form-control">
                                                                </div>
                                                                <div id="end_date_demo"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-lg-12 col-sm-12 col-12 ">
                                                <table class="table borderless table1 " style="margin-top: 7%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width:33%;">مواصفات الحفر</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <textarea name="specifications" rows="4" cols="50" class="form-control numric"></textarea>
                                                                </div>
                                                                <div id="specifications_demo"></div>
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
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                            <th scope="col " colspan="2">عمق الحفره</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[drilling_start_date]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[drilling_end_date]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="number" name="depth" class="form-control numric " min="0" required="required">
                                                                    <span style="font-size: xx-large;">متر</span>
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!--<button class="btn btn-primary nextBtn pull-right" type="button">Next <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button>-->
                                        <nav class="progress-nav  ">
                                            <ul class="pager">
                                                <li class="previous ">
                                                    <a class="prevBtn "> رجوع</a>
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
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[replacement_start_date]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[replacement_end_date]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <nav class="progress-nav">
                                            <ul class="pager">
                                                <li class="previous ">
                                                    <a class="prevBtn "> رجوع</a>
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
                                            <div class="col-lg-5 col-sm-5 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[service_start_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[service_end_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> نوع الخامة</th>
                                                            <th scope="col"> الكميه</th>
                                                            <th>
                                                                <i class="far fa-plus-square ml-4 " onclick="add()" style="cursor: pointer"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="Ttyps">

                                                        <tr class="border_bottom tr-rep">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <select class="form-control" value="نوع1" name="config[service_matrial_id][]">
                                                                        @foreach ($Matrials as $value)
                                                                          <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="number" name="config[service_matrial_qyt][]" class="form-control numric " min="0" required="required">

                                                                </div>
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
                                                            <th scope="col"> الطريقه</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">


                                                            <td colspan="2">
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" name="config[service_way]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>

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
                                                    <button type="button" class="nextBtn">التالي</button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="panel panel-primary setup-content" id="step-5">

                                    <div class="panel-body">
                                        <div class="row m-4 tab-top">
                                            <div class="col-lg-12 col-sm-12 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[landfill_start_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[landfill_end_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

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
                                                    <button type="button" class="nextBtn">التالي</button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="panel panel-primary setup-content" id="step-6">

                                    <div class="panel-body">
                                        <div class="row m-4 tab-top">
                                            <div class="col-lg-12 col-sm-12 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                            <th scope="col"> كمية المياة</th>
                                                            <th scope="col">شبكة الري المستخدمة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[clean_start_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="date" name="config[clean_end_date]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input name="config[clean_water_qyt]" type="text" class="form-control numric " required="required">
                                                                    <span style="font-size: xx-large;">لتر</span>

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <select class="form-control" value="نوع1" name="config[service_irrigation_id][]" required="required">
                                                                        @foreach($irrigations as $irrigation)
                                                                            <option value="{{$irrigation->id}}">{{$irrigation->title}}</option>
                                                                         @endforeach
                                                                    </select>

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row m-4 tab-top">
                                            <div class="col-lg-6 col-sm-6 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> الخامة</th>
                                                            <th scope="col"> الكميه</th>
                                                            <th>
                                                                <i class="far fa-plus-square ml-4 " onclick="add2()" style="cursor: pointer"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="Ttyps2">
                                                        <tr class="border_bottom tr-rep2">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <select class="form-control" name="config[cleansing_matrial_id][]">
                                                                        @foreach ($Matrials as $value)
                                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" name="config[cleansing_matrial_qyt][]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> عدد مرات التكرار</th>
                                                            <th scope="col"> الفتره</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input name="config[clean_repet]" type="number" class="form-control numric " min="0" required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" name="config[clean_duration]" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

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
                                                        <button type="button" id="SubmitButton" style="background-color: #fc782e;padding: 10px 34px;
                                                        bottom: 0px;
                                                        left: 0;
                                                        position: absolute;
                                                        border: none;
                                                        color: white;">حفظ</button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                {{--
                                <div class="panel panel-primary setup-content" id="step-7">

                                    <div class="panel-body">
                                        <div class="row m-4 tab-top">
                                            <div class="col-lg-6 col-sm-6 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> تاريخ البداية</th>
                                                            <th scope="col"> تاريخ النهاية</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border_bottom">

                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input name="config[cleansing_start_date]" type="date" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input name="config[cleansing_end_date]" type="date" class="form-control numric " required="required">

                                                                </div>
                                                                <span class="error-txt text-danger"></span>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-12 ">
                                                <table class="table borderless table1">
                                                    <thead>
                                                        <tr>

                                                            <th scope="col"> الخامة</th>
                                                            <th scope="col"> الكميه</th>
                                                            <th>
                                                                <i class="far fa-plus-square ml-4 " onclick="add2()" style="cursor: pointer"></i>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="Ttyps2">
                                                        <tr class="border_bottom tr-rep2">
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <select class="form-control" name="config[cleansing_matrial_id]">
                                                                        @foreach ($Matrials as $value)
                                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" name="config[cleansing_matrial_qyt]" class="form-control numric " required="required">
                                                                </div>
                                                                <span class="error-txt text-danger"></span>
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
                                                    <button type="button" id="SubmitButton" style="background-color: #fc782e;padding: 10px 34px;
                                                bottom: 0px;
                                                left: 0;
                                                position: absolute;
                                                border: none;
                                                color: white;">حفظ</button>
                                                </li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div> --}}


                            </form>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection