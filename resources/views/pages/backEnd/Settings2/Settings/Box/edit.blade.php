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
<script src="{{ asset('public') }}/js/backEnd/box.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
@include('pages.backEnd.AllModuels')
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
                            <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">المواصفات العامة</a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link linkColor " id="analyse-tab" data-toggle="tab" href="#analyse" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding:4px;font-size: 22px;">تحليل التربة</a>
                        </li>
        
                        <li class="nav-item ">
                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">موارد العملية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true" style="border: none;padding: 4px;font-size: 22px;">الملاحظات</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">توصيات</a>
                        </li>
                    </ul>
                    @endif
        
                    <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">
                        <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <form id="EditBoxForm" method="POST">
                                <input type="hidden" name="id" id="id" value="{{ $info->id }}">
                                <section class="content cropType">
                                    <div class="top-bar">
                                        <h6>
                                            اعدادات عامه > مربعات > اضافه/تعديل مربع
                                        </h6>
                                    </div>
        
                                    <div class="content p-5">
                                        <div class="Tparent">
                                            <div class="table-responsive">
                                                <table class="table tableborder">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">الموقع</th>
                                                            <th scope="col">عدد الصفوف</th>
                                                            <th scope="col">عدد الاعمدة</th>
                                                            <th scope="col">العمال المسئولين عنه </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="InputNum">
                                                                <div class="form-group InputGroup">
                                                                    <input type="text" value="{{ $info->south }}" name="south" class="form-control numric loc">
                                                                    <input type="text" value="{{ $info->north }}" name="north" class="form-control numric loc1">
                                                                    <input type="text" value="{{ $info->west }}" name="west" class="form-control numric loc2">
                                                                    <input type="text" value="{{ $info->east }}" name="east" class="form-control numric loc3">
        
                                                                </div>
                                                            </td>
                                                            <td class="InputNum">
                                                                <input type="text" value="{{ $info->row_count }}" name="row_count" class="form-control numric rows col-val">
                                                                <div id="row_count_demo"></div>
                                                            </td>
        
                                                            <td class="InputNum">
                                                                <input type="text" value="{{ $info->column_count }}" name="column_count" class="form-control numric coloms col-val">
                                                                <div id="column_count_demo"></div>
                                                            </td>
        
                                                            <td class="InputNum">
                                                                <select class="add_model_employee numric form-control select2 m-3" name="users[]" multiple="multiple" style="width: 100%;">
                                                                    @foreach ($Users as $value)
                                                                        @if(in_array($value->id,$info->Users))
                                                                        <option value="{{ $value->id }}" selected>{{ $value->username }}</option>
                                                                        @else
                                                                        <option value="{{ $value->id }}">{{ $value->username }}</option>
                                                                        @endif
                                                                       
                                                                    @endforeach
                                                                </select>
                                                                <div id="users_demo"></div>
                                                            </td>
                                                        </tr>
        
                                                    </tbody>
                                                </table>
        
        
                                                <table class="table tableborder">
        
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">مقاس المربع</th>
                                                            <th scope="col">الصف</th>
                                                            <th scope="col">العمود</th>
                                                            <th scope="col">الصنف </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="InputNum">
                                                                <input type="number" value="{{ $info->size }}" name="size" class="form-control numric rows add_model_row">
                                                            </td>
                                                            <td class="InputNum">
                                                                <select class="add_model_employee numric form-control select2 m-3" name="rows[]" multiple="multiple" style="width: 100%;">
                                                                    @for($i=1;$i<=10;$i++)
                                                                    @if(in_array($i,explode(",",$info->rows)))
                                                                    <option value="{{$i}}" selected>{{ $i }}</option>
                                                                    @else
                                                                    <option value="{{$i}}">{{ $i }}</option>
                                                                    @endif
                                                                    @endfor
                                
                                                                </select>
                                                                <div id="rows_demo"></div>
                                                            </td>
                                                            <td class="InputNum">
                                                                <select class="add_model_employee numric form-control select2 m-3" name="columns[]" multiple="multiple" style="width: 100%;">
                                                                        @for($i=1;$i<=10;$i++)
                                                                        @if(in_array($i,explode(",",$info->columns)))
                                                                        <option value="{{$i}}" selected>{{ $i }}</option>
                                                                        @else
                                                                        <option value="{{$i}}">{{ $i }}</option>
                                                                        @endif
                                                                        @endfor
                                
                                                                </select>
                                                                <div id="columns_demo"></div>
                                                            </td>
                                                            <td class="InputNum">
                                                                <select class="add_model_employee numric form-control select2 m-3" name="crops[]" multiple="multiple" style="width: 100%;">
                                                                    @foreach ($Crops as $value)
                                                                        @if(in_array($value->id,$info->Crops))
                                                                        <option value="{{ $value->id }}" selected>{{ $value->title }}</option>
                                                                        @else
                                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <div id="crops_demo"></div>
                                                            </td>
        
        
        
                                                        </tr>
                                                    </tbody>
                                                </table>
        
        
        
        
        
        
                                                <table class="table tableborder">
        
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="text-align: right;">الملاحظات</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="InputNum" style="width: 100%">
                                                                <div class="form-group">
                                                                    <textarea style="width: 100%; height: 100px" class="form-control numric add_model_notes" name="note">{{ $info->note }}</textarea>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
        
                                                <button type="button" class="btn save-btn ml-5 " id="SubmitButton">حفظ</button>
        
        
        
                                            </div>
        
                                        </div>
                                    </div>
                                </section>
                            </form>
        
                        </div>


                        @if($operation_page)

                        <div class="tab-pane fade " id="analyse" role="tabpanel" aria-labelledby="analyse-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                            <div class="Mparent">
                                <div class="Tparent">
                                    <div class="row m-3 justify-content-center ">
                                        <div class="col-lg-12 ">
                                            <table class="table zadnatable mainTable notesTable" tableId="14">
                                                <thead>
                                                    <tr>
                                                        <th>الملف</th>
                                                        <th>تاريخ رفع الملف</th>
                                                        <th>ملاحظات</th>
                                                        <th>توصيات</th>
                                                        <th class="actions">
                                                            <i class="far fa-plus-square" data-target="#SoilanalysisModel" data-toggle="modal" style="cursor: pointer"></i>
                                                        </th>
        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($soil_analysis as $value)
                                                        <tr>
                                                            <td><a href="{{ url('public//images/Uploads/box/') . '/' . $value->file }}" >ملف</a></td>
                                                            <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                                            <td>{{ $value->note }}</td>
                                                            <td>{{ $value->recommendation }}</td>
                                                            <td>
                                                                <button type="button" class="delete_soil_analysis"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
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
                        @php
                            $process_array=[
                                'moduel_id'=>2
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