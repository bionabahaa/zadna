@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
<script>
    var level_id = 1;
    var operation_page=1;
    $(function () {
        $(".select2").select2();
      });
  </script>
{{-- <script src="{{ asset('public') }}/js/backEnd/nutria.js"></script> --}}

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
<div class="row m-0">
    {{-- @include('pages.backEnd.Operations.rightLink') --}}
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
                    <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                        
                            <div class="row m-4 tab-top">
                                <form action="" id="EditNutriaForm" style="width: 100%">
                                        <input type="hidden" id="id" name="id" value="{{ $info->id }}">
                                    <div class="col-lg-12 col-sm-12 col-12 ">
                                        <table class="table borderless table1">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> عدد النخل بالكيب</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border_bottom">
                                                    <td>
                                                        <div>
                                                            <input type="number" name="palm_tree_QYT" value="{{ $info->palm_tree_QYT }}" class="form-control numric td-edit">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                       
                            <div class="col pl-5">

                                @if($healper->check_permission(17,6))
                                    <button type="button" id="SubmitButton" class="btn edit-btn ml-5" style="background-color:green">تعديل</button>
                                @endif
                                <button type="button" class="btn save-btn ml-5 save-edit-tabs " hidden="">حفظ</button>
                            </div>
                        </div>
                @php
                    $process_array=[
                        'moduel_id'=>7,
                        'box_id'=>$info->box_id
                    ];
                @endphp
                @include('pages.backEnd.Operations.process',$process_array)
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection