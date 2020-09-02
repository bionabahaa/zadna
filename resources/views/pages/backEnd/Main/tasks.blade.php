@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<!--بدايه اصناف المحصول-->
<section class="content cropType">
  <div class="top-bar">
    <h6><i class="fas fa-tasks mr-2"></i> المهام</h6>
  </div>
  <div class="Tparent">

    <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
      <div class="col-lg-12">

        <div class="row filter-res">

          <div class="col-lg-2 col-sm-12 col-md-12 col-12">
            <div>
              <label>النوع :</label>
            </div>
            <select class="form-control filter-form filter2 box1" filtercol="1">

              <option>الكل</option>

            </select>
          </div>

          <div class="col-lg-2 col-sm-12 col-md-12 col-12">
            <div>
              <label>الحالة :</label>
            </div>
            <select class="form-control filter-form filter2 box2" filtercol="4">

              <option>الكل</option>
              <option> تم</option>

              <option>لم يتم</option>

            </select>
          </div>

          <div class="col-lg-6 col-sm-12 col-md-12 col-12">
            <div>
              <label> التاريخ :</label>
            </div>
            <input type="date" class="type-date">
          </div>


          <div class="col-lg-2 mt-3 col-sm-4 col-md-4 col-12 search-div">

          </div>

        </div>



      </div>


    </div>



    <div class="row m-3 justify-content-center mt-5 ">
      <div class="col-lg-10 ">

        <table class="table zadnatable">
          <thead>
            <tr>
              <th>النوع </th>
              <th>الوصف</th>
              <th>تاريخ التنفيذ</th>
              <th> الحاله</th>
              <th scope="col" class="actions"> <i class="fas fa-bars"></i> </th>

            </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $value)
              <tr>
                  <td>{{ $value->task_type }}</td>
                  <td>{{ $value->task }}</td>
                  <td>{{ $value->implementation_at }}</td>
                  <td>
                    @if($value->status_id==2)
                    <i class="fas fa-times-circle" style="color: red"></i><span hidden>لم يتم</span>
                    @else
                    <i class="fas fa-check-circle" style="color:greenyellow"></i><span hidden>تم</span>
                    @endif
                    
                   
                  </td>
                  <td class="query-td">
                    <a href="{{ url('missions/tasks/'.$value->id.'/edit?type=1') }}">
                      <i style="color: #212529 !important" class="fas fa-eye view-row" title="View"></i>
                    </a>
                  </td>
                </tr> 
            @endforeach            
          </tbody>

        </table>
      </div>




    </div>


  </div>

</section>
<!--نهايه اصناف المحصول-->
<!-- basic Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modalbg">
      <div class="modal-header modal-border">
        <h5 class="modal-title" id="exampleModalLongTitle">اضافة </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-space modallbdy">
        <div class="table-responsive">

          <table class="table tableborder">

            <thead>
              <tr>

                <th scope="col">الكود</th>
                <th scope="col">النوع</th>

              </tr>
            </thead>
            <tbody>
              <tr>

                <td class="InputNum">
                  <div class="form-group InputGroup">
                    <input type="number" class="form-control numric" min="0" style="width: 50%" disabled>

                  </div>
                </td>
                <td class="InputNum">
                  <div id="accordion" style="width: 50%">
                    <div class="card">
                      <div class="card-header cardPadding" id="headingOne">

                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-angle-down arrow"></i>
                          </button><label class="selected-value type"></label>
                        </h5>
                      </div>

                      <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body cb0dy">
                          <ul id="myUL" class="itemGroup ">
                            <li> <a href="#" data-toggle="modal" data-target="#exampleModalLong2">اضافة نوع +</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                </td>


              </tr>

            </tbody>
          </table>
          <table class="table tableborder">

            <thead>
              <tr>

                <th scope="col">تاريخ الظهور</th>
                <th scope="col">اسم المعدة</th>

              </tr>
            </thead>
            <tbody>
              <tr>

                <td class="InputNum">
                  <div class="form-group InputGroup">
                    <input type="date" class="form-control numric date" min="0" style="width: 50%">

                  </div>
                </td>
                <td class="InputNum">
                  <div class="form-group InputGroup">
                    <input type="text" class="form-control numric equipmentName" min="0" style="width: 50%">

                  </div>
                </td>


              </tr>

            </tbody>
          </table>

          <table class="table tableborder">

            <thead>
              <tr>


                <th scope="col">الوصف</th>

              </tr>
            </thead>
            <tbody>
              <tr>


                <td class="InputNum">
                  <div class="form-group InputGroup">
                    <textarea style="width: 50%; min-height: 155px;
  max-height: 155px;" class="numric"></textarea>

                  </div>
                </td>


              </tr>

            </tbody>
          </table>



        </div>
      </div>
      <div class="modal-footer footer-border">
        <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
        <button type="button" class="btn save-btn" id="saveMatrial">حفظ</button>
      </div>
    </div>
  </div>
</div>

<!-- model for add type -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modalbg-add">
      <div class="modal-header header-border">
        <h5 class="modal-title" id="exampleModalLongTitle">اضافة نوع</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div class="form-group center">

          <input type="text" id="name-text" class="textStyle name-text">
        </div>

      </div>
      <div class="modal-footer footer-border">

        <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="addgroup">اضافة</button>
      </div>
    </div>
  </div>
</div>


<!-- model for add mesure type -->
<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modalbg-add">
      <div class="modal-header header-border">
        <h5 class="modal-title" id="exampleModalLongTitle">اضافة وحدة قياس</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div class="form-group center">

          <input type="text" id="name-text2" class="textStyle ">
        </div>

      </div>
      <div class="modal-footer footer-border">

        <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="addgroup2">اضافة</button>
      </div>
    </div>
  </div>
</div>
@endsection
