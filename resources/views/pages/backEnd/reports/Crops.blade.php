@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
@endsection
@section('page_header')
@endsection
@section('page_content')
 <div class="container crop_body">
    @foreach($info as $info)
         <h1 class="center modelTitle"> تقرير عن محصول<span style="color: red;font-weight: bolder"> {{$info->title}}</span></h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">كود المحصول</th>
            <th scope="col">اسم المحصول</th>
            <th scope="col">تاريخ الاضافه</th>
            <th scope="col">عدد الاصناف</th>
            <th scope="col">كود الاصناف والكميه</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$info->code}}</td>
            <td>{{$info->title}}</td>
            <td>{{$info->date}}</td>
            <td>{{count($info->all_crops_in_type)}}</td>
            <td>
                @foreach($info->all_crops as $crop)
                <a style="text-decoration: none;" href="{{url('setting/crops/'.$crop->id.'/edit')}}">
                    <span class="crop_code" title="{{$crop->title}}">{{$crop->code}}</span>
                    <span>  => {{$crop->qyt}}</span>
                </a>
                @endforeach
            </td>
        </tr>

        </tbody>
    </table>
@endforeach
     <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
 </div>
@endsection

