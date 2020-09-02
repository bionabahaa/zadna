@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var level_id = 1;
    var report = false;
    var operation_page=1;
    $(function () {
        $(".select2").select2();
      });
  </script>
<script src="{{ asset('public') }}/js/backEnd/protection.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
<div class="row m-0">
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
        <div>
            <div class="row  mt-0 mr-4 ml-4 mb-4">
                    <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                        <li class="nav-item selected ">
                            <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails"
                                aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">المواصفات العامة</a>
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
                                style="border: none;padding: 4px;ont-size: 22px;">توصيات</a>
                        </li>
                    </ul>


                <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">
                    <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        <form action="POST" id="EditProtectionForm">
                            <input type="hidden" name="id" value="{{ $info->id }}" id="id">
                            <div class="row m-4 tab-top">
                                <div class="col-lg-12 col-sm-12 col-12 ">
                                    <table class="table borderless table1">
                                        <thead>
                                            <tr>
                                                <th scope="col"> أسم المبيد</th>
                                                <th scope="col"> الكميه الكليه للمبيد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border_bottom">
                                                <td>
                                                    <div class="form-inline">
                                                        <input readonly type="text" value="{{ $info->pesticide_title }}" name="pesticide_title" class=" border-style  mr-4 mes td-edit" style="width: 100%;">
                                                    </div>
                                                    <div id="pesticide_title_demo"></div>
                                                </td>
                                                <td>
                                                    <div class="form-inline">
                                                        <input readonly value="{{ $info->pesticide_QYT }}" type="number" name="pesticide_QYT" class=" border-style  mr-4 mes td-edit" style="width: 20%;">
                                                    </div>
                                                    <div id="pesticide_QYT_demo"></div>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12 " style="display: none">
                                        <table class="table borderless table1">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> الكميه للنخله</th>
                                                    <th scope="col"> النخل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border_bottom">
                                                    <td>
                                                        <div class="form-inline">
                                                            <input type="number" value="{{ $info->palm_tree_QYT }}" name="palm_tree_QYT" class=" border-style  mr-4 mes td-edit" style="width: 20%;">
                                                            لتر
                                                        </div>
                                                        <div id="palm_tree_QYT_demo"></div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group InputGroup">
                                                            <select name="palm_tree[]" class="form-control numric select2 typescrop td-edit" style="width: 100%;" multiple="multiple" style="width: 100%;">
                                                                <option value="">أختار النخل</option>
                                                                @foreach ($PalmTree as $value)
                                                                    <option @if(in_array($value,$info->palm_tree)) selected  @endif>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="palm_tree_demo"></div>
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
                                                {{-- <th scope="col">طريقه الاستخدام</th> --}}
                                                <th scope="col">تنفذ بواسطة</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border_bottom">

                                                <td>
                                                    <div class="form-inline">
                                                        <div class="col-6">
                                                            من:
                                                            <input name="start_date" value="{{ $info->start_date }}"  type="date" class="form-control numric td-edit">
                                                        </div>
                                                        <div id="start_date_demo"></div>
                                                        <br>
                                                        <div class="col-6">
                                                            :الى
                                                            <input type="date" value="{{ $info->end_date }}" name="end_date" class="form-control numric td-edit">
                                                        </div>
                                                        <div id="end_date_demo"></div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="form-inline">
                                                            <select name="used_type_id" class="form-control numric select2 typescrop td-edit" style="width: 100%;">
                                                                @foreach ($used_type as $key=>$value)
                                                                    <option @if($info->used_type_id==$key) selected @endif  value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <div id="used_type_id_demo"></div>
                                                </td>
                                                <td>
                                                    <div class="form-group InputGroup">
                                                        <select name="user_id" class="form-control numric select2 typescrop td-edit" style="width: 100%;">
                                                            @foreach ($Users as $value)
                                                                <option @if($info->user_id==$value->id) selected @endif value="{{ $value->id }}">{{ $value->username }}</option>
                                                            @endforeach
                                                        </select>
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

                                                {{-- <th scope="col">التنفيذ</th> --}}
                                                <th scope="col">الوصية</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border_bottom">
                                                {{-- <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="implementation" class="form-check-input td-edit" id="exampleCheck1" @if( $info->implementation)checked @endif>
                                                        <label class="form-check-label" for="exampleCheck1"></label>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <div class="form-group InputGroup">
                                                <textarea name="recommendtion"  class="form-control numric td-edit" >{{ $info->recommendation }}</textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                        <div class="col pl-5">

                            @if($healper->check_permission(20,6))
                               <button type="button" id="SubmitButton" class="btn edit-btn ml-5" style="background-color:green">تعديل</button>
                            @endif
                            <button type="button" class="btn save-btn ml-5 save-edit-tabs " hidden="">حفظ</button>
                        </div>

                    </div>
                    @php
                        $process_array=[
                            'moduel_id'=>5,
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