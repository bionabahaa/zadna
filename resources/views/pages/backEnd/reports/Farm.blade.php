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
         <h1 class="center modelTitle"> تقرير عن المزرعه<span style="color: red;font-weight: bolder"> {{$info->title}}</span></h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">الاسم</th>
            <th scope="col">تاريخ الانشاء</th>
            <th scope="col"> الموقع</th>
            <th scope="col"> المساحه </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
               <a href="{{url('/setting/farm/'.$info->id.'/edit')}}">{{$info->title}}</a>
            </td>
            <td>{{$info->creation_date}}</td>
            <td>{{$info->location}}</td>
            <td>{{$info->area}} فدان </td>

        </tr>
        </tbody>
    </table>

     <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center">  المربعات داخل المزرعه</th>
                 <th scope="col" class="box_resource_title" class="center">المحاصيل</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--boxes--}}
                     <table>
                         <td>
                             @if($info->boxe_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> كود المربع</th>
                                             <th scope="col">الصف</th>
                                             <th scope="col"> العمود</th>
                                             <th scope="col">  المساحه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->boxes as $box)
                                             <tr>
                                                 <td><a href="{{url('setting/boxes/'.$box->id.'/edit?operation_page=0')}}"> {{$box->code}}</a></td>
                                                 <td>{{$box->row}} </td>
                                                 <td>{{$box->column}} </td>
                                                 <td>{{$box->size}} </td>

                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى مربع حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--crops--}}
                     <table>
                         <td>
                             @if($info->crop_count!=0 )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">كود المحصول </th>
                                             <th scope="col"> نوع المحصول</th>
                                             <th scope="col">تاريخ الاضافه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->crops as $crop)
                                             <tr>
                                                 <td title=" كود الصنف _ العمود _ الصف _ كود مربع">
                                                     <a href="{{url('setting/crops/'.$crop->id.'/edit')}}"> {{$crop->code}}</a>
                                                 </td>
                                                 <td>{{$crop->title }}</td>
                                                 <td>{{$crop->date}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد محصول  حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>

     <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center">  الاصناف داخل المزرعه</th>
                 <th scope="col" class="box_resource_title" class="center">الاعطال</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--crops--}}
                     <table>
                         <td>
                             @if($info->crops_in_type_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> كود الصنف</th>
                                             <th scope="col">الصنف</th>
                                             <th scope="col"> الكميه</th>
                                             <th scope="col">  الوصف</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->crops_in_type as $crops_in_type)
                                             <tr>
                                                 <td><a href="{{url('/setting/crops/'.$crops_in_type->id.'/edit')}}"> {{$crops_in_type->code}}</a></td>
                                                 <td>{{$crops_in_type->title}} </td>
                                                 <td>{{$crops_in_type->qyt}} </td>
                                                 <td>{{$crops_in_type->notes}} </td>

                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى صنف حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--faults--}}
                     <table>
                         <td>
                             @if($info->faults_count!=0 )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">كود العطل </th>
                                             <th scope="col"> نوع العطل</th>
                                             <th scope="col">تاريخ الظهور</th>
                                             <th scope="col"> حاله العطل</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->faults as $fault)
                                             <tr>
                                                 <td title="كود العطل">
                                                    {{$fault->fault_code}}
                                                 </td>
                                                 <td>
                                                     @switch($fault->type)
                                                         @case(1)
                                                         <span> بير</span>
                                                         @break

                                                         @case(2)
                                                         <span>معده</span>
                                                         @break

                                                         @default
                                                         <span>شبكه رى</span>
                                                     @endswitch

                                                 </td>
                                                 <td>{{$fault->date}}</td>
                                                 <td>
                                                     @switch($fault->fault_status)
                                                         @case(1)
                                                         <i class="fas fa-hourglass-half" style="color: yellow"></i>
                                                         @break

                                                         @case(2)
                                                         <i class="fa fa-times" style="color: red"></i>
                                                         @break

                                                         @default
                                                         <i class="fa fa-thumbs-up"></i>
                                                     @endswitch
                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد عطل  حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>



@endforeach
     <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
 </div>
@endsection

