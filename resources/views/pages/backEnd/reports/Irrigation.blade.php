@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/report.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('item','App\Models\Irrigation')
 <div class="container crop_body">
    @foreach($info as $info)
         <h1 class="center modelTitle">
                 تقرير عن شبكه الرى
                 <span style="color: red;font-weight: bolder">{{$info->title}}</span>
         </h1>


         {{--points coordinate --}}
         <button class="btn btn-danger" id="point_coordinate" >عرض الاحداثى</button>
         {{--modal point coordinate--}}
         <div class="modal" id="modal_point_coordiante"  tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-body">
                         <table  dir="ltr" class="table table-bordered" >
                             <thead>
                             <tr>
                                 <td colspan="12" style="font-weight: bolder;text-align: center;font-size: 21px">احداثيات  موقع  الارض</td>
                             </tr>
                             </thead>
                             <tbody>
                             <tr>
                                 <td colspan="4" style="font-weight: bolder;text-align: center;font-size: 21px">     احداثيات الخط {{$info->title}}</td>
                                 <th scope="row" rowspan="2" style="font-weight: bolder;text-align: center;font-size: 21px">م</th>

                             </tr>
                             <tr >
                                 <td>د</td>
                                 <td>ق</td>
                                 <td>ث</td>
                                 <td >ش/ق</td>

                             </tr>
                             <tr>
                                 <td>{{$info->point1_north[3]}}</td>
                                 <td>{{$info->point1_north[2]}}</td>
                                 <td>{{$info->point1_north[1]}}</td>
                                 <td>{{$info->point1_north[0]}}</td>
                                 <th scope="row" rowspan="2">{{$info->point1[0]}}</th>
                             </tr>

                             <tr>
                                 <td>{{$info->point1_east[3]}}</td>
                                 <td>{{$info->point1_east[2]}}</td>
                                 <td>{{$info->point1_east[1]}}</td>
                                 <td>{{$info->point1_east[0]}}</td>
                             </tr>
                             <tr>
                                 <td>{{$info->point2_north[3]}}</td>
                                 <td>{{$info->point2_north[2]}}</td>
                                 <td>{{$info->point2_north[1]}}</td>
                                 <td>{{$info->point2_north[0]}}</td>
                                 <th scope="row" rowspan="2">{{$info->point2[0]}}</th>
                             </tr>

                             <tr>
                                 <td>{{$info->point2_east[3]}}</td>
                                 <td>{{$info->point2_east[2]}}</td>
                                 <td>{{$info->point2_east[1]}}</td>
                                 <td>{{$info->point2_east[0]}}</td>
                             </tr>



                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
         {{--end modal point coordinate--}}

    <table class="table">
        <thead>
        <tr>
            <th scope="col">كود الخط</th>
            <th scope="col">نوع الخط </th>
            <th scope="col">الاسم</th>
            <th scope="col">المربعات التى يمر بها</th>
            <th scope="col">كميه المياه</th>
            <th scope="col">الطول</th>
            <th scope="col">التكلفه</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
            <a href="{{route('irrigation.edit',$info->id)}}">
                {{$info->code}}
            </a>
            </td>
            <td>{{$info->line_type}}</td>
            <td>{{$info->title}}</td>
            <td>
                @foreach($info->boxes_in_irrig as $box)
                    <span title=" عمود صف" class="crop_code">
                        <a href="{{url('setting/boxes/'.$box->id.'/edit?operation_page=0')}}"> {{$box->code}}</a>
                    </span>
                @endforeach
            </td>
            <td>{{$info->water_amount}}</td>
            <td>{{$info->lenght}}</td>
            <td>{{$info->cost}}</td>
        </tr>
        </tbody>
    </table>
   <div class="row">
       {{--show all mahbas for irrig--}}
     @if($info->Mahbs_count!=0)
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center">المحابس الموجوده  </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">كود المحبس</th>
                       <th scope="col"> الاحداثى</th>
                       <th scope="col">الوصف</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($info->Mahbs as $mahbas)
                       <tr>
                           <td>{{$mahbas->code}}</td>
                           <td> <button class="btn btn-danger mahbas_point_coordinate" data-id="{{$mahbas->id}}"   >عرض الاحداثى</button></td>
                           <td>{{$mahbas->desc}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif

       <div class="modal modal_mahbas_point_coordiante" tabindex="-1" role="dialog">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-body">
                       <table  dir="ltr" class="table table-bordered" >
                           <thead>
                           <tr>
                               <td colspan="12" style="font-weight: bolder;text-align: center;font-size: 21px">احداثيات  الخط  </td>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td colspan="4" style="font-weight: bolder;text-align: center;font-size: 21px">احداثيات المحبس </td>
                               <th scope="row" rowspan="2" style="font-weight: bolder;text-align: center;font-size: 21px">م</th>
                           </tr>
                           <tr >
                               <td>د</td>
                               <td>ق</td>
                               <td>ث</td>
                               <td >ش/ق</td>

                           </tr>
                           <tr>
                               <td class="pointNorth3"></td>
                               <td class="pointNorth2"></td>
                               <td class="pointNorth1"></td>
                               <td class="pointNorth0"></td>
                               <th scope="row" class="point" rowspan="2"></th>
                           </tr>

                           <tr>
                               <td class="pointEast3"></td>
                               <td class="pointEast2"></td>
                               <td class="pointEast1"></td>
                               <td class="pointEast0"></td>
                           </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>


       {{--show all faults in irrigation--}}
         @if($info->irrigation_faults_count!=0)
             <div class="col-md-5 col-sm-4 irrig_des">
                 <h4 class="center"> الاعطال </h4>
                 <table class="table">
                     <thead>
                     <tr>
                         <th scope="col">الوصف</th>
                         <th scope="col"> التاريخ</th>
                         <th scope="col">الحاله</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($info->irrigation_faults as $fault)
                         <tr>
                             <td>{{$fault->desc}}</td>
                             <td>{{$fault->date}}</td>
                             <td>
                                 @php
                                    switch ($fault->fault_status){
                                        case 1:
                                           echo '<i title="فى الانتظار" class="fas fa-hourglass-half" style="color: yellow"></i>';
                                            break;
                                        case 2:
                                           echo '<i title="رفض" class="fa fa-times" style="color: red"></i>';
                                            break;
                                        case 3:
                                           echo '<i title="قبول" class="fa fa-thumbs-up" ></i>';
                                            break;
                                        default:
                                    }
                                 @endphp
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         @endif
       {{--show all notes for irrigation--}}
       @if($info->irrigation_notes_count!=0)
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center"> الملاحظات على الشبكه   </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">الملاحظه</th>
                       <th scope="col"> القائم بالملاحظه</th>
                       <th scope="col">التاريخ</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($info->irrigation_notes as $note)
                       <tr>
                           <td>{{$note->comment}}</td>
                           <td> {{$user=\DB::table('users')->where('id',$note->from_id)->pluck('username')->first()}}</td>
                           <td>{{$note->datetime}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif

       {{--show all recommendation for irrig--}}
       @if($info->irrigation_recommendations_count!=0)
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center"> التوصيات على الشبكه   </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">التوصيه</th>
                       <th scope="col"> القائم بالتوصيه</th>
                       <th scope="col">التاريخ</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($info->irrigation_recommendations as $recommendation)
                       <tr>
                           <td>{{$recommendation->comment}}</td>
                           <td> {{$user=\DB::table('users')->where('id',$recommendation->from_id)->pluck('username')->first()}}</td>
                           <td>{{$recommendation->datetime}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif
       {{--show all resources for irrig--}}
       {{-- irrigation resource costs --}}
       @if(!empty($info->irrigation_resources_cost))
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center"> بيان التكاليف </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">البيان</th>
                       <th scope="col"> التكلفه متوقعة</th>
                       <th scope="col">التكلفه الفعليه</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($info->irrigation_resources_cost as $cost)
                       <tr>
                           <td>{{$cost->title}}</td>
                           <td>{{$cost->expected_cost}}</td>
                           <td>{{$cost->cost}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif

       {{-- irrigation resource workers --}}
       @if(!empty($info->irrigation_resources_worker))
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center">العماله  </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">نوع العمال</th>
                       <th scope="col"> عدد العمال</th>
                       <th scope="col"> عدد ساعات العمل باليوم</th>
                       <th scope="col"> عدد ايام العمل</th>
                       <th scope="col"> تكلفه العماله</th>
                       <th scope="col">  تاريخ الطلب</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($info->irrigation_resources_worker as $worker)
                       <tr>
                           <td>{{$worker->workers_type_id==1?'مؤقت':'دئم'}}</td>
                           <td>{{$worker->workers_count}}</td>
                           <td>{{$worker->working_number_hours_per_day}}</td>
                           <td>{{$worker->working_number_days}}</td>
                           <td>{{$worker->cost}}</td>
                           <td>{{$worker->datetime}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif

       {{-- irrigation resource equipment --}}
       @if(!empty($info->irrigation_resources_equipment))
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center">المعدات المستخدمه </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">المعده</th>
                       <th scope="col">  عدد ساعات الاستخدام</th>
                       <th scope="col">الكميه</th>
                       <th scope="col">  تاريخ الاستخدام</th>
                   </tr>
                   </thead>
                   <tbody>

                   @foreach($info->irrigation_resources_equipment as $equipment)
                        <?php $items=$item->get_item('equipments',$equipment->equipment_id) ?>
                       <tr>
                           <td>
                              <a style="text-decoration: none" href="{{route('equipments.edit',$items->id)}}"> {{$items->title}}</a>
                           </td>
                           <td>{{$equipment->hours_used}}</td>
                           <td>{{$equipment->qyt}}</td>
                           <td>{{$equipment->datetime}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif
       {{-- irrigation resource materials --}}
       @if(!empty($info->irrigation_resources_material))
           <div class="col-md-5 col-sm-4 irrig_des">
               <h4 class="center">الخامات المستخدمه </h4>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">الخامه</th>
                       <th scope="col">  الكميه</th>
                       <th scope="col">  تاريخ الاستخدام</th>
                   </tr>
                   </thead>
                   <tbody>

                   @foreach($info->irrigation_resources_material as $material)
                       <?php $items=$item->get_item('materials',$material->matrial_id) ?>
                       <tr>
                           <td>
                               <a style="text-decoration: none" href="{{route('material.edit',$items->id)}}"> {{$items->title}}</a>
                           </td>
                           <td>{{$material->qyt}}</td>
                           <td>{{$material->datetime}}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       @endif




  </div>
@endforeach
     <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
 </div>
@endsection

