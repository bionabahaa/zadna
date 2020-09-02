@extends('layouts.backEnd')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/side-menu.css">
@endsection
@section('page_script')
    <script>
        var operation_page=1;
        var report=false;
        $(function () {
            $(".select2").select2();
        });
    </script>
    <script>
        var add = function () {
            var CopyTR = '<div class="col-md-12">' + $(".tr-rep").html() + '</div>';
            $(".Ttyps").append(CopyTR);
    
        }
    </script>
    <script src="{{ asset('public') }}/js/backEnd/box.js"></script>

@endsection
@section('page_header')
@endsection
@php
$rows=[
    'row'=>'',
    'column'=>'',
    'crops'=>[]
];
if(count($info->cropsbox)>0){
    $rows=[];
}
foreach($info->cropsbox as $key=>$value){
    $row['row']=$info->rowsbox[$key];
    $row['column']=$info->columnsbox[$key];
    $row['crops']=$value;
    $rows[]=$row;
}
$inputs=[
        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'row_count',
            'id'=>'row_count',
            'value'=>$info->row_count,
            'title'=>'عدد الصفوف',
            'placeholder'=>'',
        ],
        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'column_count',
            'id'=>'column_count',
            'value'=>$info->column_count,
            'title'=>'عدد الاعمده',
            'placeholder'=>'',
        ],
        [
            'type'=>2,
            'class'=>'col-md-3',
            'name'=>'size',
            'id'=>'size',
            'value'=>$info->size,
            'title'=>'مساحه المربع',
            'placeholder'=>'',
        ],
        [
            'type'=>12,
            'class'=>'col-md-3',
            'name'=>'users',
            'id'=>'users',
            'value'=>$info->Users,
            'title'=>'العمال المسئولين',
            'placeholder'=>'',
            'selector'=>'username',
            'options'=>$Users
        ],
        [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point1',
        'id'=>'point1',
        'value'=>[
            'point'=>$point1[0],
            'north'=>[$point1_north[0],$point1_north[1],$point1_north[2],$point1_north[3]],
            'east'=>[$point1_east[0],$point1_east[1],$point1_east[2],$point1_east[3]]
            ],
        'title'=>'نقطه1',
        'placeholder'=>'نقطه1',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point2',
        'id'=>'point2',
        'value'=>[
            'point'=>$point2[0],
            'north'=>[$point2_north[0],$point2_north[1],$point2_north[2],$point2_north[3]],
            'east'=>[$point2_east[0],$point2_east[1],$point2_east[2],$point2_east[3]]
        ],
        'title'=>'نقطه2',
        'placeholder'=>'نقطه2',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point3',
        'id'=>'point3',
        'value'=>[
            'point'=>$point3[0],
            'north'=>[$point3_north[0],$point3_north[1],$point3_north[2],$point3_north[3]],
            'east'=>[$point3_east[0],$point3_east[1],$point3_east[2],$point3_east[3]]
        ],
        'title'=>'نقطه3',
        'placeholder'=>'نقطه3',
    ],
    [
        'type'=>10,
        'class'=>'col-md-3',
        'name'=>'point4',
        'id'=>'point4',
        'value'=>[
            'point'=>$point4[0],
            'north'=>[$point4_north[0],$point4_north[1],$point4_north[2],$point4_north[3]],
            'east'=>[$point4_east[0],$point4_east[1],$point4_east[2],$point4_east[3]]
        ],
        'title'=>'نقطه4',
        'placeholder'=>'نقطه4',
    ],
    [
        'type'=>8,
        'class'=>'col-md-12',
        'name'=>['row','column','crops'],
        'id'=>['row','column',''],
        'value'=>$rows,
        'title'=>['الصف','العمود','الصنف'],
        'placeholder'=>['','',''],
        'mainClass'=>'col-md-4',
        'types'=>[2,2,11],
        'container'=>'Ttyps',
        'buckup'=>'tr-rep',
        'selector'=>['','','title'],
        'options'=>['','',$Crops],
        'countRow'=>count($rows)
    ],
    [
        'type'=>4,
        'class'=>'col-md-6',
        'name'=>'id',
        'id'=>'id',
        'value'=>$info->id,
        'title'=>'',
        'placeholder'=>'',
    ],
    
];
$links=[
    [
        'title'=> 'الاعدادات العامه',
        'url'=> url('/setting'),
    ],
    [
        'title'=> 'المربعات',
        'url'=> url('/setting/boxes'),
    ]
];
$mainLink='تعديل مربع ';
@endphp
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    @include('pages.backEnd.AllModuels')
    <div class="row m-0">
        @if($operation_page)
            @include('pages.backEnd.Operations.rightLink')
            <div class="col-sm-10 col-10 p-0">
                @else
                    <div class="col-sm-12 col-10 p-0">
                        @endif

                        <div>
                            <div class="row  mt-0 mr-4 ml-4 mb-4">
                                @if($operation_page)
                                    <ul class="nav nav-tabs tabrow" id="myTab" role="tablist" style="margin-top: 5%;border-right: 1.5px solid #dee2e6; margin-bottom: 0px">
                                        <li class="nav-item selected ">
                                            <a class="nav-link linkColor active " id="Gdetails-tab" data-toggle="tab" href="#Gdetails" role="tab" aria-controls="Gdetails" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">المواصفات العامة</a>
                                        </li>

                                        <li class="nav-item " style="display:none">
                                            <a class="nav-link linkColor " id="Categ-tab" data-toggle="tab" href="#Categ" role="tab" aria-controls="Categ" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">الاصناف المزروعة</a>
                                        </li>

                                        <li class="nav-item ">
                                            <a class="nav-link linkColor " id="analyse-tab" data-toggle="tab" href="#analyse" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding:4px;font-size: 22px;">تحليل التربة</a>
                                        </li>

                                        <li class="nav-item ">
                                            <a class="nav-link linkColor " id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">موارد العملية</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link linkColor  " id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true" style="border: none;padding: 4px;font-size: 22px;">الملاحظات</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link linkColor" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="analyse" aria-selected="false" style="border: none;padding: 4px;font-size: 22px;">توصيات</a>
                                        </li>
                                    </ul>
                                @endif

                                <div class="tab-content pb-5 " id="myTabContent" style="width: 100%;overflow: hidden;">
                                    <div class="tab-pane fade  show active  " id="Gdetails" role="tabpanel" aria-labelledby="Gdetails-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                                        <form id="EditBoxForm" method="POST">
                                            @foreach (array_chunk($inputs, 4) as $inputs_row)
                                                <div class="row">
                                                    @foreach ($inputs_row as $input)
                                                        @component('pages.backEnd.components.inputs',['input'=>$input])
                                                        @endcomponent
                                                    @endforeach
                                                </div>
                                                <hr style="border-top-width: 3px;border-color: #58b82a;">
                                            @endforeach
                                        </form>
                                        <div class="col-md-12" style="text-align: center">
                                            @component('pages.backEnd.components.buttons',['type'=>2,'id'=>'','title'=>'إضافه صنف جديد' ,'onclick'=>'add()','class'=>'btn-success'])
                                            @endcomponent
                                            @component('pages.backEnd.components.buttons',['type'=>1])
                                            @endcomponent
                                        </div>
                                    </div>


                                    @if($operation_page)

                                        <div class="tab-pane fade " id="analyse" role="tabpanel" aria-labelledby="analyse-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                                            <div class="Mparent">
                                                <div class="Tparent">
                                                    <div class="row m-3 justify-content-center ">
                                                        <div class="col-lg-12 ">
                                                            <table class="table zadnatable mainTable notesTable" tableId="14">
                                                                <thead>
                                                                <tr>
                                                                    <th>الملف</th>
                                                                    <th>تاريخ رفع الملف</th>
                                                                    <th>ملاحظات</th>
                                                                    <th>توصيات</th>
                                                                    <th class="actions">
                                                                        <i class="far fa-plus-square" data-target="#SoilanalysisModel" data-toggle="modal" style="cursor: pointer"></i>
                                                                        {{-- <a href="" data-target="#SoilanalysisModel" data-toggle="modal">إضافه</a> --}}
                                                                    </th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($soil_analysis as $value)
                                                                    <tr>
                                                                        <td><a href="{{ url('public//images/Uploads/box/') . '/' . $value->file }}" >ملف</a></td>
                                                                        <td>{{ date('Y-m-d',strtotime($value->datetime)) }}</td>
                                                                        <td>{{ $value->note }}</td>
                                                                        <td>{{ $value->recommendation }}</td>
                                                                        <td>
                                                                            <button type="button" class="delete_soil_analysis"  data-id="{{ $value->id }}" >

                                                                                مسح
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  " id="Categ" role="tabpanel" aria-labelledby="Categ-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">
                                            <div class="Mparent">
                                                <div class="Tparent">
                                                    <div class="row m-4">
                                                        <div class="col-lg-2  col-6">
                                                        </div>
                                                        <div class=" col-lg-6  col-12 offset-lg-4 mt-3 float-left text-right ">
                                                            <button class="add-crepto mr-2 mb-2 addNewRow " data-target="#addsquareModal" data-toggle="modal">أضافة صنف </button>
                                                        </div>
                                                    </div>
                                                    <div class="row m-3 justify-content-center ">
                                                        <div class="col-lg-12 ">
                                                            <table class="table zadnatable mainTable notesTable" tableId="13">
                                                                <thead>
                                                                <tr>
                                                                    <th>الكود</th>
                                                                    <th>الصنف</th>
                                                                    <th>الصف</th>
                                                                    <th>العمود</th>
                                                                    <th>عدد النخل</th>
                                                                    <th class="actions">
                                                                        <i class="fas fa-bars"></i>
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr rowId="12">
                                                                    <td>
                                                                        <div class="form-group InputGroup">
                                                                            <input type="text" class="form-control td-input" value="1" disabled>
                                                                        </div>
                                                                    </td>
                                                                    <td title="">
                                                                        <div class="form-group InputGroup">
                                                                            <input type="text" class="form-control td-input" value="لالالالالالالالالالالالالالالالال" disabled>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group InputGroup">
                                                                            <input type="text" class="form-control td-input" value="1" disabled>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group InputGroup">
                                                                            <input type="text" class="form-control td-input" value="مزارع" disabled>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group InputGroup">
                                                                            <input type="text" class="form-control  td-input" value="محاسب" disabled>
                                                                        </div>
                                                                    </td>
                                                                    <td class="query-td">
                                                                        <i class="fas fa-eye view-row" data-target="#addsquareModal" data-toggle="modal"></i>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div id="addsquareModal" class="modal fade" role="dialog" currTable>
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content modalbg-add">
                                                                <div class="modal-header d-flex flex-row-reverse">
                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                    <h5 class="modal-title text-center ">اضافه صنف</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <label class="col-4" for="descrep">الصنف:</label>
                                                                            <input type="text" id="descrep" class="border-style col-6 col-val">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <label class="col-4" for="descrep">الصف:</label>
                                                                            <input type="text" id="descrep" class="border-style col-6 col-val">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <label class="col-4" for="descrep">العمود</label>
                                                                            <input type="text" id="descrep" class="border-style col-6 col-val">

                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <label class="col-4" for="descrep">العملية:</label>
                                                                            <!--                                    <input type="text" id="descrep" class="border-style col-6 col-val">-->
                                                                            <select class="form-control numric select2 typescrop td-edit select2-hidden-accessible col-6 " style="width: 30%;" tabindex="-1" aria-hidden="true">
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                                <option>6</option>
                                                                                <option>7</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <label class="col-4" for="date">عدد /كود النخل</label>
                                                                            <input type="number" id="date" class="border-style col-3 col-val mr-4">
                                                                            <select class="form-control numric select2 typescrop td-edit select2-hidden-accessible  col-3  " style="width: 30%;" tabindex="-1" aria-hidden="true" multiple>
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                                <option>6</option>
                                                                                <option>7</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#" id="saveDate" class="danger btn btn-primary btnSave ">حفظ</a>
                                                                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">الغاء</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $process_array=[
                                                'moduel_id'=>11
                                            ];
                                        @endphp
                                        @include('pages.backEnd.Operations.process',$process_array)
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

@endsection