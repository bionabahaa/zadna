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
<script src="{{ asset('public') }}/js/backEnd/irrigation.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    <form id="AddIrrigationForm" method="POST">
        <input type="hidden" name="id" id="id" value="">
        <section class="content cropType">
            <div class="top-bar">
                <h6>اعدادات عامه >شبكة الرى> اضافه /تعديل خط  </h6>
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
                                    <input type="text" name="title" class="form-control numric name col-val">

                                </div>
                            </td>

                            <td class="InputNum">
                                <select name="line_type" class="form-control filter-form inputType col-val" >
                                    @foreach($line_types as $key=>$line_type)
                                        <option value="{{$key}}">{{$line_type}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="water_amount" class="form-control numric wQuan col-val">

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
                                    <input type="number" name="lenght" class="form-control numric length col-val" min="0">

                                </div>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="coordinate" class="form-control numric buy-date col-val" placeholder="eg : 1.444 , -4.88">
                                    <!-- <input type="text" class="form-control numric buy-date2"> -->

                                </div>
                            </td>

                            <td class="InputNum">

                                <select name="boxes[]" class="form-control select2 squ  col-val2 " multiple="multiple" style="width: 100%;">
                                    @foreach($all_boxes as $box)
                                       <option value="{{$box->id}}">{{$box->code}}</option>
                                   @endforeach
                                </select>
                            </td>
                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="text" name="diameter_half" class="form-control numric ">

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
                                    <input type="text" name="water_speed" class="form-control numric ">

                                </div>
                            </td>

                            <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <label class="mr-2 mt-2">كود</label>
                                    <input type="number" name="code_mahbas" class="form-control numric add_model_bar">
                                    <label class="mr-2 ml-5 mt-2">نوع</label>
                                    <input type="text" name="type_mahbas" class="form-control numric add_model_bar2">
                                    <label class="mr-2 ml-5 mt-2 ">أحداثيات</label>
                                    <input type="number" name="coordinate_mahbas" class="form-control numric add_model_bar3">

                                </div>
                            </td>


                        </tr>

                        </tbody>
                    </table>
                </div>
                <button type="button"  class="btn save-btn" id="SubmitButton">حفظ</button>
            </div>

        </section>

    </form>


@endsection