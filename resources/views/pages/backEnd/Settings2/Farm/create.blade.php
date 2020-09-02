@extends('layouts.backEnd')
@section('page_css')
<style>
    .controls {
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        height: 29px;
        margin-left: 17px;
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        }
    
        .controls:focus {
        border-color: #4d90fe;
        }
        .title {
        font-weight: bold;
        }
        #infowindow-content {
        display: none;
        }
        #map #infowindow-content {
        display: inline;
        }
</style>
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/maps.js"></script>  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWYbhmg32SNq225SO1jRHA2Bj6ukgAQtA&libraries=places&language=en&callback=initMap"></script>
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
<form id="AddFarmForm" method="POST">
    <input type="hidden" name="id" id="id" value="">
  <!--بدايه اصناف المحصول-->

  <div class="top-bar">
    <h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{url('setting/farms')}}">المزارع</a> > /أضافة مزرعة </h6>
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
            <div class="maplarger">
                <input id="pac-input" class="controls" type="text"
                placeholder="Enter a location">
                <div id="map" style="height: 310px;"></div>
                <div id="infowindow-content">
                    <span id="place-name"  class="title"></span><br>
                    Place ID <span id="place-id"></span><br>
                    <span id="place-address"></span>
                </div>
                <input type="hidden" id="location[lat]" name="config[lat]" value="">
                <input type="hidden" id="location[lng]" name="config[lng]" value="">
            </div>
            <div id="infowindow-content">
              <img src="" width="16" height="16" id="place-icon">
              <span id="place-name" class="title"></span>
              <br>
              <span id="place-address"></span>
            </div>
        </td>


      </tr>

    </tbody>
  </table>


  <div class="content p-5">
    <table class="table tableborder">

      <thead>
        <tr>
            <th scope="col">الكود</th>
          <th scope="col">الاسم</th>
          <th scope="col">نوع المحصول</th>
          <th scope="col">المساحة</th>
        </tr>
      </thead>
      <tbody>
        <tr>

          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="number" readonly name="code" value="{{ $code }}" class="form-control numric" min="0">
              <div id="code_demo"></div>
            </div>
          </td>
          <td class="InputNum ">
            <div class="form-group InputGroup">
              <input type="text" name="title" class="form-control numric NameCrop" min="0">
            </div>
            <div id="title_demo"></div>
          </td>

          <td class="InputNum">
            <select class="form-control numric select2 typeCrop"  name="crops[]" multiple="multiple" style="width: 100%;">
              @foreach ($crops as $value)
                 <option value="{{ $value->id }}">{{ $value->title }}</option>
              @endforeach
            </select>
            <div id="crops_demo"></div>
          </td>

          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="config[area]" class="form-control numric elmsa7a" min="0">
            </div>
            <div id="config[area]_demo"></div>
          </td>
        </tr>

      </tbody>
    </table>
    <table class="table tableborder">

      <thead>
        <tr>

          <th scope="col">عدد الفدادين</th>
          <th scope="col">سعر الارض</th>
          <th scope="col">العنوان</th>

        </tr>
      </thead>
      <tbody>
        <tr>

          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="config[fossils_count]" class="form-control numric 3ddelfdan" min="0">
            </div>
            <div id="config[fossils_count]_demo"></div>
          </td>
          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="number" name="price" class="form-control numric" min="0">
            </div>
            <div id="price_demo"></div>
          </td>
          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="config[address]" class="form-control numric" min="0">
            </div>
            <div id="config[address]_demo"></div>
          </td>

        </tr>

      </tbody>
    </table>
    <table class="table tableborder">
      <thead>
        <tr>


          <th scope="col">احداثيات الموقع</th>
        </tr>
      </thead>
      <tbody>
        <tr>


          <td class="InputNum ">
            <div class="form-group InputGroup">
              <input type="text" name="config[north]" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text" name="config[south]" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text" name="config[east]" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text"  name="config[west]" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
            </div>
            <div id="config[north]_demo"></div>
            <div id="config[south]_demo"></div>
            <div id="config[east]_demo"></div>
            <div id="config[west]_demo"></div>
          </td>
        </tr>
      </tbody>
    </table>


    <table class="table tableborder">

      <thead>
        <tr>

          <th scope="col"> الميزانية الشبكية</th>
          <th scope="col"></th>
          <th scope="col">خريطة المساحة/المخطط العام</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>



          <td class="InputNum">

            <div class="button-cont">

              <input type="file" name="net_budget" id="file-3" class="inputfile inputfile2 inputfile-1 " data-multiple-caption="{count} files selected" />
              <label for="file-3">
                <span>تحميل ملف&hellip;</span>
              </label>




            </div>
          </td>

          <td class="InputNum"></td>
          <td class="InputNum">

            <div class="button-cont">

              <input type="file" name="map_area" id="file-4" class="inputfile inputfile2 inputfile-1" data-multiple-caption="{count} files selected" />
              <label for="file-4">
                <span>تحميل ملف&hellip;</span>
              </label>




            </div>
          </td>

          <td class="InputNum"></td>
        </tr>

      </tbody>
    </table>

    </form>
    <button type="button" id="SubmitButton" class="btn save-btn">حفظ</button>

  </div>


  @endsection