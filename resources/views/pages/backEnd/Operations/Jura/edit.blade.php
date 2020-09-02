@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var addrow = function () {
        var CopyTR = '    <tr class="border_bottom ">\n' +
            '                                                    <td>\n' +
            '                                                        <div class="form-group InputGroup">\n' +
            '                                                            <select class="form-control" value="نوع1" name="config[service_matrial_id][]">\n' +
            '                                                                @foreach ($Matriels as $value)\n' +
            '                                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>\n' +
            '                                                                @endforeach\n' +
            '                                                            </select>\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                        <span class="error-txt text-danger"></span>\n' +
            '\n' +
            '                                                    </td>\n' +
            '\n' +
            '                                                    <td>\n' +
            '                                                        <div class="form-group InputGroup">\n' +
            '                                                            <input type="number" name="config[service_matrial_qyt][]" class="form-control numric " min="0" required="required">\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                        <span class="error-txt text-danger"></span>\n' +
            '\n' +
            '                                                    </td>\n' +
            '<td>'+
            '<i class="fas fa-times ml-4 text-danger delete-row" style="cursor: pointer"></i>'+
            '</td>'+
            '</tr>';

        $(".Tjura1").append(CopyTR);

    }

    var addrow2 = function () {
        var CopyTR2 = '    <tr class="border_bottom ">\n' +
            '                                                    <td>\n' +
            '                                                        <div class="form-group InputGroup">\n' +
            '                                                            <select class="form-control" value="نوع1" name="config[cleansing_matrial_id][]">\n' +
            '                                                                @foreach ($Matriels as $value)\n' +
            '                                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>\n' +
            '                                                                @endforeach\n' +
            '                                                            </select>\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                        <span class="error-txt text-danger"></span>\n' +
            '\n' +
            '                                                    </td>\n' +
            '\n' +
            '                                                    <td>\n' +
            '                                                        <div class="form-group InputGroup">\n' +
            '                                                            <input type="number" name="config[cleansing_matrial_qyt][]" class="form-control numric " min="0" required="required">\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                        <span class="error-txt text-danger"></span>\n' +
            '\n' +
            '                                                    </td>\n' +
            '<td>'+
            '<i class="fas fa-times ml-4 text-danger delete-row" style="cursor: pointer"></i>'+
            '</td>'+
            '</tr>';

        $(".Tjura2").append(CopyTR2);

    }

</script>

   <script>
        var report={{ $report }};
    $(function () {
        $(".select2").select2();
    });
    $(document).ready(function () {

        $(".panel input").attr("required", "required");
        $(".panel select").attr("required", "required");
        $(".panel select").attr("required", "required");

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPrevBtn = $('.prevBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);
            var nextStepWizard = $(this).text();

            if (nextStepWizard == 1)
                $('.stepwizard .progress-bar').animate({
                    width: '0%'
                }, 0);
            if (nextStepWizard == 2)
                $('.stepwizard .progress-bar').animate({
                    width: '22%'
                }, 0);
            if (nextStepWizard == 3)
                $('.stepwizard .progress-bar').animate({
                    width: '39%'
                }, 0);
            if (nextStepWizard == 4)
                $('.stepwizard .progress-bar').animate({
                    width: '60%'
                }, 0);
            if (nextStepWizard == 5)
                $('.stepwizard .progress-bar').animate({
                    width: '78%'
                }, 0);
            if (nextStepWizard == 6)
                $('.stepwizard .progress-bar').animate({
                    width: '100%'
                }, 0);
            if (nextStepWizard == 7)
                $('.stepwizard .progress-bar').animate({
                    width: '100%'
                }, 0);


            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                //navListItems.addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                .children("a"),
                curInputs = curStep.find("input[required='required']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            $(".error-txt").text("");

            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                    $(curInputs[i]).closest(".form-group").parents("tr").find(".error-txt").text(
                        "* هذا الحقل لا يمكن تركه فارغا")
                }
            }

            if (isValid) {
                nextStepWizard.removeAttr('disabled').trigger('click');
            }
        });
        allPrevBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev()
                .children("a");

            prevStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>  
<script src="{{ asset('public') }}/js/backEnd/jura.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
{{--  @include('pages.backEnd.AllModuels')  --}}
<div class="row m-0">
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
        <div>
            <div class="row  mt-0 mr-4 ml-4 mb-4">
                <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #AAA; margin-bottom: 0px">

                    <li class="nav-item selected ">
                        <a class="nav-link linkColor active" id="water-tab" data-toggle="tab" href="#water" role="tab" aria-controls="water" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">تجهيز الجورة</a>
                    </li>
                    <li class="nav-item ">
                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="analyse" aria-selected="false" style="border: none; padding: 4px; font-size: 22px;">موارد العمليات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true" style="border: none;  padding: 4px; font-size: 22px;">الملاحظات</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="analyse" aria-selected="false" style="border: none; padding: 4px; font-size: 22px;">توصيات</a>
                        </li>
                </ul>
                <div class="tab-content pb-5 tabProgress" id="myTabContent">
                    <div class="tab-pane fade show active  " id="water" role="tabpanel" aria-labelledby="water-tab"
                    style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                    <div class="row m-4 border-prog">
                        <div class="stepwizard">
                            <div class="progress center-block">
                                <div class="progress-bar progress-bar-success active" role="progressbar"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 13%">
                                </div>
                            </div>

                            <div class="stepwizard-row setup-panel">

                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-1" type="button" class="btn btn-success btn-circle"
                                        aria-disabled="true" disabled>1</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/3mlyat zra3ya.png" width=30px style="z-index:222; position:absolute; top: -15%; left: 38%;" />
                                    <p>
                                        <small>إعداد</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-2" type="button" class="btn btn-circle btn-circle"
                                        aria-disabled="true" disabled>2</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/7afr.png" width=30px style="z-index:222; position:absolute; top: -19%; left: 42%;" />
                                    <p>
                                        <small>الحفر</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-3" type="button" class="btn  btn-circle btn-default"
                                        aria-disabled="true" disabled>3</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/27lal-1.png" width=30px style="z-index:222; position:absolute;top:-13%;left: 41%;" />
                                    <p>
                                        <small>احلال</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-4" type="button" class="btn  btn-circle btn-default"
                                        aria-disabled="true" disabled>4</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/5edma-1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 42%;" />
                                    <p>
                                        <small>الخدمة</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-5" type="button" class="btn  btn-circle btn-default"
                                        aria-disabled="true" disabled>5</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/radm l goura 1.png" width=30px style="z-index:222; position:absolute; top: -26%;left: 45%;" />
                                    <p>
                                        <small>ردم الجورة</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-6" type="button" class="btn  btn-circle btn-default"
                                        aria-disabled="true" disabled>6</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/8asel 1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 42%;" />
                                    <p>
                                        <small>غسيل</small>
                                    </p>
                                </div>
                                <div class="stepwizard-step col-xs-3">
                                    <a href="#step-7" type="button" class="btn  btn-circle btn-default"
                                        aria-disabled="true" disabled>7</a>
                                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/tat7er-1.png" width=30px style="z-index:222; position:absolute; top: -19%;left: 42%;" />
                                    <p>
                                        <small>طهير</small>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form role="form" class="m-auto formstyle" id="EditJuraForm">
                            <input type="hidden" id="id" name="id" value="{{ $info->id }}">
                            <div class="panel panel-primary setup-content" id="step-1">
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
                                                                <input type="date" value="{{ $info->start_date }}" name="start_date" class="form-control numric">
                                                            </div>
                                                            <div id="start_date_demo"></div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->end_date }}" name="end_date" class="form-control">
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
                                                        <th scope="col" > التنفيذ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border_bottom">

                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <textarea name="specifications" rows="4" cols="50" class="form-control numric">{{ $info->specifications }}</textarea>
                                                            </div>
                                                            <div id="specifications_demo"></div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="checkbox" value="2" name="achieve" @if($info->achieve==2)checked @endif>
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
                                                                <input type="date" value="{{ $info->drilling_start_date }}" name="config[drilling_start_date]" class="form-control numric " required="required">
                                                            </div>
                                                            <span class="error-txt text-danger"></span>
                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->drilling_end_date }}" name="config[drilling_end_date]" class="form-control numric "
                                                                    required="required">
                                                            </div>
                                                            <span class="error-txt text-danger"></span>
                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="number" value="{{ $info->depth }}" name="depth" class="form-control numric "
                                                                    min="0" required="required">مم
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
                                                                <input type="date" value="{{ $info->replacement_start_date }}" name="config[replacement_start_date]" class="form-control numric "
                                                                    required="required">
                                                            </div>
                                                            <span class="error-txt text-danger"></span>
                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->replacement_end_date }}" name="config[replacement_end_date]" class="form-control numric "
                                                                    required="required">
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
                                                            <input type="date" name="config[service_start_date]" value="{{$info->service_start_date}}" class="form-control numric " required="required">

                                                        </div>
                                                        <span class="error-txt text-danger"></span>

                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="date" name="config[service_end_date]" value="{{$info->service_end_date}}" class="form-control numric " required="required">

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
                                                        <i class="far fa-plus-square ml-4 " onclick="addrow()" style="cursor: pointer"></i>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="Tjura1">
                                            @foreach($info->service_matrial_id as $material_detail)
                                                <tr class="border_bottom tr-rep">
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <select class="form-control" value="نوع1" name="config[service_matrial_id][]">
                                                                @foreach ($Matriels as $value)
                                                                    <option value="{{ $value->id }}" @if($value->id==$material_detail['material_id']) selected @endif>{{ $value->title }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <span class="error-txt text-danger"></span>

                                                    </td>

                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="number" name="config[service_matrial_qyt][]" value="{{$material_detail['amount']}}" class="form-control numric " min="0" required="required">

                                                        </div>
                                                        <span class="error-txt text-danger"></span>

                                                    </td>
                                                    <td>
                                                        <i class="fas fa-times ml-4 text-danger delete-row" style="cursor: pointer"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
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
                                                            <input type="text" name="config[service_way]" value="{{$info->service_way}}" class="form-control numric " required="required">
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
                                                                <input value="{{ $info->landfill_start_date }}" type="date" name="config[landfill_start_date]" class="form-control numric "
                                                                    required="required">

                                                            </div>
                                                            <span class="error-txt text-danger"></span>

                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->landfill_end_date }}" name="config[landfill_end_date]" class="form-control numric "
                                                                    required="required">

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
                                                        <th scope="col" colspan="2"> كمية المياة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border_bottom">

                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->clean_start_date }}" name="config[clean_start_date]" class="form-control numric "
                                                                    required="required">

                                                            </div>
                                                            <span class="error-txt text-danger"></span>

                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="date" value="{{ $info->clean_end_date }}" name="config[clean_end_date]" class="form-control numric "
                                                                    required="required">

                                                            </div>
                                                            <span class="error-txt text-danger"></span>

                                                        </td>

                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input name="config[clean_water_qyt]" value="{{ $info->clean_water_qyt }}" type="text" class="form-control numric "
                                                                    required="required"><span>لتر</span>

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
                                                        <th scope="col" colspan="2"> عدد مرات التكرار</th>
                                                        <th scope="col"> الفتره</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border_bottom">

                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input value="{{ $info->clean_repet }}" name="config[clean_repet]" type="number" class="form-control numric "
                                                                    min="0" required="required">

                                                            </div>
                                                            <span class="error-txt text-danger"></span>

                                                        </td>
                                                        <td>
                                                            <div class="form-group InputGroup">
                                                                <input type="text" value="{{ $info->clean_duration }}" name="config[clean_duration]" class="form-control numric "
                                                                    required="required">

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
                            <div class="panel panel-primary setup-content" id="step-7">

                                <div class="panel-body">
                                    <div class="row m-4 tab-top">
                                    <div class=" col-6 ">
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
                                                        <input value="{{ $info->cleansing_start_date }}" name="config[cleansing_start_date]" type="date" class="form-control numric "
                                                               required="required">

                                                    </div>
                                                    <span class="error-txt text-danger"></span>

                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <input value="{{ $info->cleansing_end_date }}" name="config[cleansing_end_date]" type="date" class="form-control numric "
                                                               required="required">

                                                    </div>
                                                    <span class="error-txt text-danger"></span>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class=" col-6 ">
                                        <table class="table borderless table1">
                                            <thead>
                                            <tr>

                                                <th scope="col"> الخامة</th>
                                                <th scope="col"> الكميه</th>
                                                <th>
                                                    <i class="far fa-plus-square ml-4 " onclick="addrow2()" style="cursor: pointer"></i>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="Tjura2">
                                            @foreach($info->cleansing_matrial_id as $material_clean)
                                                <tr class="border_bottom">
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <select class="form-control" name="config[cleansing_matrial_id][]">
                                                                @foreach ($Matriels as $value)
                                                                    <option  value="{{ $value->id }}" @if($value->id==$material_clean['material_id']) selected @endif >{{ $value->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span class="error-txt text-danger"></span>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <input type="text" value="{{ $material_clean['amount'] }}" name="config[cleansing_matrial_qyt][]" class="form-control numric "
                                                                   required="required">
                                                        </div>
                                                        <span class="error-txt text-danger"></span>
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-times ml-4 text-danger delete-row" style="cursor: pointer"></i>
                                                    </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <nav class="progress-nav ">
                                        <ul class="pager">
                                            <li class="previous">
                                                <a class="prevBtn"> رجوع</a>
                                            </li>
                                            <li class="next">

                                                @if($healper->check_permission(15,6))
                                                 <button type="button" id="SubmitButton" style="background-color: #fc782e;padding: 10px 34px;
                                                bottom: 0px;
                                                left: 0;
                                                position: absolute;
                                                border: none;
                                                color: white;">حفظ</button>
                                                @endif
                                            </li>
                                        </ul>
                                    </nav>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                @php
                $process_array=[
                        'moduel_id'=>1,
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