@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/tagify.css">
@endsection
@section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/jQuery.tagify.js"></script>
<script src="{{ asset('public') }}/js/backEnd/crop.js"></script>
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
        <h6>اعدادات عامه > اصناف المحصول> اضافة / تعديل صنف</h6>
    </div>
    <div class="content p-5">
        <div class="table-responsive">
            <form id="EditCropsForm" method="POST">
            <input type="hidden" name="id" id="id" value="{{ $info->id }}">
            <table class="table tableborder ">
                <thead>
                    <tr>
                        <th scope="col">نوع المحصول</th>
                        <th scope="col">الاصناف</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="InputNum croptype pl-5 pr-5">
                            <input type="text" class="form-control multi-txt" value="{{ $info->title }}" name="title">
                        </td>
                        <td class="InputNum crops pl-5 pr-5 ">
                            <input type="text" class="form-control multi-txt" value="{{ $info->crops_table }}" name="sub" >
                        </td>
                    </tr>

                </tbody>
            </table>
            </form>
        </div>

        <button type="button" class="btn save-btn" id="SubmitButton">حفظ</button>

    </div>

</section>
@endsection