@extends('layouts.backEnd')
@section('page_css')

@endsection
@section('page_script')

{{-- <script src="{{ asset('public') }}/js/maps.js"></script>   --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWYbhmg32SNq225SO1jRHA2Bj6ukgAQtA&libraries=places&language=en&callback=initMap"></script>
<script src="{{ asset('public/') }}/js/gmaps.js"></script>
<script>
  var map=new GMaps({
    div: '#map',
    lat: -12.043333,
    lng: -77.028333
  });
</script>
<script src="{{ asset('public') }}/js/backEnd/farm.js"></script>
<script>
    $(function () {
      $(".select2").select2();
    });
  </script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>  خريطة الارض</label>
        </div>

        <div col-lg-3>
            <div class="button-cont">
                <form id="form_upload2" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="name" value="map_earth" />
                    <input type="file" name="map_earth" data-id="form_upload2" id="file-10"  class="inputfileEnter inputfile inputfile-1 upload" data-multiple-caption="{count} files selected"
                    />
                    <label for="file-10">
                        <span>رفع صورة&hellip;</span>
                    </label>
                    <a target="_blank"  id="uploaded_file">الملف</a>
                    <div id="map_earth_demo"></div>
                </form>
            </div>
        </div>
    </div>
  <form id="AddFarmForm" method="POST">
    <input type="hidden" name="id" id="id" value="">
  <div class="top-bar">
    <h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{route('farm.index')}}">المزارع</a> > /أضافة مزرعة </h6>
  </div>
  <table class="table tableborder " style="width: 90%;
    margin: auto;">

    <thead>
      <tr>
        <th scope="col" style="text-align: right">موقع المزرعة</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
            <div id="map"></div>
        </td>


      </tr>

    </tbody>
  </table>

  <div class="content p-5">
    <table class="table tableborder">

      <thead>
        <tr>
          <th scope="col">الاسم</th>
          <th scope="col">المكان</th>
          <th scope="col">المساحة</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="InputNum ">
            <div class="form-group InputGroup">
              <input type="text" name="title" class="form-control numric NameCrop" min="0">
            </div>
            <div id="title_demo"></div>
          </td>

          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="location" class="form-control numric elmsa7a" min="0">
            </div>
            <div id="location_demo"></div>
          </td>
          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="number" name="area" class="form-control numric" min="0"><b>فدان</b>
            </div>
            <div id="area_demo"></div>
          </td>

        </tr>

      </tbody>
    </table>
    <table class="table tableborder">
      <thead>
        <tr>
          <th scope="col"> تاريخ الانشاء</th>
        </tr>
      </thead>
      <tbody>
        <tr>

          <td class="InputNum ">
            <div class="form-group InputGroup col-md-3">
              <input type="date" name="creation_date" class="form-control numric" min="0">
            </div>
            <div id="creation_date_demo"></div>
          </td>

        </tr>
      </tbody>
    </table>


</div>
    </form>
    <button type="button" value="Back"  id="SubmitButton"   class="btn save-btn">حفظ</button>



  </div>


  @endsection