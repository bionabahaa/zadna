@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
    <script>
        var operation_page=1;
        $(function () {
            $(".select2").select2();
        });
    </script>
    <script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
<div class="row m-0">
@if($operation_page)
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
@else
    <div class="col-sm-12 col-10 p-0">
@endif


    <div>
        <div class="row  mt-0 mr-4 ml-4 mb-4">
        @if($operation_page)
            <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                <li class="nav-item selected ">
                    <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none; padding: 4px; font-size: 22px;">المواصفات العامة</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link linkColor " id=" Intersec-tab" data-toggle="tab" href="# Intersec" role="tab" aria-controls=" Intersec" aria-selected="false" style="border: none;
    padding: 4px;
    font-size: 22px;">التقاطع مع خطوط اخري</a>
                </li>


                <li class="nav-item ">
                    <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;
    padding: 4px;
    font-size: 22px;">موارد العملية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true" style="border: none;
    padding: 4px;
    font-size: 22px;">الملاحظات</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;
    padding: 4px;
    font-size: 22px;">توصيات</a>
                </li>
            </ul>
    @endif

            <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">

                <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">


                    <form id="EditIrrigationForm" method="POST">
                        <input type="hidden" name="id" id="id" value="{{$info->id}}">
                        <section class="content cropType">
                            <div class="top-bar">
                                <h6>اعدادات عامه >شبكة الرى> اضافه /تعديل خط </h6>
                            </div>

                            <div class="content p-5">



                                <div class="table-responsive">
                                    <table class="table tableborder">

                                        <thead>
                                            <tr>

                                                <th scope="col">الاسم</th>
                                                <th scope="col">نوع الخط</th>
                                                <th scope="col">كمية المياه</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="title" class="form-control numric name col-val" value="{{$info->title}}">

                                                    </div>
                                                </td>

                                                <td class="InputNum">
                                                    <select name="line_type" class="form-control filter-form inputType col-val">
                                                        @foreach($line_types as $key=>$line_type)
                                                            <option value="{{$key}}" @if($info->line_type_id == $key) selected @endif>{{$line_type}}</option>
                                                        @endforeach
                                                </select>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="water_amount" class="form-control numric wQuan col-val" value="{{$info->water_amount}}">

                                                    </div>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table tableborder">

                                        <thead>
                                            <tr>

                                                <th scope="col">الطول</th>
                                                <th scope="col">الاحداثيات</th>
                                                <th scope="col">المربعات التى يمر بها</th>
                                                <th scope="col">نص القطر/بوصة</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="number" name="lenght" class="form-control numric length col-val" min="0" value="{{$info->lenght}}">

                                                    </div>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="coordinate" class="form-control numric buy-date col-val" value="{{$info->coordinate}}">
                                                        <!-- <input type="text" class="form-control numric buy-date2"> -->

                                                    </div>
                                                </td>

                                                <td class="InputNum">

                                                    <select name="boxes[]" class="form-control select2 squ  col-val2 " multiple="multiple" style="width: 100%;">
                                                    @if(isset($info->boxes))
                                                        @foreach($all_boxes as $box)
                                                                @foreach($info->boxes as $box_pass)
                                                                    @if($box_pass == $box->code)
                                                                        <option value="{{$box->id}}" selected>{{$box->code}}</option>
                                                                    @endif
                                                                @endforeach
                                                        @endforeach
                                                            @foreach($all_boxes_null as $null_box)
                                                                <option value="{{$null_box->id}}" >{{$null_box->code}}</option>
                                                            @endforeach
                                                        @else
                                                        <option selected disabled>empty</option>
                                                        @foreach($all_boxes as $box)
                                                            <option value="{{$box->id}}" >{{$box->code}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="diameter_half" class="form-control numric " value="{{$info->diameter_half}}">

                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table tableborder">

                                        <thead>
                                            <tr>
                                                <th scope="col">سرعة المياة /البار</th>
                                                <th scope="col">محبس</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="water_speed" class="form-control numric " value="{{$info->water_speed}}">

                                                    </div>
                                                </td>

                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <label class="mr-2 mt-2">كود</label>
                                                        <input type="number" name="code_mahbas" class="form-control numric add_model_bar" value="{{$info->code_mahbas}}">
                                                        <label class="mr-2 ml-5 mt-2">نوع</label>
                                                        <input type="text" name="type_mahbas" class="form-control numric add_model_bar2" value="{{$info->type_mahbas}}">
                                                        <label class="mr-2 ml-5 mt-2 ">أحداثيات</label>
                                                        <input type="number" name="coordinate_mahbas" class="form-control numric add_model_bar3" value="{{$info->coordinate_mahbas}}">

                                                    </div>
                                                </td>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn save-btn" id="SubmitButton">حفظ</button>
                            </div>

                        </section>

                    </form>



                </div>

@if($operation_page)
    <div class="tab-pane fade  " id=" Intersec" role="tabpanel" aria-labelledby=" Intersec-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
        <div class="Mparent">
            <div class="Tparent">
                <div class="row m-3 justify-content-center ">
                    <div class="col-lg-12 ">
                        <table class="table zadnatable"  style="width:68%">
                            <thead>
                                <tr>
                                    <th>نوع الخط</th>
                                    <th>احداثيات التقاطع</th>
                                    <th class="actions">
                                        <i class="far fa-plus-square addlines" style="cursor: pointer"></i>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Intersection as $value)
                                    <tr>
                                        <td>{{ $value->line_type_id }}</td>
                                        <td>{{ $value->coordinates }}</td>
                                        <td>
                                            <button type="button" class="delete_intersection"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    $process_array=[
            'moduel_id'=>6
        ];
    @endphp
    @include('pages.backEnd.Operations.process',$process_array)

@endif



            </div>
        </div>
    </div>
</div>
</div>

@endsection