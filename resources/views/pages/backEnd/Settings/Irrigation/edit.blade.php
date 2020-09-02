@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
    <script>
        var operation_page=1;
        var report=false;
        $(function () {
            $(".select2").select2();
        });
        $(document).on("click", ".addlines", function () {

            var table = $(this).parents("table").find("tbody");
            var tr = '<tr >' +

                '<td>' +
                ' <div class="form-group InputGroup">' +
                ' <select class=" numric  typescrop td-input" style="width: 100%;background-color: #fff !important;">' +
                '<option>1</option>' +
                '<option>2</option>' +

                ' </select>' +

                '</div>' +
                ' </td>' +
                '<td>' +
                '<div class="form-group InputGroup">' +
                '<input type="text" class="form-control td-input" value="1" >' +

                ' </div>' +
                ' </td>' +

                ' <td class="query-td">' +
                ' <i class="fas fa-edit edit-row" hidden></i>' +
                '<i class="fas fa-save save-edit" ></i>' +
                ' </td>' +
                ' </tr>';
            table.append(tr);
        });
        function Edittable(row,editbtn) {
            var savebtn=row.find(".save-edit");
            var td=row.find("td");
            // var date=row.find("input");
            editbtn.attr("hidden",true);
            savebtn.attr("hidden",false);
            td.attr("contenteditable",true);
            td.css({
            "box-sizing": "border-box ",
                "border": "2px inset #ccc",
            "border-radius": "4px",
                "padding":" 7px"
        
            });
            savebtn.click(function () {
                editbtn.attr("hidden",false);
                savebtn.attr("hidden",true);
            td.attr("contenteditable",false);
                td.css({
                    "border": "none",
                    "border-radius": "0",
                    "padding":" 0"
        
                });
            })
        }

        $(document).on("click",".save-edit",function(){
            var row=$(this).parents("tr");
            var edit=$(this).parents("tr").find(".edit-row");

            Edittable(row,edit);
        })


    </script>
    <script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
<div class="row m-0">
@if($operation_page)
    @include('pages.backEnd.Operations.rightLink')
    <div class="col-sm-10 col-10 p-0">
@else
    <div class="col-sm-12 col-10 p-0">
@endif


    <div>
        <div class="row  mt-0 mr-4 ml-4 mb-4">

            <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                <li class="nav-item selected ">
                    <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none; padding: 4px; font-size: 22px;">المواصفات العامة</a>
                </li>
                @if($healper->check_permission(9,11))
                <li class="nav-item ">
                    <a class="nav-link linkColor" id="home1-tab" data-toggle="tab" href="#home1" role="tab"
                       aria-controls="home" aria-selected="false" style="border: none;
                            padding: 4px;
                            font-size: 22px;">
                        المحابس
                    </a>
                </li>
                @endif
                @if($operation_page)
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
                @endif
            </ul>


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

                                        <thead >
                                        <tr >
                                            <th scope="col">نوع الخط</th>
                                            <th scope="col" class="primary" @if($info->line_type_id==3)  style="" @else style="display: none"   @endif>خط رئيسى  </th>
                                            <th scope="col" class="under_primary" @if($info->line_type_id==2)  style=""   @else style="display: none" @endif>خط تحت رئيسى</th>
                                            <th scope="col" class="sub" @if($info->line_type_id==4)   style="" @else style="display: none" @endif>خط فرعى</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="InputNum" >
                                                <select name="line_type" id="line_type" class="form-control filter-form inputType col-val" >
                                                    <option selected disabled>اختر نوع الخط</option>
                                                    @foreach($line_types as $key=>$line_type)
                                                        <option value="{{$key}}" @if($key==$info->line_type_id) selected @endif>{{$line_type}}</option>
                                                    @endforeach
                                                </select>
                                                <div id=""></div>
                                            </td>

                                            <td class="InputNum primary"  @if($info->line_type_id==3)  style="" @else style="display: none"   @endif>
                                                <select id="primary_line" name="primary_line"   class="form-control filter-form inputType col-val" >
                                                    @foreach($lines as $line)
                                                        <option value="{{$line->code}}" @if($code_irrig==$line->code) selected @endif>{{$line->code}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="primary_line_demo"></div>
                                            </td>

                                            <td class="InputNum under_primary"  @if($info->line_type_id==2)  style=""   @else style="display: none" @endif>
                                                <select  id="under_primary_line" name="under_primary_line" class="form-control filter-form inputType col-val" >
                                                    @foreach($lines as $line)
                                                        <option value="{{$line->code}}" @if($code_irrig==$line->code) selected @endif>{{$line->code}}</option>
                                                    @endforeach

                                                </select>
                                                <div id="under_primary_line_demo"></div>
                                            </td>

                                            <td class="InputNum sub" @if($info->line_type_id==4)   style="" @else style="display: none" @endif>
                                                <select  id="sub" name="sub" class="form-control filter-form inputType col-val" >
                                                    @foreach($lines as $line)
                                                        <option value="{{$line->code}}" @if($code_irrig==$line->code) selected @endif>{{$line->code}}</option>
                                                    @endforeach

                                                </select>
                                                <div id="sub_demo"></div>
                                            </td>


                                        </tr>
                                        </tbody>

                                        <thead>

                                        <thead>
                                            <tr>

                                                <th scope="col">الاسم</th>
                                                <th scope="col">كمية المياه</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="title" class="form-control numric name col-val" value="{{$info->title}}">
                                                    </div>
                                                    <div id="title_demo"></div>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="water_amount" class="form-control numric wQuan col-val" value="{{$info->water_amount}}">
                                                    </div>
                                                    <div id="water_amount_demo"></div>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table tableborder">

                                        <thead>
                                            <tr>
                                                <th scope="col">الاحداثيات</th>
                                                <th scope="col">الطول</th>
                                                <th scope="col">المربعات التى يمر بها</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="InputNum td-rep"  style="width:60%">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group ">

                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="point1" value="{{$point1[0]}}"  class="form-control numric loc"
                                                                               placeholder="نقطه1 ">
                                                                        <div id="point1_demo"></div>
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <div class="box_point1">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 p-0">
                                                                                    <input type="text" name="north[]"  value="{{$point1_north[0]}}"  class="form-control numric loc"
                                                                                           placeholder="شمال ">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="degree[]" type="text"  value="{{$point1_north[1]}}"  class="form-control numric loc1"
                                                                                           placeholder="درجه">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="minute[]" type="text"  value="{{$point1_north[2]}}"  class="form-control numric loc1"
                                                                                           placeholder="دقيقه">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="second[]" type="text"  value="{{$point1_north[3]}}"  class="form-control numric loc1"
                                                                                           placeholder="ثانيه">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-sm-7 offset-sm-4">
                                                                        <div class="box_point1">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 p-0">
                                                                                    <input type="text" name="east[]" value="{{$point1_east[0]}}"  class="form-control numric loc"
                                                                                           placeholder="شرق ">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="degree[]" type="text" value="{{$point1_east[1]}}"  class="form-control numric loc1"
                                                                                           placeholder="درجه">

                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="minute[]" type="text" value="{{$point1_east[2]}}"  class="form-control numric loc1"
                                                                                           placeholder="دقيقه">

                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="second[]" type="text" value="{{$point1_east[3]}}"  class="form-control numric loc1"
                                                                                           placeholder="ثانيه">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">

                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="point2" value="{{$point2[0]}}" class="form-control numric loc"
                                                                               placeholder="نقطه2">
                                                                        <div id="point2_demo"></div>
                                                                    </div>


                                                                    <div class="col-sm-7">
                                                                        <div class="box_point1">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 p-0">
                                                                                    <input type="text" name="north[]" value="{{$point2_north[0]}}"  class="form-control numric loc"
                                                                                           placeholder="شمال ">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="degree[]" type="text" value="{{$point2_north[1]}}"  class="form-control numric loc1"
                                                                                           placeholder="درجه">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="minute[]" type="text" value="{{$point2_north[2]}}"  class="form-control numric loc1"
                                                                                           placeholder="دقيقه">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="second[]" type="text" value="{{$point2_north[3]}}"  class="form-control numric loc1"
                                                                                           placeholder="ثانيه">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-sm-7 offset-sm-4">
                                                                        <div class="box_point1">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 p-0">
                                                                                    <input type="text" name="east[]" value="{{$point2_east[0]}}"  class="form-control numric loc"
                                                                                           placeholder="شرق ">
                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="degree[]" type="text" value="{{$point2_east[1]}}"  class="form-control numric loc1"
                                                                                           placeholder="درجه">

                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="minute[]" type="text" value="{{$point2_east[2]}}"  class="form-control numric loc1"
                                                                                           placeholder="دقيقه">

                                                                                </div>
                                                                                <div class="col-sm-3 p-0">

                                                                                    <input name="second[]" type="text" value="{{$point2_east[3]}}"  class="form-control numric loc1"
                                                                                           placeholder="ثانيه">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="number" name="lenght" class="form-control numric length col-val" min="0" value="{{$info->lenght}}">

                                                    </div>
                                                </td>
                                                <td class="InputNum">
                                                    <select name="boxes[]" class="form-control select2 squ  col-val2 " multiple="multiple" style="width: 100%;">
                                                        {{--@if(!empty ($all_boxes))--}}
                                                            @foreach($all_boxes as $box)
                                                                <option value="{{$box->id}}"  @if(in_array($box->code,$info->boxes)) selected @endif >{{$box->code}}</option>
                                                            @endforeach
                                                       {{--@endif--}}
                                                    </select>
                                                    <div id="boxes_demo"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table tableborder">

                                        <thead>
                                            <tr>
                                                <th scope="col">نص القطر/بوصة</th>
                                                <th scope="col">سرعة المياة /البار</th>
                                                <th scope="col">التكلفه</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="diameter_half" class="form-control numric " value="{{$info->diameter_half}}">
                                                        <div id="diameter_half_demo"></div>

                                                    </div>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="number" name="water_speed" class="form-control numric " value="{{$info->water_speed}}">
                                                    </div>
                                                    <div id="water_speed_demo"></div>
                                                </td>
                                                <td class="InputNum">
                                                    <div class="form-group InputGroup">
                                                        <input type="text" name="cost" value="{{$info->cost}}" class="form-control numric ">
                                                    </div>
                                                    <div id="cost_demo"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table class="table tableborder">

                                        <thead>
                                        <tr>
                                            @if($operation_page)
                                                <th>توقيع </th>
                                                <th> ملف توقيع </th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @if($operation_page)
                                                <td>
                                                    <input type="checkbox" name="signed" value="1" @if($info->signed==1) checked @endif title="توقيع البير">
                                                </td>
                                                <td>
                                                    <input type="file" data-id="form_upload" name="signed_file" id="file-1" class="inputfile inputfile-1"
                                                    />
                                                    <label for="file-1">
                                                        <span>تحميل ملف&hellip;</span>
                                                    </label>
                                                    <a target="_blank" href="{{asset('public/images/Uploads/irrigation/'.str_replace(' ','',@$info->signed_file) )}}"  id="uploaded_file">الملف</a>
                                                </td>
                                            @endif
                                        </tr>
                                        </tbody>
                                    </table>



                                </div>
                                @if($healper->check_permission(9,6))
                                <button type="button" class="btn save-btn" id="SubmitButton">حفظ</button>
                                @endif
                            </div>

                        </section>

                    </form>



                </div>

                <div class="tab-pane fade" id="home1" role="tabpanel" aria-labelledby="home-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

                    <div class="Tparent">
                        <div class="row m-4">
                            <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                                <button class="add-crepto mr-2 mb-2 addNewRow " id="click_mahbas" data-target="#addnew" data-toggle="modal">أضافة
                                    محبس</button>
                            </div>
                        </div>
                        <div class="row m-3 justify-content-center ">
                            <div class="col-lg-12 ">

                                <table id="DataTableMahbas" class="table zadnatable mainTable" tableid="10" width="100%">
                                    <thead>
                                    <tr>
                                        <th>الكود</th>
                                        <th>الوصف</th>
                                        <th>الموقع</th>
                                        <th class="actions">
                                            <i class="fas fa-bars"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="paginate paginate-0">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="addnew" class="modal fade " role="dialog" currtable="">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content modalbg-add">
                                    <div class="modal-header d-flex flex-row-reverse">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h5 class="modal-title text-center ">اضافه</h5>
                                    </div>
                         <form id="FormaddMahbas" method="post">
                                        <input type="hidden" id="irrigation_id"  name="irrigation_id">
                                        <input type="hidden" name="id" id="id" value="{{$info->id}}">
                                    <div class="modal-body">
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <label class="col-4" for="descrep">الوصف:</label>
                                                <textarea name="desc" id="descrep" class="col-val border-style col-6 desc_mahbas"></textarea>
                                            </div>
                                            <div id="desc_demo"></div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="form-group InputGroup">
                                                <label class="col-4" for="descrep">الموقع:</label>

                                                <div class="form-group ">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <input type="text" name="mahbas_point1" id="mahbas_point1"  class="form-control numric loc"
                                                                   placeholder="نقطه1 ">
                                                            <div id="mahbas_point1_demo"></div>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <div class="box_point1">
                                                                <div class="row">
                                                                    <div class="col-sm-3 p-0">
                                                                        <input type="text" name="north"  id="north"  class="form-control numric loc"
                                                                               placeholder="شمال ">
                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="degree[]" type="text" id="degree_north"  class="form-control numric loc1"
                                                                               placeholder="درجه">
                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="minute[]" type="text"  id="minute_north" class="form-control numric loc1"
                                                                               placeholder="دقيقه">
                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="second[]" type="text" id="second_north"   class="form-control numric loc1"
                                                                               placeholder="ثانيه">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7 offset-sm-4">
                                                            <div class="box_point1">
                                                                <div class="row">
                                                                    <div class="col-sm-3 p-0">
                                                                        <input type="text" name="east" id="east" class="form-control numric loc"
                                                                               placeholder="شرق ">
                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="degree[]" type="text" id="degree_east" class="form-control numric loc1"
                                                                               placeholder="درجه">

                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="minute[]" type="text" id="minute_east" class="form-control numric loc1"
                                                                               placeholder="دقيقه">

                                                                    </div>
                                                                    <div class="col-sm-3 p-0">

                                                                        <input name="second[]" type="text" id="second_east"  class="form-control numric loc1"
                                                                               placeholder="ثانيه">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>









                                                {{--<input type="text" name="north" id="north" class="form-control numric loc" placeholder="شمال ">--}}
                                                {{--<input type="text" name="east"  id="east" class="form-control numric loc" placeholder="شرق">--}}
                                                {{--<input name="degree"  type="text" id="degree" class="form-control numric loc1" placeholder="درجه">--}}
                                                {{--<input name="minute"  type="text" id="minute" class="form-control numric loc1" placeholder="دقيقه">--}}
                                                {{--<input name="second"  type="text" id="second" class="form-control numric loc1" placeholder="ثانيه">--}}
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                        </form>
                                    <div class="modal-footer">
                                        <a href="#" id="addMahbas" type="button" class="danger btn btn-primary btnSave ">حفظ</a>
                                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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
    @php
    $process_array=[
            'moduel_id'=>12
        ];
    @endphp
    @include('pages.backEnd.Operations.process',$process_array)

@endif



            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection