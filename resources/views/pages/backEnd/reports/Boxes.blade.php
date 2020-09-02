@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/report.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('model','App\Models\Boxes')
 <div class="container crop_body">


        @foreach($info as $info)
             <h1 class="center modelTitle"> تقرير عن المربع<span title="عمود صف" style="color: red;font-weight: bolder"> {{$info->code}}</span></h1>
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
                                 <td colspan="4" style="font-weight: bolder;text-align: center;font-size: 21px">  {{$info->code}}  احداثيات المربع </td>
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
                             <tr>
                                 <td>{{$info->point3_north[3]}}</td>
                                 <td>{{$info->point3_north[2]}}</td>
                                 <td>{{$info->point3_north[1]}}</td>
                                 <td>{{$info->point3_north[0]}}</td>
                                 <th scope="row" rowspan="2">{{$info->point3[0]}}</th>
                             </tr>

                             <tr>
                                 <td>{{$info->point3_east[3]}}</td>
                                 <td>{{$info->point3_east[2]}}</td>
                                 <td>{{$info->point3_east[1]}}</td>
                                 <td>{{$info->point3_east[0]}}</td>
                             </tr>
                             <tr>
                                 <td>{{$info->point4_north[3]}}</td>
                                 <td>{{$info->point4_north[2]}}</td>
                                 <td>{{$info->point4_north[1]}}</td>
                                 <td>{{$info->point4_north[0]}}</td>
                                 <th scope="row" rowspan="2">{{$info->point4[0]}}</th>
                             </tr>

                             <tr>
                                 <td>{{$info->point4_east[3]}}</td>
                                 <td>{{$info->point4_east[2]}}</td>
                                 <td>{{$info->point4_east[1]}}</td>
                                 <td>{{$info->point4_east[0]}}</td>
                             </tr>

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     {{--end modal point coordinate--}}



         {{--show box report details--}}
        <table class="table tdes">
            <thead>
            <tr>
                <th scope="col">كود المربع</th>
                <th scope="col">عدد الصفوف</th>
                <th scope="col">عدد الاعمده</th>
                <th scope="col"> المحصول</th>
                <th scope="col"> عدد الاصناف</th>
                <th scope="col"> الاصناف</th>
                <th scope="col"> العمال المسئولين</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <a href="{{url('setting/boxes/'.$info->id.'/edit?operation_page=0')}}">{{$info->code}}</a>
                </td>
                <td>{{$info->row_count}}</td>
                <td>{{$info->column_count}}</td>
                <td>{{$info->type_crop_in_box['title']}}</td>
                <td>{{count($info->crop_title)}}</td>
                <td>{{$info->crops_in_box}}</td>
                <td>{{$info->one}}</td>
                <td>{{$info->two}}</td>
                <td>
                    @foreach($info->user_in_box as $user)
                    <a style="text-decoration: none;" href="{{url('setting/users/'.$user->id.'/edit')}}">
                        <span class="crop_code" title="{{$user->username}}">{{$user->username}}</span>
                    </a>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
         <br><br>

     {{--show all resources for box--}}

             <table class="table tdes">
                 <thead>
                     <tr>
                     <th scope="col" class="box_resource_title" class="center">المهام على المربع</th>
                     <th scope="col" class="box_resource_title" class="center"> النخل المغروس</th>
                 </tr>
                 </thead>
                 <tbody>
                     <tr>
                     <td>
                         {{--tasks--}}
                         <table>
                             <td>
                                 {{--show all cleaning in box--}}
                                 @if($info->tasks_count!=0  )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col"> المهمه</th>
                                                 <th scope="col"> نوع المهمه</th>
                                                 <th scope="col"> المسؤل</th>
                                                 <th scope="col"> تاريخ التنفيذ</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($info->tasks as $tasks)
                                                 <tr>
                                                     <td><a href="{{url('missions/tasks/'.$tasks->id.'/edit')}}"> {{$tasks->task}}</a></td>
                                                     <td>
                                                         <?php
                                                            switch ($tasks->status){
                                                                case 1:
                                                                   echo 'ادارية';
                                                                 break;
                                                                case 2:
                                                                    echo'زراعية';
                                                                    break;
                                                                default:
                                                                    echo 'تسويق';
                                                            }
                                                         ?>
                                                     </td>
                                                     <td>
                                                         <?php
                                                            $user=$model->box_relation('users',$tasks->to_id,'id');
                                                         ?>
                                                         <a href="{{url('setting/users/'.$user[0]->id.'/edit')}}">{{$user[0]->username}}</a>

                                                     </td>
                                                     <td>{{$tasks->implementation_at}} </td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد اى مهمه حتى الان</h5>
                                 @endif
                             </td>
                         </table>
                     </td>
                     <td>
                         {{--palms--}}
                         <table>
                             <td>
                                 {{--show all fertilizing  in box--}}
                                 @if($info->palm_count!=0 )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col">كود النخله </th>
                                                 <th scope="col"> تاريخ بدايه الغرس</th>
                                                 <th scope="col">تاريخ نهايه الغرس</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @for($i=0;$i<count($info->palms);$i++)
                                                 <tr>
                                                     <td title=" كود الصنف _ العمود _ الصف _ كود مربع">
                                                         <a href="{{url('operation/planting').'/'.$info->palms[$i]->id.'/edit'}}"> {{$info->palm_code[$i]}}</a>
                                                     </td>
                                                     <td>{{$info->palms[$i]->start_date }}</td>
                                                     <td>{{$info->palms[$i]->end_date}}</td>
                                                 </tr>
                                             @endfor
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد نخله  حتى الان</h5>
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
                     <th scope="col" class="box_resource_title" class="center">الجوره</th>
                     <th scope="col" class="box_resource_title" class="center">النخل المصاب</th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td>
                         {{--jura--}}
                         <table>
                             <td>
                                 {{--show all jura in box--}}
                                 @if($info->jura_count!=0  )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col">كود الجوره</th>
                                                 <th scope="col"> تاريخ بدايه الحفر</th>
                                                 <th scope="col">تاريخ نهايه الحفر</th>
                                                 <th scope="col"> العمق</th>
                                                 <th scope="col"> الملاحظه</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($info->all_jura as $jura)
                                                 <tr>
                                                     <td>{{$jura->code}}</td>
                                                     <td>{{$jura->start_date}}</td>
                                                     <td>{{$jura->end_date}}</td>
                                                     <td>{{$jura->depth}} متر</td>
                                                     <td>{{$jura->specifications}}</td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد اى جوره حتى الان</h5>
                                 @endif
                             </td>
                         </table>
                     </td>
                     <td>
                         {{--disease_palms--}}
                         <table>
                             <td>
                                 {{--show all jura in box--}}
                                 @if($info->disease_palm_count!=0  )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col">كود الاصابه</th>
                                                 <th scope="col"> اسم المرض</th>
                                                 <th scope="col">النخله المصابه</th>
                                                 <th scope="col"> تاريخ الإصابة</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($info->disease_palm as $disease_palm)
                                                 <tr>
                                                     <td>
                                                         <a  href="{{url('Disease/diseases/'.$disease_palm->code.'/edit')}}">{{$disease_palm->code}}</a>
                                                     </td>
                                                     <td>
                                                         <?php
                                                         $disease=$model->box_relation('diseases',$disease_palm->disease_id,'id');
                                                         ?>
                                                         {{$disease[0]->title}}
                                                     </td>
                                                     <td title="كود الصنف عمود صف كود المربع">{{$disease_palm->plam_tree_id}}</td>
                                                     <td>{{$disease_palm->date}} </td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد اى اصابه حتى الان</h5>
                                 @endif
                             </td>
                         </table>


                     </td>
                 </tr>
                 </tbody>
             </table>

             <table class="table">
                 <thead>
                 <tr>
                     <th scope="col" class="box_resource_title" class="center">الكيب </th>
                     <th scope="col" class="box_resource_title" class="center">الحصاد</th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td>
                         {{--natura--}}
                         <table>
                             <td>
                                 {{--show all cleaning in box--}}
                                 @if($info->nutria_count!=0  )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col">كود الكيب </th>
                                                 <th scope="col"> عدد النخل بالكيب</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($info->nutria as $nutria)
                                                 <tr>
                                                     <td title=" كود الكيب">
                                                         <a href="{{url('/operation/nutria/'.$nutria->id.'/edit')}}"> {{$nutria->code}}</a>
                                                     </td>
                                                     <td>{{$nutria->palm_tree_QYT }} نخله </td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد اى عمليه كيب حتى الان</h5>
                                 @endif
                             </td>
                         </table>
                     </td>
                     <td>
                         {{--harvest--}}
                         <table>
                             <td>
                                 {{--show all fertilizing  in box--}}
                                 @if($info->harvest_count!=0 )
                                     <div class="irrig_des">
                                         <table class="table">
                                             <thead>
                                             <tr>
                                                 <th scope="col">كود الحصاد </th>
                                                 <th scope="col">الصف </th>
                                                 <th scope="col">العمود </th>
                                                 <th scope="col"> صنف المحصول</th>
                                                 <th scope="col"> الكميه التى تم حصدها</th>
                                                 <th scope="col">تاريخ الحصاد </th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($info->harvest  as $harvest )
                                                 <tr>
                                                     <td title=" كود الحصاد">
                                                         <a href="{{url('operation/harvest/'.$harvest->id.'/edit')}}"> {{$harvest->code}}</a>
                                                     </td>
                                                     <td>{{$harvest->row}}</td>
                                                     <td>{{$harvest->column }}  </td>
                                                     <td>
                                                        <?php
                                                            $crop=$model->box_relation('crops',$harvest->crop_id,'id');
                                                         ?>
                                                         <a href="{{url('setting/crops/'.$crop[0]->id.'/edit')}}"> {{$crop[0]->title}}</a>
                                                     </td>
                                                     <td>{{$harvest->qyt }}  </td>
                                                     <td>{{$harvest->date }}  </td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                     </div>
                                 @else
                                     <h5 style="color: lightgrey">لا يوجد اى عمليه حصاد حتى الان</h5>
                                 @endif
                             </td>
                         </table>
                     </td>
                 </tr>
                 </tbody>
             </table>

    {{--show operation_production for box--}}
           <table class="table tdes">
               <thead>
                   <tr>
                       <th scope="col" class="box_resource_title" class="center">الرى</th>
                       <th scope="col" class="box_resource_title" class="center">التسميد</th>
                   </tr>
               </thead>
               <tbody>
               <tr>
                   <td>
                       {{--planting--}}
                       <table>
                           <td>
                               {{--show all cleaning in box--}}
                               @if($info->cleaning_count!=0  )
                                   <div class="irrig_des">
                                       <table class="table">
                                           <thead>
                                           <tr>
                                               <th scope="col">كود  </th>
                                               <th scope="col">عدد النخل </th>
                                               <th scope="col"> تاريخ بدايه الرى</th>
                                               <th scope="col"> تاريخ نهايه الرى</th>
                                               <th scope="col">التنفيذ </th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($info->cleaning as $cleaning)
                                               <tr>
                                                   <td title=" كود الرى">
                                                       <a href="{{url('operation/clean/'.$cleaning->id.'/edit')}}"> {{$cleaning->code}}</a>
                                                   </td>
                                                   <td>{{$cleaning->qyt }} نخله </td>
                                                   <td>{{$cleaning->start_date }}  </td>
                                                   <td>{{$cleaning->end_date }}  </td>
                                                   <td>
                                                       @if($cleaning->implementation==2 )
                                                           <i class="fa fa-check fa-lg"></i>
                                                       @else
                                                           <i class="fa fa-times fa-lg"></i>
                                                       @endif

                                                   </td>
                                               </tr>
                                           @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                               @else
                                   <h5 style="color: lightgrey">لا يوجد اى عمليه رى حتى الان</h5>
                               @endif
                           </td>
                       </table>
                   </td>
                   <td>
                       {{--fertilizing--}}
                       <table>
                           <td>
                               {{--show all fertilizing  in box--}}
                               @if($info->fertilizing_count!=0  )
                                   <div class="irrig_des">
                                       <table class="table">
                                           <thead>
                                           <tr>
                                               <th scope="col">كود التسميد </th>
                                               <th scope="col">السماد </th>
                                               <th scope="col">الكميه </th>
                                               <th scope="col"> تاريخ بدايه الاستخدام</th>
                                               <th scope="col"> تاريخ نهايه الاستخدام</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($info->fertilizing  as $fertilizing )
                                               <tr>
                                                   <td title=" كود التسميد">
                                                       <a href="{{url('operation/fertilizing/'.$fertilizing->id.'/edit')}}"> {{$fertilizing->code}}</a>
                                                   </td>
                                                   <td>
                                                       <?php
                                                       $material=$model->material($fertilizing->matrial_id);
                                                       ?>
                                                       <a href="{{url('setting/material/'.$material->id.'/edit')}}"> {{$material->title}}</a>
                                                   </td>
                                                   <td>{{$fertilizing->fertilizer_QYT}}</td>
                                                   <td>{{$fertilizing->start_date }}  </td>
                                                   <td>{{$fertilizing->end_date }}  </td>
                                               </tr>
                                           @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                               @else
                                   <h5 style="color: lightgrey">لا يوجد اى عمليه تسميد حتى الان</h5>
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
                   <th scope="col" class="box_resource_title" class="center">الوقايه</th>
                   <th scope="col" class="box_resource_title" class="center">فصل الفسائل</th>
               </tr>
               </thead>
               <tbody>
               {{--protection--}}
               <tr>
                  <td>
                         <table>
                       <td>
                           {{--show all protection  in box--}}
                           @if($info->protection_count!=0  )
                               <div class="irrig_des">
                                   <table class="table">
                                       <thead>
                                       <tr>
                                           <th scope="col"> كود الوقايه</th>
                                           <th scope="col">المبيد </th>
                                           <th scope="col">الكميه </th>
                                           <th scope="col"> تاريخ بدايه المكافحة</th>
                                           <th scope="col"> تاريخ نهايه المكافحة</th>
                                           <th>المسئول عن المكافحه</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($info->protection  as $protection )
                                           <tr>
                                               <td title=" كود الوقايه">
                                                   <a href="{{url('operation/protection/'.$protection->id.'/edit')}}"> {{$protection->code}}</a>
                                               </td>
                                               <td>
                                                   <?php
                                                   $material=$model->material($protection->matrial_id);
                                                   ?>
                                                   <a href="{{url('setting/material/'.$material->id.'/edit')}}"> {{$material->title}}</a>
                                               </td>
                                               <td>{{$protection->Pesticide_QYT}}</td>
                                               <td>{{$protection->start_date }}</td>
                                               <td>{{$protection->end_date }}  </td>
                                               <td>
                                                    <?php
                                                        $user=$model->box_relation('users',$protection->user_id,'id');
                                                   ?>
                                                   <a href="{{url('setting/users/'.$user[0]->id.'/edit')}}"> {{$user[0]->username}}</a>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           @else
                               <h5 style="color: lightgrey">لا يوجد اى عمليه وقايه حتى الان</h5>
                           @endif
                       </td>
                   </table>
                  </td>
                   {{--separation--}}
                 <td>
                     <table>
                       <td>
                           {{--show all separation  in box--}}
                           @if($info->separation_count!=0  )
                               <div class="irrig_des">
                                   <table class="table">
                                       <thead>
                                       <tr>
                                           <th scope="col"> كود الفصل</th>
                                           <th scope="col">كود النخله </th>
                                           <th scope="col">الصنف المزروع </th>
                                           <th scope="col">تاريخ الفصل </th>
                                           <th scope="col">عدد الفسائل</th>
                                           <th scope="col"> حجم الفسيله</th>
                                           <th>السعر</th>
                                           <th>الحالة</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($info->separation  as $separation )
                                           <tr>
                                               <td title=" كود الفصل">
                                                   <a href="{{url('operation/separation/'.$separation->id.'/edit')}}"> {{$separation->code}}</a>
                                               </td>
                                               <td>{{$separation->plam_tree}}</td>
                                               <td>
                                                   <?php
                                                   $crop=$model->box_relation('crops',$separation->crop_id,'id');
                                                   ?>
                                                   <a href="{{url('/setting/crops/'.$crop[0]->id.'/edit')}}"> {{$crop[0]->title}}</a>
                                               </td>
                                               <td>{{$separation->start_date}}</td>
                                               <td>{{$separation->number_of_separation }}</td>
                                               <td>{{$separation->size }}سم   </td>
                                               <td>{{$separation->market_price}}</td>
                                               <td>
                                                   {{$separation->case==1?'زرعت':'بيعت'}}
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           @else
                               <h5 style="color: lightgrey">لا يوجد اى عمليه فصل  حتى الان</h5>
                           @endif
                       </td>
                   </table>
                 </td>
               </tr>
               </tbody>
           </table>
   </div>

@endforeach

     <a style="margin-top: 13px;color: white" class="btn btn-info " onclick="history.back()">رجوع<i class="fa fa-arrow-left" style="padding: 7px"></i> </a>
 </div>
@endsection

