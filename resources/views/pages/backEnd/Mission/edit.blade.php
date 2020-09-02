@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/store.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
    <div class="top-bar">

        <h6> مهام اضافية </h6>
    </div>

</section>
<div>
    <div class="row m-4">
        <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 0%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
            <li class="nav-item selected">
                <a class="nav-link active linkColor" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"
                    style="border: none;padding: 4px;font-size: 22px;">التفاصيل</a>
            </li>
            @if($show)  
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
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                <div class="row m-4 tab-top">
                    <div class="col-lg-12 col-sm-12 col-12 ">
                            <div class="table-responsive">
                                    <form id="AddMissionForm">
                                        <input type="hidden" id="id" value="" name="id">
                                        <div class="table-responsive">
                                            <table class="table tableborder">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">كود المربع</th>
                                                        <th scope="col">النوع</th>
                                                        <th scope="col">المهمة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="InputNum">
                                                            <select @if(!$show) readonly="readonly" @endif onchange="get_user(this.value)" class="form-control col-val" name="box_id" id="type">
                                                                <option value="">{{ $info->box_code }}</option>
                                                            
                                                        </select>
                                                        <div id="box_id_demo"></div>
                                                        </td>
                                                        <td class="InputNum">
                                                            <select @if(!$show) readonly="readonly" @endif class="form-control col-val" name="task_type_id" id="type">
                                                                <option value="">{{ $info->task_type }}</option>
                                                        </select>
                                                        <div id="task_type_id_demo"></div>
                                                        </td>
            
                                                        <td class="InputNum">
                                                            <input type="text" @if(!$show) readonly="readonly" @endif value="{{ $info->task }}" name="task" class="form-control numric " style="width: 70%;">
                                                            <div id="task_demo"></div>
                                                        </td>
            
            
                                                    </tr>
            
                                                </tbody>
                                            </table>
                                            <br> <br>
                                            <table class="table tableborder">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">المسؤل </th>
                                                        <th scope="col">تاريخ التنفيذ </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="InputNum">
                                                            <select @if(!$show) readonly="readonly" @endif class="form-control select2 col-val mySelectUser" name="to_id" style="width:70%;">
                                                                  <option>{{ $info->to }}<option>
                                                            </select>
                                                            <div id="to_id_demo"></div>
                                                        </td>
                                                        <td class="InputNum">
                                                            <div class="form-group InputGroup">
                                                                <input value="{{ $info->implementation_at }}" @if(!$show) readonly="readonly" @endif type="date" class="form-control numric " name="implementation_at" style="width: 70%;">
                                                                <div id="implementation_at_demo"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
            
                                                </tbody>
                                            </table>
            
                                            <table class="table tableborder">
            
                                                <thead>
                                                    <tr>
                                                            @if(!$show)
                                                        <th scope="col">الحاله </th>
                                                        @endif
                                                        <th scope="col">الملاحظات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                            @if(!$show)
                                                        <td>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" name="status_id" value="1" @if($info->status_id==1) checked @endif  id="customRadio1" name="customRadio" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio1">تم
                                                                    التنفيذ</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" name="status_id" value="2"  @if($info->status_id!=1) checked @endif id="customRadio2" name="customRadio" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio2">لم يتم
                                                                    التنفيذ</label>
                                                            </div>
                                                        </td>
                                                        @endif
                                                        <td>
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="note" @if(!$show) readonly="readonly" @endif>{{ $info->notes }}</textarea>
                                                            </div>
                                                            <div id="note_demo"></div>
                                                        </td>
            
                                                    </tr>
            
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </form>

                            </div>
                    </div>
                </div>
            </div>
            @php
                $process_array=[
                    'moduel_id'=>14
                ];
            @endphp
            @include('pages.backEnd.Operations.process',$process_array)
        </div>
    </div>
</div>
@endsection