@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=1;
    var report=false;
    $(function () {
      $(".select2").select2();
    });
  </script>
<script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    <form id="AddIrrigationForm" method="POST">
        <input type="hidden" name="id" id="id" value="">
        <section class="content cropType">
            <div class="top-bar">
                <h6>اعدادات عامه >شبكة الرى> اضافه / تعديل خط  </h6>
            </div>
            <div class="content p-5">
                <div class="table-responsive">
                    <table class="table tableborder">
                        <thead >
                        <tr >
                            <th scope="col">نوع الخط</th>
                            <th scope="col" class="primary" style="display: none">خط رئيسى  </th>
                            <th scope="col" class="under_primary" style="display: none">خط تحت رئيسى</th>
                            <th scope="col" class="sub" style="display: none">خط فرعى</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="InputNum" >
                                <select name="line_type" id="line_type" class="form-control filter-form inputType col-val" >
                                    <option selected disabled>اختر نوع الخط</option>
                                    @foreach($line_types as $key=>$line_type)
                                        <option value="{{$key}}">{{$line_type}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="InputNum primary" style="display: none">
                                <select id="primary_line" name="primary_line"   class="form-control filter-form inputType col-val" >
                                </select>
                            </td>
                            <div id="primary_line_demo"></div>

                            <!-- <td class="InputNum under_primary" style="display: none">
                                <select  id="under_primary_line"  name="under_primary_line" class="form-control filter-form inputType col-val" >
                                </select>
                                <div id="under_primary_line_demo"></div>
                            </td> -->

                            <!-- <td class="InputNum sub" style="display: none">
                                <select  id="sub"  name="sub" class="form-control filter-form inputType col-val" >
                                </select>
                                <div id="line_type"></div>
                                <div id="sub_demo"></div>
                            </td> -->

                        </tr>
                        </tbody>

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
                                    <input type="text" name="title" class="form-control numric name col-val">
                                </div>
                                <div id="title_demo"></div>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="water_amount" class="form-control numric wQuan col-val">
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
                                                    <input type="text" name="point1" class="form-control numric loc"
                                                           placeholder="نقطه1 ">
                                                    <div id="point1_demo"></div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="box_point1">
                                                        <div class="row">
                                                            <div class="col-sm-3 p-0">
                                                                <input type="text" name="north[]" class="form-control numric loc"
                                                                       placeholder="شمال ">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="degree[]" type="text" class="form-control numric loc1"
                                                                       placeholder="درجه">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="minute[]" type="text" class="form-control numric loc1"
                                                                       placeholder="دقيقه">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="second[]" type="text" class="form-control numric loc1"
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
                                                                <input type="text" name="east[]" class="form-control numric loc"
                                                                       placeholder="شرق ">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="degree[]" type="text" class="form-control numric loc1"
                                                                       placeholder="درجه">

                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="minute[]" type="text" class="form-control numric loc1"
                                                                       placeholder="دقيقه">

                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="second[]" type="text" class="form-control numric loc1"
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
                                                    <input type="text" name="point2" class="form-control numric loc"
                                                           placeholder="نقطه2">
                                                    <div id="point2_demo"></div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="box_point1">
                                                        <div class="row">
                                                            <div class="col-sm-3 p-0">
                                                                <input type="text" name="north[]" class="form-control numric loc"
                                                                       placeholder="شمال ">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="degree[]" type="text" class="form-control numric loc1"
                                                                       placeholder="درجه">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="minute[]" type="text" class="form-control numric loc1"
                                                                       placeholder="دقيقه">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="second[]" type="text" class="form-control numric loc1"
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
                                                                <input type="text" name="east[]" class="form-control numric loc"
                                                                       placeholder="شرق ">
                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="degree[]" type="text" class="form-control numric loc1"
                                                                       placeholder="درجه">

                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="minute[]" type="text" class="form-control numric loc1"
                                                                       placeholder="دقيقه">

                                                            </div>
                                                            <div class="col-sm-3 p-0">

                                                                <input name="second[]" type="text" class="form-control numric loc1"
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
                                    <input type="number" name="lenght" class="form-control numric length col-val" min="0">
                                </div>
                            </td>

                            <td class="InputNum">

                                <select name="boxes[]" class="form-control select2 squ  col-val2 " multiple="multiple" style="width: 100%;">
                                    @foreach($all_boxes as $box)
                                       <option value="{{$box->id}}">{{$box->code}}</option>
                                   @endforeach
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
                                    <input type="text" name="diameter_half" class="form-control numric ">
                                </div>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="water_speed" class="form-control numric ">
                                </div>
                                <div id="water_speed_demo"></div>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="cost" class="form-control numric ">
                                </div>
                                <div id="cost_demo"></div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                
            <button type="button"  class="btn save-btn" id="SubmitButton">حفظ</button>
            </form>
            <br>
            <br>
            <!--
             
            
                <button type="submit" name="up" class="btn save-btn" id="editButton">تعديل الخط الفرعي</button>
                </form>
            </div>-->


        </section>

    


@endsection