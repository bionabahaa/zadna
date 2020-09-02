@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/tagify.css">
@endsection
@section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/jQuery.tagify.js"></script>
<script src="{{ asset('public') }}/js/backEnd/role.js"></script>
<script>
    $(function () {
      $(".select2").select2();
    });
    $('[name=sub]').tagify();
  </script>
  
@endsection
@section('page_header')
@endsection
@section('page_content')

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
     
    <table class="table internal-table mb-5">
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
            ];
        @endphp
        <tbody>
            @foreach ($main_sections as $value)
                <tr>
                    <td colspan="5" style="height: 60px;">
                        <div data-toggle="collapse" data-target="#accordion" class="clickable" style="cursor: pointer;margin-top: 20px;">
                        <i class="fas fa-angle-down arrow"></i><span>{{ $value['title'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" >
                        <div id="accordion" class="collapse" >
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
    
</form>
<button type="button" style="margin-right: 50px;"  class="btn save-btn" id="SubmitButton">حفظ</button>
    </section>
@endsection