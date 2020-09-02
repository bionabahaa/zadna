@extends('layouts.backEnd')
@section('page_css')
<link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/tagify.css">
@endsection
@section('page_script')
<script src="{{ asset('public/styles/backEnd') }}/dist/plugins/Tiny-Text-Field/jQuery.tagify.js"></script>
<script src="{{ asset('public') }}/js/backEnd/crop.js"></script>



@endsection
@section('page_header')
@endsection
@section('page_content')

<h6><a href="{{url('setting/')}}">اعدادات عامه</a> > <a href="{{route('crops.index')}}"> المحصول</a> <a href="{{route('crops.create')}}"> > اضافة</a> </h6>


<form method="post"  action="{{route('crops.store')}}">
{{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">اسم  المحصول</label>
    <input type="text" name="title" class="form-control"  aria-describedby="emailHelp" placeholder="Enter type">
  </div>

  


  <div class="form-group">
    <label >  كود الصنف </label>
    <input type="number" name="type_id" class="form-control"  aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label >  الصنف </label>
    <input type="text" name="notes" class="form-control"  aria-describedby="emailHelp" >

  </div>

  <div class="form-group">
    <label >وصف   الصنف </label>
    <input type="text" name="description" class="form-control"  aria-describedby="emailHelp" >

  </div>
 
  <div class="form-group">
    <label > تاريخ الزراعه </label>
    <input type="date" name="date" class="form-control"  aria-describedby="emailHelp" >

  </div>
  <button type="submit"   class="btn btn-primary">Submit</button>
</form>
@endsection


