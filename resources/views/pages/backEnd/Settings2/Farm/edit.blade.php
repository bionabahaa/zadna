@extends('layouts.backEnd')
@section('page_css')
<style>
    {{--  .controls {
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
        }  --}}
</style>
@endsection
@section('page_script')
{{--  <script src="{{ asset('public') }}/js/maps.js"></script>  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWYbhmg32SNq225SO1jRHA2Bj6ukgAQtA&libraries=places&language=en&callback=initMap"></script>  --}}
<script src="{{ asset('public') }}/js/backEnd/farm.js"></script>
<script>
    $('#rowTestButton').click(function() {
      $('#TestFarmModel').modal('show')
    });
    $('#rowAgricultureButton').click(function() {
      $('#AgricultureFarmModel').modal('show')
    });
</script>
<script>
  $(function () {
    $(".select2").select2();
  });
</script>

@endsection
@section('page_header')
@endsection
@section('page_content')
<form id="EditFarmForm" method="POST">
    <input type="hidden" name="id" id="id" value="{{ @$info->id }}">
  <!--بدايه اصناف المحصول-->

  <div class="top-bar">
    <h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{url('setting/farms')}}">المزارع</a> > /أضافة مزرعة </h6>
  </div>
  {{--  <table class="table tableborder " style="    width: 90%;
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
                <input type="hidden" id="location[lat]" name="config[lat]" value="{{ @$info->lat }}">
                <input type="hidden" id="location[lng]" name="config[lng]" value="{{ @$info->lng }}">
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
  </table>  --}}


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
              <input type="number" readonly name="code" value="{{ @$info->code }}" class="form-control numric" min="0">
            </div>
            <div id="code_demo"></div>
          </td>
          <td class="InputNum ">
            <div class="form-group InputGroup">
              <input type="text" name="title" value="{{ @$info->title }}" class="form-control numric NameCrop" min="0">
            </div>
            <div id="title_demo"></div>
          </td>

          <td class="InputNum">
            <select class="form-control numric select2 typeCrop"  name="crops[]" multiple="multiple" style="width: 100%;">
              @foreach ($crops as $value)
                  @if(in_array($value->id,$info->Crops_id))
                  <option value="{{ $value->id }}" selected>{{ $value->title }}</option>
                  @else
                  <option value="{{ $value->id }}">{{ $value->title }}</option>
                  @endif
              @endforeach
            </select>
            <div id="crops_demo"></div>
          </td>

          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="config[area]" value="{{ @$info->area }}" class="form-control numric elmsa7a" min="0">
            </div>
          </td>
        </tr>

      </tbody>
    </table>
    <table class="table tableborder" >
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
              <input type="text" name="config[fossils_count]" value="{{ @$info->fossils_count }}" class="form-control numric 3ddelfdan" min="0">

            </div>
          </td>
          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="number" name="price" value="{{ @$info->price }}" class="form-control numric" min="0">
            </div>
            <div id="price_demo"></div>
          </td>
          <td class="InputNum">
            <div class="form-group InputGroup">
              <input type="text" name="config[address]" value="{{ @$info->address }}" class="form-control numric" min="0">
            </div>
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
              <input type="text" name="config[north]" value="{{ @$info->north }}" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text" name="config[south]" value="{{ @$info->south }}" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text" name="config[east]" value="{{ @$info->east }}" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
              <input type="text"  name="config[west]" value="{{ @$info->west }}" placeholder="x,y" class="form-control numric axisloc add-modal-loc" min="0">
            </div>
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
          <td class="InputNum">
            <a href="{{ @$info->net_budget }}" target="_blank">الملف</a>
          </td>
          <td class="InputNum">
            <div class="button-cont">
              <input type="file" name="map_area" id="file-4" class="inputfile inputfile2 inputfile-1" data-multiple-caption="{count} files selected" />
              <label for="file-4">
                <span>تحميل ملف&hellip;</span>
              </label>
            </div>
          </td>
          <td class="InputNum">
            <a href="{{ @$info->map_area }}" target="_blank">الملف</a>
          </td>
        </tr>
      </tbody>
    </table>
    </form>


    <table class="table tableborder">
      <thead>
        <tr>
          <th scope="col"> اختبارات الارض </th>
        </tr>
      </thead>
      <tbody>

        <table class="table table-bordered" id="TestFarmDataTable">
          <thead>
            <tr>
              <th>الكود</th>
              <th>رقم الاختبار</th>
              <th>الملف</th>
              <th>تاريخ الاختبار</th>
              <th>
                <button class="add-crepto2" id="rowTestButton" type="button">اضافة</button>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($info->FarmTest as $value)
              <tr>
                <td>{{ $value->code }}</td>
                <td>{{ $value->test_num }}</td>
                <td><a target="_blank" href="{{ url('public//images/Uploads/farms/') . '/' . $value->file }}">الملف</a></td>
                <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                <td>
                    <button class="delete_test" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </tbody>
    </table>
    <table class="table tableborder">
      @php
      $farm_types=[
        1=>'توقيع الابار',
        2=>'توقيع المربعات',
        3=>'توقيع شبكة الرى',
        4=>'شكل المزرعة',
      ];
      @endphp
      <thead>
        <tr>
            <th scope="col"> مخطط الزراعة</th>
        </tr>
      </thead>
      <tbody>
        <table class="table table-bordered" id="AgricultureFarmDataTable" >
          <thead>
            <tr>
              <th>الكود</th>
              <th> نوع المخطط</th>
              <th>الملف</th>
              <th>تاريخ الملف</th>
              <th>
                <button class="add-crepto2" id="rowAgricultureButton" type="button">اضافة</button>
              </th>
            </tr>
          </thead>
          <tbody>
              @foreach ($info->PlanOfAgriculture as $value)
              <tr>
                <td>{{ $value->code }}</td>
                <td>{{ $farm_types[$value->type] }}</td>
                <td><a target="_blank" href="{{ url('public//images/Uploads/farms/') . '/' . $value->file }}">الملف</a></td>
                <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                <td>
                    <button class="delete_agriculture" type="button"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                </td>
              </tr>
            @endforeach


          </tbody>
        </table>
      </tbody>
    </table>

    <button type="button" class="btn save-btn" id="SubmitButton">حفظ</button>

  </div>



  <div id="TestFarmModel" class="modal fade " role="dialog" currtable>
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content modalbg-add">
              <div class="modal-header d-flex flex-row-reverse">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h5 class="modal-title text-center ">اضافه</h5>
              </div>
              <div class="modal-body">
                <form action="POST" id="AddFarmTest">
                    <input type="hidden" name="farm_id" value="{{ $info->id }}" class="form-control " min="0">
                  <div class="row mb-4">
                      <div class="col-12">
                          <label class="col-4" for="descrep">رقم الاختبار:</label>
                          <input type="number" name="test_num" class="form-control " min="0">
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-12">
                          <input type="file" name="test_file" id="file-11" class="inputfile inputfile2 inputfile-1 "/>
                        <label for="file-11">
                          <span>تحميل ملف&hellip;</span>
                        </label>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-12">
                          <label class="col-4" for="date">التاريخ:</label>
                          <input type="date" name="datetime" id="date" class="col-val border-style col-6 ">
                      </div>
                  </div>
                
                  <br>
                </form>
              </div>
              <div class="modal-footer">
                  <button id="saveDateTest" class="danger btn btn-primary btnSave">حفظ</button>
                  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
              </div>
          </div>

      </div>
  </div>

  <div id="AgricultureFarmModel" class="modal fade " role="dialog" currtable>
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content modalbg-add">
              <div class="modal-header d-flex flex-row-reverse">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h5 class="modal-title text-center ">اضافه</h5>
              </div>
              <div class="modal-body">
                  <form action="POST" id="AddFarmAgriculture">
                      <input type="hidden" name="farm_id" value="{{ $info->id }}" class="form-control " min="0">
                      <div class="row mb-4">
                          <div class="col-12">
                              <label class="col-4" for="descrep">نوع الاختبار:</label>
                              <select class="form-control numric " name="type">
                                  @foreach ($farm_types as $key=>$value)
                                  <option value="{{ $key }}">{{ $value }}</option>
                                  @endforeach
                                </select>
                          </div>
                      </div>
                      <div class="row mb-4">
                          <div class="col-12">
                              <input type="file" id="file-11" name="file_agriculture" class="inputfile inputfile2 inputfile-1 " />
                            <label for="file-11">
                              <span>تحميل ملف&hellip;</span>
                            </label>
                          </div>
                      </div>
                      <div class="row mb-4">
                          <div class="col-12">
                              <label class="col-4" for="date">التاريخ:</label>
                              <input type="date" name="datetime" id="date" class="col-val border-style col-6 ">
                          </div>
                      </div>
                    
                      <br>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" id="saveDateAgriculture" class="danger btn btn-primary btnSave">حفظ</button>
                  <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
              </div>
          </div>

      </div>
  </div>


@endsection