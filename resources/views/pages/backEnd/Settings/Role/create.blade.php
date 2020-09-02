@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/tagify.css">
<style>

    .user-form label{
    border-bottom: 1px solid;
    border-bottom-color: #58b82a !important;
    width: 100%;
}
    .col-title{
    border-bottom: 1px solid;
    border-bottom-color: #58b82a !important;
    width: 50%;
    padding-bottom: 2%;
}

.prev-type{
    border-bottom: 1px solid gray;
    padding-bottom: 1%;
margin-bottom: 3%;
}
</style>
@endsection
@section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/jQuery.tagify.js"></script>
<script src="{{ asset('public') }}/js/backEnd/role.js"></script>
<script>
    $(function () {
      $(".select2").select2();
    });
    $('[name=sub]').tagify();


    var checkedAll=function (id){

        if(document.getElementById('CheckAll'+id).checked==true){
            $('.check'+id).each(function () {
                $(this).prop("checked", true);
            });
        }else{
            $('.check'+id).each(function () {
                $(this).prop("checked", false);
            });
        }
    }
  </script>
  
@endsection
@section('page_header')
@endsection
@section('page_content')

<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > المستخدمين</h6>
    </div>

    <form action="POST" id="AddRoleForm">
        <input type="hidden" name="id" id="id" value="">
    <table class="table tableborder m-auto"  style="width: 95%">
      <thead>
        <tr>
          <th scope="col">الكود</th>
          <th scope="col">الاسم</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="InputNum" ><div class="form-group InputGroup">
              <input type="number" value="{{ $code }}" name="code" readonly class="form-control numric" min="0">
              </div>
              <div id="code_demo"></div></td>
              <td class="InputNum">
                  <div class="form-group InputGroup">
              <input type="text" name="title" class="form-control numric" min="0">
              </div>
              <div id="title_demo"></div>
            </td>
        </tr>
      </tbody>
    </table>
    <div class="table-bar mt-4 mb-4" >
        <h6>الصلاحيات</h6>  <hr>
    </div>
     @foreach ($Main_Moduels as $value)
     <div class="row m-auto  pb-5">
        <div class="col-lg-12 col-sm-12 col-12 ">
            <div class="col-12 prev-type collapsed" style=" margin-top: 2% ;cursor: pointer" data-toggle="collapse"
                href="#collapseExample{{ $value['type'] }}" aria-expanded="false">
                <a class="fas fa-caret-left " style="color:green"></a>
                <span > {{ $value['title'] }} </span>
            </div>
            <div class="collapse table-responsive" id="collapseExample{{ $value['type'] }}" style="padding-bottom: 5rem;">
                    <div class="row m-auto pb-5">
                        <div class="col-2">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input"  onclick="checkedAll({{ $value['type'] }})" id="CheckAll{{ $value['type'] }}">
                                <label class="form-check-label"  for="exampleCheck1">الكل</label>
                            </div>
                        </div>
            @foreach ($Moduels as $key=>$value2)
                @if($value2['type']==$value['type'])
                    <div class="col-3">
                        <h6 class="col-title">{{ $value2['title'] }}</h6>
                        @foreach ($value2['permissions'] as $key2=>$value3)
                            <div class="form-group form-check">
                                <input name="permission[]" type="checkbox" value="{{$key}},{{$key2}}" class="form-check-input check{{$value['type']}}" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">{{ $value3 }}</label>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>

        </div>
    </div>
     @endforeach
     
    {{-- <div class="row m-auto  pb-5">
        <div class="col-lg-12 col-sm-12 col-12 ">
            <div class="col-12 collapsed prev-type" style=" margin-top: 2% ;cursor: pointer" data-toggle="collapse"
                href="#collapseExample4" aria-expanded="false">
                <a class="fas fa-caret-left " style="color:green"></a>
                <span > الاعدادات العامة </span>

            </div>
            <div class="collapse table-responsive show" id="collapseExample4" style="padding-bottom: 5rem;">
               
                <div class="row m-auto pb-5">
                    <div class="col-3  offset-2">
                        <h6 class="col-title">العنوان</h6>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <h6 class="col-title">العنوان</h6>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>

                    <div class="col-3">
                        <h6 class="col-title">العنوان</h6>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     --}}
</form>
<button type="button" style="margin-right: 50px;"  class="btn save-btn" id="SubmitButton">حفظ</button>
    </section>
@endsection