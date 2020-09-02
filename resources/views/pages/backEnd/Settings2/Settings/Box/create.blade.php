@extends('layouts.backEnd')
@section('page_css')
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
<form id="AddBoxForm" method="POST">
<input type="hidden" name="id" id="id" value="">
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
                                    <input type="text" name="south" class="form-control numric loc">
                                    <input type="text" name="north" class="form-control numric loc1">
                                    <input type="text" name="west" class="form-control numric loc2">
                                    <input type="text" name="east" class="form-control numric loc3">

                                </div>
                            </td>
                            <td class="InputNum">
                                <input type="text" name="row_count" class="form-control numric rows col-val">
                                <div id="row_count_demo"></div>
                            </td>

                            <td class="InputNum">
                                <input type="text" name="column_count" class="form-control numric coloms col-val">
                                <div id="column_count_demo"></div>
                            </td>

                            <td class="InputNum">
                                <select class="add_model_employee numric form-control select2 m-3" name="users[]" multiple="multiple" style="width: 100%;">
                                    @foreach ($Users as $value)
                                        <option value="{{ $value->id }}">{{ $value->username }}</option>
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
                                <input type="number" name="size" class="form-control numric rows add_model_row">
                            </td>
                            <td class="InputNum">
                                <select class="add_model_employee numric form-control select2 m-3" name="rows[]" multiple="multiple" style="width: 100%;">
                                        @for($i=1;$i<=10;$i++)
                                        <option value="{{$i}}">{{ $i }}</option>
                                        @endfor
                                </select>
                                <div id="rows_demo"></div>

                            </td>
                            <td class="InputNum">
                                <select class="add_model_employee numric form-control select2 m-3" name="columns[]" multiple="multiple" style="width: 100%;">
                                        @for($i=1;$i<=10;$i++)
                                        <option value="{{$i}}">{{ $i }}</option>
                                        @endfor
                                </select>
                                <div id="columns_demo"></div>

                            </td>
                            <td class="InputNum">
                                <select class="add_model_employee numric form-control select2 m-3" name="crops[]" multiple="multiple" style="width: 100%;">
                                    @foreach ($Crops as $value)
                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
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
                                    <textarea style="width: 100%; height: 100px" class="form-control numric add_model_notes" name="note"></textarea>
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
@endsection