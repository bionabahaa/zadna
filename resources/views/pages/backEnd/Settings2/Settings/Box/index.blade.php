@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script>
    var operation_page=0;
</script>
<script src="{{ asset('public') }}/js/backEnd/box.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<!--بدايه اصناف المحصول-->
<section class="content cropType">
<section class="content cropType">
    <div class="top-bar">
        <h6>اعدادات عامه >مربعات</h6>
    </div>
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>توقيع مربعات</label>
        </div>

        <div col-lg-3>
            <!--        <input type="file" class="upload-excel mr-2 mb-2 " >-->
            <div class="button-cont">
                <form id="form_upload" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="box_signature" />
                    <input type="file" data-id="form_upload" name="file" id="file-1" class="inputfile inputfile-1 upload" data-multiple-caption="{count} files selected"
                         />
                    <label for="file-1">
                        <span>تحميل ملف&hellip;</span>
                    </label>
                        <a target="_blank" href="{{ $bath.'/'.@$box_signature->value }}" id="uploaded_file">الملف</a>
                </form>


            </div>

        </div>
    </div>
    <div class="row m-4">
        <div class="col-lg-2 mt-2">
            <label>خريطة الارض</label>
        </div>

        <div col-lg-3>
            <div class="button-cont">
                <form id="form_upload2" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name" value="map_earth" />
                    <input type="file" name="file" data-id="form_upload2" id="file-10"  class="inputfileEnter inputfile inputfile-1 upload" data-multiple-caption="{count} files selected"
                    />
                    <label for="file-10">
                        <span>رفع صورة&hellip;</span>
                    </label>
                        <a target="_blank" href="{{ $bath.'/'.@$map_earth->value }}" id="uploaded_file">الملف</a>
                </form>
            </div>
        </div>
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
                    <button class="add-crepto mr-2 mb-2 addNewRow" onclick="window.location.href='{{ url('setting/boxes/create/') }}'">أضافة مربع</button>
                    <button class="upload-excel mr-2 mb-2 ">أدخال عن طريق ملف</button>
                    <button class="export-excel mr-2 mb-2">أخراج كملف اكسيل</button>
                </div>

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 p ">

                    <table class="table zadnatable" id="BoxDataTable">
                        <thead>
                            <tr>
                                <th>كود المربع</th>
                                <th>عدد الصفوف</th>
                                <th>عدد الاعمدة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
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
            <div class="modal-footer footer-border">

                <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="add-item">اضافة</button>
            </div>
        </div>
    </div>
</div>


@endsection