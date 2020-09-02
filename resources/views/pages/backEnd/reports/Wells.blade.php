@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/report.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
 <div class="container crop_body">
    @foreach($info as $info)
             <h1 class="center modelTitle"> تقرير عن البير<span style="color: red;font-weight: bolder"> {{$info->title}}</span></h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">كود البير</th>
                    <th scope="col">الاسم </th>
                    <th scope="col">تاريخ الحفر</th>
                    <th scope="col">العمق </th>
                    <th scope="col">قطر البئر </th>
                    <th scope="col">التكلفه </th>
                    <th scope="col">الاحد الادنى لكمية المياة </th>
                    <th scope="col">الملف الجيولوجى </th>
                    <th scope="col">الملاحظات </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                      <a title="عرض مواصفات البير" href="{{url('setting/wells/'.$info->id.'/edit?operation_page=1')}}"> {{$info->code}}</a>
                    </td>
                    <td>{{$info->title}}</td>
                    <td>{{$info->date_of_excavation}}</td>
                    <td>{{$info->depth}} متر </td>
                    <td> {{$info->well_radius}}  متر </td>
                    <td>{{$info->cost}}</td>
                    <td>{{$info->minimum_water_quantity}}  لتر  </td>
                    <td>
                        @if(!empty($info->geological_profile_file))
                        <a target="_blank" href="{{asset('public\images\Uploads\well\\'.str_replace(' ','',$info->geological_profile_file))}}">{{$info->geological_profile_file}}</a>
                        @else
                            <span>لا يوجد</span>
                       @endif
                    </td>
                    <td>{{$info->note}}</td>
                </tr>
                </tbody>
            </table>

         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center">الصيانه</th>
                 <th scope="col" class="box_resource_title" class="center"> المواسير</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--mainentance--}}
                     <table>
                         <td>
                             {{--show all mainentance in well--}}
                             @if($info->well_mainentance_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">   وصف الصيانه</th>
                                             <th scope="col">تاريخ  الصيانه</th>
                                             <th scope="col"> التكرار</th>
                                             <th scope="col"> لمده</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_mainentance as $mainentance)
                                             <tr>
                                                 <td>{{$mainentance->title}}</td>
                                                 <td>{{date('Y-m-d',strtotime($mainentance->datetime) )}}</td>
                                                 <td>
                                                     {{$mainentance->test_num}}
                                                     @switch($mainentance->test_duration)
                                                        @case (1)
                                                            يوم
                                                        @break
                                                         @case (2)
                                                         اسبوع
                                                         @break
                                                         @case (3)
                                                         شهر
                                                         @break
                                                         @case (4)
                                                         سنه
                                                         @break
                                                     @endswitch
                                                 </td>
                                                 <td>{{$mainentance->extension}} سنه </td>

                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى صيانه حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--pipes--}}
                     <table>
                         <td>
                             {{--show all pipe in well--}}
                             @if($info->well_pipe_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> الكود</th>
                                             <th scope="col">   القطر</th>
                                             <th scope="col">  الطول</th>
                                             <th scope="col"> الوصف</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_pipe as $pipe)
                                             <tr>
                                                 <td>{{$pipe->code}} </td>
                                                 <td>{{$pipe->diameter}} متر</td>
                                                 <td>{{$pipe->length}}متر</td>
                                                 <td>{{$pipe->desc}} </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى مواسير حتى الان</h5>
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
                 <th scope="col" class="box_resource_title" class="center">الغلاف الخارجى للمواسير</th>
                 <th scope="col" class="box_resource_title" class="center"> المولد</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--external pipe--}}
                     <table>
                         <td>
                             {{--show all mainentance in well--}}
                             @if($info->well_external_pipe_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">الكود</th>
                                             <th scope="col">القطر</th>
                                             <th scope="col"> الطول</th>
                                             <th scope="col"> الوصف</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_external_pipe as $external_pipe)
                                             <tr>
                                                 <td>{{$external_pipe->code}}</td>
                                                 <td>{{$external_pipe->diameter}}متر</td>
                                                 <td>{{$external_pipe->length}}متر</td>
                                                 <td>{{$external_pipe->desc}} </td>

                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى الغلاف الخارجى للمواسي حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--generator--}}
                     <table>
                         <td>
                             @if($info->well_generator_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">القدره</th>
                                             <th scope="col"> الوصف</th>
                                             <th scope="col"> عرض الصيانه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_generator as $generator)
                                             <tr>
                                                 <td>{{$generator->ability }} وات</td>
                                                 <td>{{$generator->desc}}</td>
                                                 <td><i class="fa fa-eye generator_mainentance" data-id="{{$generator->id}}"></i></td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى مولد حتى الان</h5>
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
                 <th scope="col" class="box_resource_title" class="center">الطرمبة</th>
                 <th scope="col" class="box_resource_title" class="center"> الاعطال</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--tramp--}}
                     <table>
                         <td>
                             {{--show all mainentance in well--}}
                             @if($info->well_tramp_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> كود الطرمبه</th>
                                             <th scope="col">  القدره</th>
                                             <th scope="col"> الوصف</th>
                                             <th scope="col"> عرض الصيانه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_tramp as $tramp)
                                             <tr>
                                                 <td>{{$tramp->code}}</td>
                                                 <td>{{$tramp->ability }}  وات </td>
                                                 <td>{{$tramp->desc}}</td>
                                                 <td><i class="fa fa-eye generator_mainentance" data-id="{{$tramp->id}}"></i></td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى الطرمبه حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--pipes--}}
                     <table>
                         <td>
                             {{--show all pipe in well--}}
                             @if($info->well_fault_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> كود العطل </th>
                                             <th scope="col">   مكان العطل</th>
                                             <th scope="col">  تاريخ الظهور</th>
                                             <th scope="col"> الوصف</th>
                                             <th scope="col"> الحاله</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->well_faults as $fault)
                                             <tr>
                                                 <td>{{$fault->fault_code}} </td>
                                                 <td>
                                                     @switch($fault->type)
                                                         @case (1)
                                                             بير
                                                         @break
                                                         @case (2)
                                                             معده
                                                         @break
                                                         @case (3)
                                                                شبكه رى
                                                         @break
                                                     @endswitch

                                                 </td>
                                                 <td>{{$fault->date}}</td>
                                                 <td>{{$fault->desc}} </td>
                                                 <td>
                                                     @switch($fault->fault_status)
                                                         @case (1)
                                                             <i title="انتظار" class="fas fa-hourglass-half" style="color: yellow"></i>
                                                         @break
                                                         @case (2)
                                                              <i title="قبول" class="fa fa-thumbs-up"></i>
                                                         @break
                                                         @case (3)
                                                              <i title="رفض" class="fa fa-times" style="color: red"></i>
                                                         @break
                                                     @endswitch

                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى عطل حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>

             </tr>
             </tbody>
         </table>



{{--start modal popup for generator mainentance--}}
         <div class="modal" id="generatorMainentance_modal" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-lg" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">الصيانه</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body generator_mainentance_body">

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                 </div>
             </div>
         </div>
 {{--end modal popup for generator mainentance--}}

    @endforeach
    <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
  </div>
@endsection

