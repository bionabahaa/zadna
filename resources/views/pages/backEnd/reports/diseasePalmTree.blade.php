@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
@endsection
@section('page_header')
@endsection
@section('page_content')
   @inject('item','App\Models\diseasePalmTree')
 <div class="container crop_body">
    @foreach($info as $info)
         <h1 class="center modelTitle" title="عمود-صف-كود الصنف-كود المربع"> تقرير عن النخل<span style="color: red;font-weight: bolder"> {{$info->plam_tree_id}}</span></h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">  كود النخله المصابه </th>
            <th scope="col"> التكلفه الكليه للاصابه</th>
            <th scope="col">تاريخ الاصابه</th>
            <th scope="col">اسم المرض </th>
            <th scope="col">وصف المرض</th>
            @if($info->status==1)
                <th scope="col">نسبه  الشفاء</th>
            @elseif($info->status==0)
                 <th scope="col">  اسباب الفقد</th>
            @endif

            <th scope="col">المكافحه بواسطه</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$info->plam_tree_id}}</td>
            <td> <span style="background: #3e2f2f;padding:8px;border: 2px solid white;border-radius: 25%;color: white;"> {{$info->total_cost}} </span></td>
            <td>{{$info->date}}</td>
            <td><a href="{{url('Disease/diseases/'.$info->code.'/edit')}}">{{$info->disease_name}}</a></td>
            <td>{{$info->disease['desc']}}</td>
            @if($info->status==1)
                  <td>{{$info->recovery_percent}}</td>
            @elseif($info->status==0)
                   <td>{{$info->losses_reason}}</td>
            @endif

            <td>
               <a href="{{url('setting/users/'.$info->user->id.'/edit')}}"> {{$info->user->username}}</a>
            </td>

        </tr>

        </tbody>
    </table>

        {{--disease follow --}}

         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center">تتبع المرض</th>
                 <th scope="col" class="box_resource_title" class="center"> خطه مكافحه المرض </th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--tasks--}}
                     <table>
                         <td>
                             {{--show disease follow in palm--}}
                             @if($info->disease_follow_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> الملاحظة</th>
                                             <th scope="col">  تاريخ الملاحظة</th>
                                             <th scope="col"> كتبت بواسطة</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->disease_follow as $disease_follow)
                                             <tr>
                                                 <td>{{$disease_follow->note}} </td>
                                                 <td>{{$disease_follow->note_date}} </td>
                                                 <td>
                                                         @php
                                                             $user=$item->palmDisease_relation('users',$disease_follow->writen_by,'id')
                                                         @endphp
                                                      <a href="{{url('setting/users/'.$user[0]->id.'/edit')}}"> {{$user[0]->username}}</a>
                                                  </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى تتبع على الاصابه حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--palms--}}
                     <table>
                         <td>
                             {{--show disease combact--}}
                             @if($info->disease_combact_count!=0  )
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col"> طريقه الاستخدام</th>
                                             <th scope="col"> عدد مرات التكرار</th>
                                             <th scope="col">تاريخ المكافحه</th>
                                             <th scope="col">الخامات المستخدمه/الكميه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->disease_combact as $disease_combact)
                                             <tr>
                                                 <td>{{$disease_combact->used_way}} </td>
                                                 <td>{{$disease_combact->repeat}} </td>
                                                 <td>{{$disease_combact->date}} </td>
                                                 <td>
                                                     @php
                                                         $materials=$item->palmDisease_relation('disease_plan_materials',$disease_combact->id,'disease_combact_plan_id');

                                                       foreach($materials as $material){
                                                              $material_used= $item->palmDisease_relation('materials',$material->pesticide,'id');
                                                          echo ' <a  href='.url('setting/material/'.$material_used[0]->id.'/edit').'>' .$material_used[0]->title."=>". $material->amount.'</a><br>';
                                                         }
                                                     @endphp
                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى خطه مكافحه على المرض حتى الان</h5>
                             @endif

                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>
        {{--disease workers and costs resource--}}
         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center">بيان التكاليف</th>
                 <th scope="col" class="box_resource_title" class="center"> العماله </th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--tasks--}}
                     <table>
                         <td>
                             {{--show disease follow in palm--}}
                             @if(!empty($info->palm_resources_cost))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">البيان</th>
                                             <th scope="col"> التكلفه متوقعة</th>
                                             <th scope="col">التكلفه الفعليه</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->palm_resources_cost as $cost)
                                             <tr>
                                                 <td>{{$cost->title}}</td>
                                                 <td>{{$cost->expected_cost}}</td>
                                                 <td>{{$cost->cost}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى موارد تكاليف على النخل حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--palms--}}
                     <table>
                         <td>
                             {{--show disease resource workers--}}
                             @if(!empty($info->palm_resources_worker))
                                 <div class="irrig_des">
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
                                         @foreach($info->palm_resources_worker as $worker)
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
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى موارد عماله على النخل حتى الان</h5>
                             @endif

                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>
        {{-- disease materials and equipment resource --}}
         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center"> المعدات المستخدمه</th>
                 <th scope="col" class="box_resource_title" class="center"> الخامات المستخدمه </th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     {{--equipments--}}
                     <table>
                         <td>
                             @if(!empty($info->palm_resources_equipment))
                                 <div class="irrig_des">
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
                                         @foreach($info->palm_resources_equipment as $equipment)
                                             <tr>
                                             <?php $items=$item->palmDisease_relation('equipments',$equipment->equipment_id,'id') ?>
                                             <tr>
                                                 <td>
                                                     <a style="text-decoration: none" href="{{route('equipments.edit',$items[0]->id)}}"> {{$items[0]->title}}</a>
                                                 </td>
                                                 <td>{{$equipment->hours_used}}</td>
                                                 <td>{{$equipment->qyt}}</td>
                                                 <td>{{$equipment->datetime}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى موارد معدات على النخل حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--palms--}}
                     <table>
                         <td>
                             {{--show disease resource workers--}}
                             @if(!empty($info->palm_resources_material))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">الخامه</th>
                                             <th scope="col">  الكميه</th>
                                             <th scope="col">  تاريخ الاستخدام</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->palm_resources_material as $material)
                                             <?php $items=$item->palmDisease_relation('materials',$material->matrial_id,'id') ?>
                                             <tr>
                                                 <td>
                                                     <a style="text-decoration: none" href="{{route('material.edit',$items[0]->id)}}"> {{$items[0]->title}}</a>
                                                 </td>
                                                 <td>{{$material->qyt}}</td>
                                                 <td>{{$material->datetime}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى موارد خامات على النخل حتى الان</h5>
                             @endif

                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>

         {{--disease palm notes and recommendation resource--}}
         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center"> الملاحظات</th>
                 <th scope="col" class="box_resource_title" class="center"> التوصيات </th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     <input type="hidden" name="user_id_reco" value="{{auth()->user()->id}}">
                     {{--notes--}}
                     <table>
                         <td>
                             {{--show disease follow in palm--}}
                             @if(!empty($info->diseasePalm_notes))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">الملاحظه</th>
                                             <th scope="col"> القائم بالملاحظه</th>
                                             <th scope="col">التاريخ</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->diseasePalm_notes as $note)
                                             @php $user=$item->palmDisease_relation('users',$note->from_id,'id') @endphp
                                             <tr>
                                                 <td>{{$note->comment}}</td>
                                                 <td> <a href="{{url('setting/users/'.$user[0]->id.'/edit')}}"> {{$user[0]->username}} </a> </td>
                                                 <td>{{$note->datetime}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى ملاحظات على النخل حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--recommendations--}}
                     <table>
                         <td>
                             @if(!empty($info->diseasePalm_recommendations))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">التوصيه</th>
                                             <th scope="col"> القائم بالتوصيه</th>
                                             <th scope="col">التاريخ</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->diseasePalm_recommendations as $recommendation)
                                             @php $user=$item->palmDisease_relation('users',$recommendation->from_id,'id') @endphp
                                             <tr>
                                                 <td>{{$recommendation->comment}}</td>
                                                 <td> <a href="{{url('setting/users/'.$user[0]->id.'/edit')}}">  {{$user[0]->username}} </a></td>
                                                 <td>{{$recommendation->datetime}}</td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى توصيات على النخل حتى الان</h5>
                             @endif

                         </td>
                     </table>
                 </td>
             </tr>
             </tbody>
         </table>


         {{--disease palm experiment --}}
         <table class="table tdes">
             <thead>
             <tr>
                 <th scope="col" class="box_resource_title" class="center"> التجارب</th>
                 <th scope="col" class="box_resource_title" class="center"> فصل الفسائل </th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <td>
                     <table>
                         <td>
                             @if(!empty($info->palm_experiment))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">كود التجربه</th>
                                             <th scope="col">  اسم التجربه</th>
                                             <th scope="col">نوع التجربه</th>
                                             <th scope="col"> تاريخ الانشاء</th>
                                             <th scope="col"> موعد التنفيذ</th>
                                             <th scope="col">نسبه  النجاح</th>
                                         </tr>
                                         </thead>
                                         <tbody>

                                         @foreach($info->palm_experiment as $experiment)
                                             <tr>
                                                 <td><a href="{{url('Experiments/experiments/'.$experiment->id.'/edit')}}"> {{$experiment->code}}</a></td>
                                                 <td>{{$experiment->name}} </td>
                                                 <td>{{$experiment->experiment_type}}</td>
                                                 <td>{{$experiment->create_date}}</td>
                                                 <td>{{$experiment->execution_date}}</td>
                                                 <td>% {{ $experiment->success_percent}}  </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى تجربه على النخل حتى الان</h5>
                             @endif
                         </td>
                     </table>
                 </td>
                 <td>
                     {{--recommendations--}}
                     <table>
                         <td>
                             @if(!empty($info->palm_separations))
                                 <div class="irrig_des">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">كود الفصل</th>
                                             <th scope="col">  تاريخ الفصل</th>
                                             <th scope="col">عدد الفسائل</th>
                                             <th scope="col">الحاله </th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($info->palm_separations as $separation)
                                             <tr>
                                                 <td><a href="{{url('operation/separation/'.$separation->id.'/edit')}}">{{$separation->code}}</a></td>
                                                 <td>{{$separation->start_date}}</td>
                                                 <td>{{$separation->number_of_separation}} فسيله</td>
                                                 <td>{{$separation->case==1?'زرعت':'بيعت'}}</td>

                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @else
                                 <h5 style="color: lightgrey">لا يوجد اى فسل فسائل على النخل حتى الان</h5>
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

