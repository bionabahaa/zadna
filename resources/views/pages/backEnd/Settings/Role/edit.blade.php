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
    @inject('healper', 'App\Http\Controllers\BladeController')
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه > المستخدمين</h6>
    </div>
            <div class="second-bar mt-4 p-4" >
        <h6>إضافة مستخدم</h6>  <hr>
    </div>
    <form action="POST" id="EditRoleForm">
        <input type="hidden" name="id" id="id" value="{{ $info->id }}">
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
              <input type="number" value="{{ $info->code }}" name="code" readonly class="form-control numric" min="0">
              </div>
              <div id="code_demo"></div></td>
              <td class="InputNum">
                  <div class="form-group InputGroup">
              <input type="text" name="title" value="{{ $info->title }}" class="form-control numric" min="0">
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
                           @php $checked=''; @endphp
                            @foreach ($Check_Permissions as $value4)
                               @php $checked=''; @endphp
                                @if(($key==$value4['moduel_id'])&&($key2==$value4['permission_id']))
                                @php $checked='checked'; @endphp
                                @break;
                                @endif
                            @endforeach
                           <div class="form-group form-check">
                               <input name="permission[]" {{ $checked }}  type="checkbox" value="{{$key}},{{$key2}}" class="form-check-input check{{$value['type']}}" id="exampleCheck1">
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


    {{-- <table class="table internal-table mb-5">
        <thead>
            <th><span>الاسم</span></th>
            @foreach ($Permissions as $permission_value)
            <th><span>{{ $permission_value->title }}</span></th>
            @endforeach
        </thead>
        @php
        $main_sections=[
            array(
                'title'=>'الاعدادات العامه',
                'start'=>1,
                'end'=>9,
            ),
            array(
                'title'=>'العمليات الزراعيه',
                'start'=>13,
                'end'=>24,
            ),
            array(
                'title'=>'طاقم العمل',
                'start'=>25,
                'end'=>26,
            ),
            array(
                'title'=>'المخزن',
                'start'=>27,
                'end'=>28,
            ),
            array(
                'title'=>'التجارب',
                'start'=>29,
                'end'=>29,
            ),
            array(
                'title'=>'الاعطال',
                'start'=>30,
                'end'=>30,
            ),
            array(
                'title'=>'تعين مهمه',
                'start'=>31,
                'end'=>31,
            ),
            array(
                'title'=>'تكاليف',
                'start'=>32,
                'end'=>33,
            ),
            array(
                'title'=>'مواسم',
                'start'=>34,
                'end'=>36,
            ),
            array(
                'title'=>'الامراض',
                'start'=>37,
                'end'=>40,
            ),
        ];
    @endphp
        <tbody>
            @foreach ($main_sections as $value)
                <tr>
                    <td colspan="5" style="height: 60px;">
                        <div data-toggle="collapse" data-target="#accordion{{ $value['title'] }}" class="clickable" style="cursor: pointer;margin-top: 20px;">
                        <i class="fas fa-angle-down arrow"></i><span>{{ $value['title'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" >
                        <div id="accordion{{ $value['title'] }}" class="collapse" >
                        <table style="width: 100%;">
                            @for($i=$value['start'];$i<= $value['end'] ;$i++)
                                <tr>
                                    <td class="tdone"><span>{{ $Moduels[$i] }}</span></td>
                                    @foreach ($Permissions as $permission_value)
                                     <td class="">
                                        @php $checked=''; @endphp
                                         @foreach ($Check_Permissions as $Check_Permissions_value)
                                             @if($Check_Permissions_value['moduel_id']==$i && $Check_Permissions_value['permission_id']==$permission_value->id)
                                                @php
                                                $checked='checked';
                                                break;
                                                 @endphp
                                             @else
                                                @php $checked=''; @endphp
                                             @endif
                                         @endforeach
                                         <input type="checkbox" name="permission[{{ $i }}][{{ $permission_value->id }}]" class="2" {{ $checked }} >
                                     </td>
                                    @endforeach
                                </tr>
                            @endfor
                        </table>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     --}}
</form>

    {{--@if($healper->check_permission(11,2))--}}
        <button type="button" style="margin-right: 50px;"  class="btn save-btn" id="SubmitButton">حفظ</button>
    {{--@endif--}}
    </section>
@endsection