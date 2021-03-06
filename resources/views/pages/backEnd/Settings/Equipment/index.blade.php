@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/elequent.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > معدات</h6>
    </div>
    <div class="Tparent">
        @if($healper->check_permission(7,2))
        <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
            <div class="col-lg-10">
                <div class="row filter-res">

                    <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                        <div>
                            <label>النوع :</label>
                        </div>
                        <select class="form-control filter-form filter1" id="filter_type">
                        <option value="all">الكل</option>
                        @foreach ($Types as $value)
                           <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">
                {{-- <label class="search-icon">
                      <input type="text" class="search" id="myInput">
                </label> --}}
            </div>
        </div>
        @endif
        <div class="row m-4">
            <div class="float-left ">
                @if($healper->check_permission(7,3))
                <button class="add-crepto mr-2 mb-2" onclick="window.location.href='{{ url('setting/equipments/create/') }}'">أضافة  مُعَدَّة</button>
                @endif

                {{--<button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>--}}

                    @if($healper->check_permission(7,4))
                          <a href="{{ URL::to('downloadExcel/xls/Equipments/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                  @endif




            </div>

        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-10 ">

                <table class="table zadnatable" id="EquipmentsDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>النوع</th>
                            <th>الاسم</th>
                            <th>الموديل </th>
                            <th>العمليات</th>

                        </tr>
                    </thead>
                </table>
            </div>

        </div>

    </div>

</section>
@endsection



