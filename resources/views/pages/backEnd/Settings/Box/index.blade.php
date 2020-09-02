

@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
    var report=false;
</script>
<script src="{{ asset('public') }}/js/backEnd/box.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
@php
$inputs=[
  [
      'type'=>7,
      'class'=>'col-md-4',
      'name'=>'box_signature',
      'id'=>'box_signature',
      'value'=>$bath.'/'.@$box_signature->value,
      'title'=>'توقيع مربعات',
      'placeholder'=>'',
  ],
];
$links=[
    [
        'title'=> 'الاعدادات العامه',
        'url'=> url('/setting'),
    ],
];
$mainLink='المربعات';
@endphp
@inject('healper', 'App\Http\Controllers\BladeController')

<section class="content cropType">
    <section class="content cropType">
        @component('pages.backEnd.components.breadcarms',['links'=>$links,'main_page'=>$mainLink])
        @endcomponent

        <div class="container-fluid">
            @if($healper->check_permission(4,2))
                @foreach (array_chunk($inputs, 3) as $inputs_row)
                    <div class="row">
                        @foreach ($inputs_row as $input)
                            @component('pages.backEnd.components.inputs',['input'=>$input])
                            @endcomponent
                        @endforeach
                    </div>
                    <hr style="border-top-width: 3px;border-color: #58b82a;">
                @endforeach
            @endif
        </div>

        <div class="Mparent">
            <div class="Tparent">
                <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box" style="height: 90px;">
                    <div class="col-lg-10">
                        <div class="row filter-res">
                            <div class="col-lg-3 col-sm-12 col-md-12 col-12 search-div">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-4">
                    <div class="float-left ">
                        @if($healper->check_permission(4,3))
                        <button class="add-crepto mr-2 mb-2 addNewRow" onclick="window.location.href='{{ url('setting/boxes/create/') }}'">أضافة مربع</button>
                        @endif
                        @if($healper->check_permission(4,4))
                        <a href="{{ URL::to('downloadExcel/xls/Boxes/?arr[]='.$arr.'') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>
                    @endif

                    </div>

                </div>
                @if (Session::has('invalid_format'))
                        <p class="alert alert-danger">{{Session('invalid_format')}}</p>
                @endif

                <div class="row m-3 justify-content-center ">
                    <div class="col-lg-10 p ">

                        <table class="table zadnatable"  >
                        <!--  id="BoxDataTable"  -->
                            <thead>
                                <tr>
                                    <th>كود المربع</th>
                                    <th>عدد الصفوف</th>
                                    <th>عدد الاعمدة</th>
                                    <th> العمليات</th>
                                    
                                </tr>
                            </thead>
                           
                    <tbody>
                    <?php global $boxes ; ?>
            @foreach ($boxes as $boxes)
                <tr>
                    <td>{{$boxes->code}}</td>
                    <td>{{$boxes->row_count}}</td>
                   <td>{{$boxes->column_count}}  </td>
                 
                  <td>
                   
                  <a href="{{route('boxes.edit',$boxes->id)}}"><i class="fa fa-eye"></i></a>










                  </td>
                </tr>
            </tbody>
            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- add type   -->
 <div class="modal fade" id="add-kind" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalbg-add">
            <div class="modal-header header-border">
                <h5 class="modal-title" id="exampleModalLongTitle2">اضافة صنف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <div class="form-group center">

                    <input type="text" id="name-text-kind" class="textStyle">
                </div>

            </div>
            @if($healper->check_permission(2,1))
                <div class="modal-footer footer-border">
                    <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="add-item">اضافة</button>
                </div>
            @endif
        </div>
    </div>
</div>


</section>
@endsection
