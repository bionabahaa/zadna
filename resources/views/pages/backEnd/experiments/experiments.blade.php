@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/experiment.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')

@if($healper->check_permission(31,1))
    <section class="content cropType" >
        <div class="top-bar">

            <h6> التجارب  </h6>
        </div>
        <div class="Tparent" >
            @if($healper->check_permission(31,2))
              <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                <div class="col-lg-10">

                    <div class="row filter-res">

                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div >
                                <label>نوع التجربة :</label>
                            </div>
                            <select id="status" class="form-control filter-form " >
                                <option value="all">الكل</option>
                                <option value="1">نوع1</option>
                                <option value="2">نوع2</option>
                                <option value="3">نوع3</option>
                            </select>
                        </div>
                        {{--<div class="col-lg-2 col-sm-12 col-md-12 col-12">--}}
                            {{--<div >--}}
                                {{--<label>المربع :</label>--}}
                            {{--</div>--}}
                            {{--<select class="form-control filter-form " >--}}

                                {{--<option>الكل</option>--}}
                                {{--<option> بئر</option>--}}
                                {{--<option> طرمبة</option>--}}
                                {{--<option> مولد</option>--}}
                                {{--<option> معدات</option>--}}
                                {{--<option> شبكه الري</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>
                </div>
                  <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('DataTablE_experiment','Experiments/data_experiments/experiment')" >بحث</span>

              </div>


            @endif
            <div class="row m-4">


                <div class="float-left " >

                    @if($healper->check_permission(31,3))
                    <button class="add-crepto mr-2 mb-2 addNewRow " onclick="window.location.href='{{url('Experiments/add_experiment')}}'" >إضافة تجربة </button>
                    @endif

                    {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}
                    @if($healper->check_permission(31,8))
                            <a href="{{ URL::to('downloadExcel/xls/Experiments/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                    @endif
                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table id="DataTablE_experiment" class="table zadnatable mainTable" tableId="11">
                        <thead >
                        <tr >
                            <th>الكود</th>
                            <th>أسم التجربة </th>
                            <th>نوع التجربة</th>
                            <th>المربع </th>
                            <th>النخلة</th>
                            <th class="actions">العمليات</th>

                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </section>
@else
    <h1 style="text-align: center;color: #28a745;margin-top: 150px;">ليس لديك صلاحيه للتحكم فى صفحات  التجارب</h1>
    @endif
@endsection