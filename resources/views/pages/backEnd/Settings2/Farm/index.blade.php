@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/farm.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
  <section class="content cropType">
    <div class="top-bar">
      <h6>اعدادات عامه > المزارع</h6>
    </div>
    <div class="Tparent">

      <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
        <div class="col-lg-10">
          <div class="row filter-res">

            <div class="col-lg-2 col-sm-12 col-md-12 col-12">
              <div>
                <label>نوع المحصول :</label>
              </div>
              <select class="form-control filter-form filter1" id="filter_type">
                <option>الكل</option>
                @foreach ($crops as $value)
                <option value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
              </select>
            </div>


          </div>

        </div>
        <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12">
          {{-- <label class="search-icon">
            <input type="text" class="search" id="myInput">
          </label> --}}

        </div>

      </div>

      <div class="row m-4">


        <div class="float-left ">

          <button class="add-crepto mr-2 mb-2 " onclick="window.location.href='{{ url('setting/farms/create/') }}'">أضافة مزرعة</button>


          <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>


          <button class="export-excel mr-2 mb-2">أخراج كاملف اكسيل</button>



        </div>

      </div>

      <div class="row m-3 justify-content-center ">
        <div class="col-lg-10 ">

          <table class="table zadnatable" id="FarmDataTable">
            <thead>
              <tr>
                <th>الكود</th>
                <th>الاسم</th>
                <th>نوع المحصول</th>
                <th>االمساحة</th>
                <th>الفدان</th>
                <th>العمليات</th>
              </tr>
            </thead>
          </table>
        </div>




      </div>


    </div>

  </section>
@endsection



