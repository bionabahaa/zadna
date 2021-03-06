@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/tagify.css">
@endsection
@section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/jQuery.tagify.js"></script>
<script src="{{ asset('public') }}/js/backEnd/user.js"></script>
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
        <div class="content p-5">
                <div class="table-responsive">
                    <form action="POST" id="AddUserForm">
                            <input type="hidden" name="id" id="id" value="">
                        <table class="table tableborder">
                            <thead>
                            <tr>
                                <th scope="col">الاسم</th>
                                <th scope="col">نوع المستخدم</th>
                                <th scope="col">الوظيفة</th>
                                <th scope="col">تاريخ التعين</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="text" name="username"  class="form-control">
                                        </div>
                                    <div id="username_demo"></div>
                                </td>

                                <td class="InputNum">
                                    <select name="user_type" class="form-control user-job">
                                        <option value="">أختر نوع المستخدم</option>
                                            <option value="1"> دائم</option>
                                            <option value="2"> مؤقت</option>
                                    </select>
                                </td>
    
                                <td class="InputNum">
                                    <select name="role_id" class="form-control user-job">
                                    <option value="">أختر وظيفه</option>
                                    @foreach ($Role as $value)
                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                                <div id="role_id_demo"></div>
                            </td>
    
                                <td class="InputNum">
                                <div class="form-group InputGroup">
                                    <input type="date" name="hiring_date" class="form-control numric hire-date" min="0" >
                                </div>
                                <div id="hiring_date_demo"></div>
                            </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table tableborder">
    
                            <thead>
                            <tr>
                                <th scope="col">البريد الالكترونى</th>
                                <th scope="col">كلمة المرور</th>
                                <th></th>
                                <th></th>
    
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
    
                                <td class="InputNum" style="width: 26%"><div class="form-group InputGroup">
                                    <input type="email" name="email" class="form-control numric" min="0">
    
                                </div>
                                <div id="email_demo"></div>
                            </td>
                                <td class="InputNum" style="width: 26%"><div class="form-group InputGroup">
                                    <input type="password" name="password" class="form-control>
    
                                </div>
                                <div id="password_demo"></div>
                            </td>
                                <td></td><td></td>
    
                            </tr>
    
                            </tbody>
                        </table>
                    </form>
                    </div>  </div>
    
                <button type="button" class="btn save-btn" id="SubmitButton">حفظ</button>
    
    
        </div>
    
    
    
    
    </section>
@endsection