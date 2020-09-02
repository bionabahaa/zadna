@php

$opertion_type=[
    1=>'التكاليف',
    2=>'العماله',
    3=>'المعدات',
    4=>'الخامات',
];



@endphp
@inject('service', 'App\Http\Controllers\BladeController')

<div class="tab-pane fade " id="resource" role="tabpanel" aria-labelledby="resource-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
    <div class="Mparent">
        <!--table1    -->
        <div class="Tparent">
            <div class="row m-4 ">
                <div class="col-lg-12 col-sm-12 col-12 ">
                    <div class="col-6 collapsed" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" data-toggle="collapse" href="#collapseExample4" aria-expanded="false">
                        <a class="fas fa-caret-left " style="color:green"></a>
                        <span class="faults-types1"> التكاليف: </span>
                    </div>
                    <hr class="light-hr1">
                    <div class="collapse   table-responsive" id="collapseExample4" style="padding-bottom: 5rem;">
                        <button type="button" class="addNewRow add-crepto mr-2 mb-2 sssss " data-toggle="modal" data-target="#addmodal1" style="margin-right: 80%;">أضافة </button>
                        <table class="table  table-bordered table2 mainTable" tableid="6">
                            <thead style="text-align: center">
                                <tr>
                                    <th scope="col">الكود</th>
                                    <th scope="col">البيان</th>
                                    <th scope="col"> تكلفه متوقعة</th>
                                    <th scope="col"> تكلفه فعلية</th>
                                    <th scope="col"> تاريخ الدفع</th>
                                    <th scope="col">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($OperationResources as $value)
                                    @if($value->opertion_type_id==1)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->expected_cost }}</td>
                                            <td>{{ $value->cost }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                            <td>
                                                <button type="button" class="delete_costs"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  add modal for  table1  -->
            <div id="addmodal1" class="modal fade " role="dialog" currtable>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content modalbg-add">
                        <div class="modal-header d-flex flex-row-reverse">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title ">اضافة</h5>
                        </div>
                        <div class="modal-body">
                            <form  id="CostsAdd1">
                                <input type="hidden" name="post_id" id="post_id" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif>
                                <input type="hidden" name="moduel_id" id="moduel_id" value="{{ @$moduel_id }}">
                                <input type="hidden" name="box_id" id="box_id" value="{{ @$box_id }}">
                                <input type="hidden" name="opertion_type_id" id="opertion_type_id" value="1">
                                <div class="row m-4">
                                    <div class="col">
                                        <label class="col-5" for="state">البيان:</label>
                                        <input type="text" required id="state" name="title1" class="border-style col-6 col-val">
                                    </div>
                                </div>
                                <div id="title1_demo"></div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-5" for="ExCost">تكلفه متوقعة:</label>
                                        <input type="text" name="expected_cost" id="ExCost" class="border-style col-6 col-val">
                                    </div>
                                    <div id="expected_cost_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-5" for="RlCost">تكلفه فعلية:</label>
                                        <input type="text" name="cost1" id="RlCost" class="border-style col-6 col-val">
                                    </div>
                                    <div id="cost1_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-5" for="date">التاريخ:</label>
                                        <input type="date" name="datetime" id="date" class="border-style col-6 col-val">
                                    </div>
                                    <div id="datetime_demo"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="danger btn btn-primary btnSave saveDateCosts" data-id="1">حفظ</button>
                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="Mparent">
        <!--table2    -->
        <div class="Tparent">
            <div class="row m-4">
                <div class="col-lg-12 col-sm-12 col-12 collapsed  ">
                    <div data-toggle="collapse" href="#collapseExample5" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" aria-expanded="false">
                        <a class="fas fa-caret-left " style="color:green"></a>
                        <span class="faults-types1"> العمالة: </span>
                    </div>
                    <hr class="light-hr1">
                    <div class="collapse table-responsive" id="collapseExample5">
                        <button type="button" class=" addNewRow add-crepto mr-2 mb-2 sssss " data-toggle="modal" data-target="#addmodal22" style="margin-right: 80%;">أضافة </button>
                        <table class="table  table-bordered table2 mainTable" tableid="7">
                            <thead style="text-align: center">
                                <tr>
                                    <th scope="col">الكود</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col">العدد</th>
                                    <th scope="col"> عدد ساعات العمل باليوم</th>
                                    <th scope="col"> عدد ايام العمل</th>
                                    <th scope="col"> التكلفه</th>
                                    <th scope="col"> تاريخ بدايه العمل </th>
                                    <th scope="col"> تاريخ نهايه العمل </th>
                                    <th scope="col">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($OperationResources as $value)
                                    @if($value->opertion_type_id==2)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>
                                                @if($value->workers_type_id==1 )
                                                    مؤقت
                                                    @else
                                                    دائم
                                                @endif
                                            </td>
                                            <td>{{ $value->workers_count }}</td>
                                            <td>{{ $value->working_number_hours_per_day }}</td>
                                            <td>{{ $value->working_number_days }}</td>
                                            <td>{{ $value->cost }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime_end)) }}</td>
                                            <td>
                                                <button type="button" class="delete_costs"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  add modal for  table2  -->
            <div id="addmodal22" class="modal fade" role="dialog" currtable>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content modalbg-add">
                        <div class="modal-header d-flex flex-row-reverse">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title ">اضافة</h5>
                        </div>
                        <div class="modal-body">
                            <form action="" id="CostsAdd2">
                                <input type="hidden" name="post_id" id="post_id" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif>
                                <input type="hidden" name="moduel_id" id="moduel_id" value="{{ @$moduel_id }}">
                                <input type="hidden" name="box_id" id="box_id" value="{{ @$box_id }}">
                                <input type="hidden" name="opertion_type_id" id="opertion_type_id" value="2">
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="type">النوع:</label>
                                        <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                            <select name="workers_type_id" class="form-control col-val  " id="type" value="1">
                                                <option value="1">مؤقت</option>
                                                <option value="2">دائم</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-7" for="material1">العدد:</label>
                                        <input type="number" name="workers_count" id="material1" class="col-4 border-style col-val">
                                    </div>
                                    <div id="workers_count_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-7" for="whours">عدد ساعات العمل باليوم:</label>
                                        <input type="number" name="working_number_hours_per_day" id="whours" class="col-4  border-style col-val">
                                    </div>
                                    <div id="working_number_hours_per_day_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-7" for="days1">عدد ايام: العمل</label>
                                        <input type="number" name="working_number_days" id="days1" class="col-4 border-style col-val">
                                    </div>
                                    <div id="working_number_days_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-7" for="quantm1">التكلفه:</label>
                                        <input type="text" name="cost2" id="quantm1" class="col-4 border-style col-val">
                                    </div>
                                    <div id="cost2_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-5" for="date1">تاريخ بدايه العمل:</label>
                                        <input type="date" name="date2" id="date1" class="col-6 border-style col-val">
                                    </div>
                                    <div id="date2_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-5" for="date1">تاريخ نهايه العمل:</label>
                                        <input type="date" name="datetime_end" id="date1" class="col-6 border-style col-val">
                                    </div>
                                    <div id="datetime_end"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="danger btn btn-primary btnSave saveDateCosts" data-id="2">حفظ</button>
                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Mparent">
        <!--table3    -->
        <div class="Tparent">
            <div class="row m-4">
                <div class="col-lg-12 col-sm-12 col-12 collapsed">
                    <div data-toggle="collapse" href="#collapseExample6" style="margin-right: 6% ; margin-top: 2% ;cursor: pointer" aria-expanded="false">
                        <a class="fas fa-caret-left " style="color:green"></a>
                        <span class="faults-types1"> المعدات: </span>
                    </div>
                    <hr class="light-hr1">
                    <div class="collapse  table-responsive" id="collapseExample6">
                        <button type="button" class="add-crepto mr-2 mb-2 sssss  addNewRow" data-toggle="modal" data-target="#addmodal3" style="margin-right: 80%;">أضافة </button>

                        <table class="table  table-bordered table2 mainTable" tableid="8">
                            <thead style="text-align: center">
                                <tr>
                                    <th scope="col">الكود</th>
                                    <th scope="col">المعده</th>
                                    <th scope="col"> عدد ساعات الاستخدام</th>
                                    <th scope="col"> الكميه</th>
                                    <th scope="col"> تاريخ بدايه الاستخدام</th>
                                    <th scope="col"> تاريخ نهايه الاستخدام</th>
                                    <th scope="col">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($OperationResources as $value)
                                    @if($value->opertion_type_id==3)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>{{ $value->equipment->title }}</td>
                                            <td>{{ $value->hours_used }}</td>
                                            <td>{{ $value->qyt }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime_end)) }}</td>
                                            <td>
                                                <button type="button" class="delete_costs"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  add modal for  table3  -->
            <div id="addmodal3" class="modal fade" role="dialog" currtable>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content modalbg-add">
                        <div class="modal-header d-flex flex-row-reverse">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title ">اضافة</h5>
                        </div>
                        <div class="modal-body">
                            <form action="" id="CostsAdd3">
                                <input type="hidden" name="post_id" id="post_id" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif>
                                <input type="hidden" name="moduel_id" id="moduel_id" value="{{ @$moduel_id }}">
                                <input type="hidden" name="opertion_type_id" id="opertion_type_id" value="3">
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-6" for="type3">المعدة:</label>
                                       
                                        <select name="equipment_id" class="form-control col-val  " id="type" value="1">
                                            @foreach ($Equipments as $value)
                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-6" for="material3">عدد ساعات الاستخدام:</label>
                                        <input type="number" name="hours_used" id="material3" class="col-4 border-style col-val">
                                    </div>
                                    <div id="hours_used_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-6" for="material3">الكميه:</label>
                                        <input type="number" name="qyt" id="qyt" class="col-4 border-style col-val">
                                    </div>
                                    <div id="qyt_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="quantm3">تاريخ بدايه الاستخدام :</label>
                                        <input name="date3" type="date" id="quantm3" class="col-6 border-style col-val">
                                    </div>
                                    <div id="date3_demo"></div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="quantm3">تاريخ نهايه الاستخدام:</label>
                                        <input name="date3_end" type="date" id="quantm3" class="col-6 border-style col-val">
                                    </div>
                                    <div id="date3_end_demo"></div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="danger btn btn-primary btnSave saveDateCosts" data-id="3">حفظ</button>
                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Mparent">
        <!--table4    -->
        <div class="Tparent">
            <div class="row m-4">
                <div class="col-lg-12 col-sm-12 col-12 collapsed">
                    <div data-toggle="collapse" href="#collapseExample7" style="margin-right: 6% ; margin-top: 2%;cursor: pointer" aria-expanded="false">
                        <a class="fas fa-caret-left " style="color:green"></a>
                        <span class="faults-types1"> الخامات: </span>
                    </div>
                    <hr class="light-hr1">
                    <div class="collapse  table-responsive" id="collapseExample7">
                        <button type="button" class="add-crepto mr-2 mb-2 sssss  addNewRow" data-toggle="modal" data-target="#addmodal4" style="margin-right: 80%;">أضافة </button>

                        <table class="table  table-bordered table2 mainTable" tableid="9">
                            <thead style="text-align: center">
                                <tr>
                                    <th scope="col">الكود</th>
                                    <th scope="col">النوع</th>
                                    <th scope="col"> الكميه</th>
                                    <th scope="col"> التاريخ</th>
                                    <th scope="col">
                                        <i class="fas fa-bars"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($OperationResources as $value)
                                    @if($value->opertion_type_id==4)
                                        <tr>
                                            <td>{{ $value->code }}</td>
                                            <td>{{ $value->matrial->title }}</td>
                                            <td>{{ $value->qyt }}</td>
                                            <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                            <td>
                                                <button type="button" class="delete_costs"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  add modal for  table4  -->
            <div id="addmodal4" class="modal fade" role="dialog" currtable>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content modalbg-add">
                        <div class="modal-header d-flex flex-row-reverse">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title ">اضافة</h5>
                        </div>
                        <div class="modal-body">
                            <form action="" id="CostsAdd4">
                                <input type="hidden" name="post_id" id="post_id" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif>
                                <input type="hidden" name="moduel_id" id="moduel_id" value="{{ @$moduel_id }}">
                                <input type="hidden" name="opertion_type_id" id="opertion_type_id" value="4">
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="type">النوع:</label>
                                        <div class=" col-3 float-right m-0 p-0 " style="    margin-left: 5rem!important;">
                                            <select name="matrial_id" class="form-control col-val  " id="type" value="1">
                                                @foreach ($Matriels as $value)
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="type">الاسم:</label>
                                        <input type="text" name="title4" id="material3" class="col-4 border-style col-val">
                                    </div>
                                    <div id="title4_demo"></div>
                                </div>
                               
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="quantm">الكمية:</label>
                                        <input name="qyt" type="text" id="quantm" class="col-6 border-style  col-val">
                                    </div>
                                    <div id="qyt_demo"></div>
                                </div>
                                <br>
                                <div class="row m-4">
                                    <div class="col-12">
                                        <label class="col-4" for="data">التاريخ:</label>
                                        <input name="date4" type="date" id="data" class="col-6 border-style col-val">
                                    </div>
                                    <div id="date4_demo"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="danger btn btn-primary btnSave saveDateCosts" data-id="4">حفظ</button>
                            <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
    <div class="Tparent">
        <div class="row m-4">
            <div class="col-lg-2  col-6">
                <div>
                    <label>النوع :</label>
                </div>
                <select class="form-control filter-form filter1">
                    <option>الكل</option>
                    <option>مرسله</option>
                    <option> مستقبله</option>
                </select>
            </div>
            <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">
                <button type="button" class="add-crepto mr-2 mb-2 addNewRow " data-target="#addNotesModal" data-toggle="modal">أضافة ملاحظة </button>

            </div>
        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-12 ">
                <table class="table zadnatable mainTable notesTable" tableId="11">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th style="width: 30%;">الملاحظة</th>
                            <th>من</th>
                            <th>العملية</th>
                            <th>التاريخ</th>
                            <th class="actions">
                                <i class="fas fa-bars"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    {{--check if notes for disease or other model--}}
                    @php
                        if(isset($info_detail)){
                            $note_id=$info_detail->code;
                        }else{
                            $note_id=$info->id;
                        }
                    @endphp
                        @foreach ($service->get_Notes($moduel_id,$note_id) as $value)
                            @php
                            $type=$service->get_notes_type();
                            @endphp
                            <tr rowId="1">
                                <td>{{ $value->code }}</td>
                                <td>{{ $value->comment }}</td>
                                <td>{{ $value->username }}</td>
                                <td>
                                    @if($value->opertion==1)
                                                عادى
                                        @else
                                        غير عادى
                                    @endif
                                </td>
                                {{-- <td>{{ $type[$value->opertion] }}</td> --}}
                                <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                <td>
                                    <button type="button" class="delete_notes"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="addNotesModal" class="modal fade" role="dialog" currTable view-chat="view-notes">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">اضافه ملاحظة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="" id="NotesAdd">
                            <input type="hidden" name="model_id" value="{{ @$moduel_id }}" id="model_id">
                            <input type="hidden"@if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif name="id" id="id">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="col-4" for="descrep">الملاحظة:</label>
                                    <textarea type="text" name="comment" id="descrep" class="border-style col-6 col-val"></textarea>
                                    <div id="comment_demo"></div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" id="descrep" class="border-style col-6 col-val">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="col-4" for="descrep">العملية:</label>
                                    <select name="opertion" class="border-style col-6 col-val" id="">
                                        @foreach($service->get_notes_type() as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="col-4" for="date">التاريخ:</label>
                                    <input type="date" name="date_note" id="date" class="border-style col-6 col-val">
                                </div>
                                <div id="date_note_demo"></div>
                            </div>
                        </form>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="saveDateNotes" class="danger btn btn-primary SaveNote ">حفظ</button>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade " id="requests" role="tabpanel" aria-labelledby="requests-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
    <div class="Tparent">
        <div class="row m-4">
            <div class=" col-lg-6  col-12 offset-lg-6 mt-3 float-left text-right ">
                <button type="button" class="add-crepto mr-2 mb-2 addNewRow " data-target="#addreqModal" data-toggle="modal">أضافة توصيه </button>
            </div>
        </div>
        <div class="row m-3 justify-content-center ">
            <div class="col-lg-12 ">
                <table class="table zadnatable mainTable" tableId="12">
                    <thead>
                        <tr>
                            <th>تاريخ التوصيه</th>
                            <th style="width: 30%;"> التوصية</th>
                            <th>الرد علي التوصية</th>
                            <th class="actions">
                                <i class="fas fa-bars"></i>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="static-col3">
                    {{--check if recomendation for disease or other model--}}
                    @php
                        if(isset($info_detail)){
                            $recommendation_id=$info_detail->code;
                        }else{
                            $recommendation_id=$info->id;
                        }
                    @endphp
                            @foreach ($service->get_Recommendtions($moduel_id,$recommendation_id) as $value)
                            <tr rowId="20">
                                <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                <td>{{ $value->comment }}</td>
                                <td>
                                    <i class="fas fa-check-circle text-center state mr-3 solved" data-target="#sendRepModal{{ $value->id }}" data-toggle="modal"></i>
                                    <div id="sendRepModal{{ $value->id }}" class="modal fade" role="dialog" currTable viewrow replayState>
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content modalbg-add">
                                                <div class="modal-header d-flex flex-row-reverse">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h5 class="modal-title text-center ">الرد علي التوصية</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="POST" id="ReplayRecommendtionsAdd{{ $value->id }}">

                                                        <input type="hidden" name="model_id" value="{{ @$moduel_id }}" id="model_id">
                                                        <input type="hidden" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif name="post_id" id="post_id">
                                                        <input type="hidden" value="{{ @$value->id }}" name="recommendation_id" id="recommendation_id">
                                                        <div class="row mb-4">
                                                            <div class="col-12">
                                                                <label class="col-4" for="descrep">اترك تعليقا</label>
                                                                <textarea type="text" name="comment_reply" id="descrep" class="border-style col-6 col-val"></textarea>
                                                            </div>
                                                            <div id="comment_reply_demo"></div>
                                                        </div>
                                                    </form>
                                                    <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-id="{{ $value->id }}" class="danger btn btn-primary Send saveDateReplayRecommendtions">حفظ</button>
                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                </div>
                                            </div>
                            
                                        </div>
                                    </div>
                                </td>
                                <td>
                                  <!--  <i class="fas fa-eye view-row view-req" onclick="showRecommendtionDetails({{ $value->id }})"></i>-->
                                    <button type="button" class="delete_recommendtions"  data-id="{{ $value->id }}" ><i class="fas fa-trash-alt "title="Delete"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        
                           
                            
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div id="addreqModal" class="modal fade less-culs" role="dialog" currTable view-chat="view-req">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modalbg-add">
                    <div class="modal-header d-flex flex-row-reverse">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title text-center ">اضافه ملاحظة</h5>
                    </div>
                    <div class="modal-body">
                        <form action="POST" id="RecommendtionsAdd">
                            <input type="hidden" name="user_id_reco" value="{{auth()->user()->id}}">
                            <input type="hidden" name="model_id" value="{{ @$moduel_id }}" id="model_id">
                            <input type="hidden" @if(isset($info_detail))  value="{{ @$info_detail->code }}" @else  value="{{ @$info->id }}"@endif name="post_id" id="post_id">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="col-4" for="descrep">تاريخ التوصية:</label>
                                    <input name="date_reco" type="date" id="descrep" class="border-style col-6 col-val">
                                </div>
                                <div id="date_reco_demo"></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="col-4" for="descrep">التوصية:</label>
                                    <textarea name="comment_reco" type="text" id="descrep" class="border-style col-6 col-val"></textarea>
                                </div>
                                <div id="comment_reco_demo"></div>
                            </div>
                        </form>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="saveDateRecommendtions" class="danger btn btn-primary SaveNote ">حفظ</button>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    
    


</div>

<div class="tab-pane fade" id="req-chat" role="tabpanel" aria-labelledby="requests-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="chat p-2" id="RecommendtionDetails">
                           
                        </ul>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

