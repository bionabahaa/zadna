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
     <h1 class="center modelTitle">    تقرير عن الخامه <span style="color: red;font-weight: bolder">{{$info->title}}</span></h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">كود الخامه</th>
            <th scope="col">نوع الخامه</th>
            <th scope="col">اسم الخامه</th>
            <th scope="col">السعر</th>
            <th scope="col"> الكميه</th>
            <th scope="col"> وحده القياس</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <a href="{{route('material.edit',$info->id)}}">
                    {{$info->code}}
                </a>
            </td>
            <td>{{$info->material_type}}</td>
            <td>{{$info->title}}</td>
            <td>{{$info->cost}}</td>
            <td>{{$info->qyt}}</td>
            <td>{{$info->material_unit}}</td>
        </tr>

        </tbody>
    </table>
@endforeach
     <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
 </div>
@endsection

