@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/disease.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    <section class="content cropType">
        <div class="top-bar">

            <h6> الامراض > سجل الامراض </h6>
        </div>
        <div class="Tparent">
            @if($healper->check_permission(43,2))
              <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box ">
                <div class="col-lg-10">

                    <div class="row filter-res">

                        <div class="col-lg-2 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>حالة المرض:</label>
                            </div>
                            <select name="type" id="type" class="form-control filter-form filter1">
                                <option value="all">الكل</option>
                                <option value="1"> تم شفائه بنسبه</option>
                                <option value="2"> تم فقده</option>
                            </select>
                        </div>

                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div>
                                <label>فترة الاصابه :</label>
                            </div>
                            من <input  name="from" id="from" type="date" class="type-date">
                            الى <input name="to" id="to"  type="date" class="type-date">
                        </div>
                    </div>
                </div>
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter_diseaseRecord('DataTable_DiseaseRecord')" >بحث</span>
            </div>
            @endif
                @if($healper->check_permission(43,3))
            <div class="row m-4">
                <div class="float-left ">
                    <a href="{{ URL::to('downloadExcel/xls/diseasePalmTree/disease_record') }}"><button class="btn btn-success export-excel mr-2 mb-2">أخراج كاملف اكسيل</button></a>

                </div>
            </div>
        @endif
            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table id="DataTable_DiseaseRecord" class="table zadnatable">
                        <thead>
                        <tr>
                            <th>الكود</th>
                            <th>اسم المرض </th>
                            <th>الوصف</th>
                            <th><i class="fas fa-bars"></i></th>

                        </tr>
                        </thead>
                        </table>
                </div>
            </div>
        </div>

    </section>
    <!-- add  Modal -->
    <div class="modal fade" id="exampleModalLong" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modalbg">
                <div class="modal-header modal-border">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-space">
                    <div class="table-responsive">

                        <table class="table tableborder">

                            <thead>
                            <tr>


                                <th scope="col">الوظيفة</th>
                                <th scope="col">العملية</th>
                                <th scope="col">المربعات</th>
                                <th scope="col">التليفون </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="InputNum"> <select class="form-control select2" style="width: 100%; height: 20%">
                                        <option>مهندس</option>
                                        <option>دكتور</option>
                                        <option>محاسب</option>
                                        <option>استشارى</option>
                                        <option>مبرمج</option>

                                    </select></td>
                                <td class="InputNum"> <select class="form-control select2" style="width: 100%;">
                                        <option>مهندس</option>
                                        <option>دكتور</option>
                                        <option>محاسب</option>
                                        <option>استشارى</option>
                                        <option>مبرمج</option>
                                    </select></td>

                                <td class="InputNum"> <select class="form-control select2" multiple="multiple"
                                                              style="width: 100%;">
                                        <option>مهندس</option>
                                        <option>دكتور</option>
                                        <option>محاسب</option>
                                        <option>استشارى</option>
                                        <option>مبرمج</option>
                                    </select></td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="number" class="form-control numric loc" min="0">

                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>


                        <table class="table tableborder">

                            <thead>
                            <tr>


                                <th scope="col">عدد ايام العمل </th>
                                <th scope="col">التكلفة باليوم </th>
                                <th scope="col">التكلفة الكلية </th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="number" class="form-control numric" min="0">

                                    </div>
                                </td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="number" class="form-control numric">

                                    </div>
                                </td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="number" class="form-control numric" min="0">

                                    </div>
                                </td>



                            </tr>

                            </tbody>
                        </table>


                        <table class="table tableborder">

                            <thead>
                            <tr>

                                <th scope="col">تاريخ التعين </th>
                                <th scope="col">تاريخ الميلاد </th>
                                <th scope="col"> مسئول عن</th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="date" class="form-control numric">

                                    </div>
                                </td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <input type="date" class="form-control numric">

                                    </div>
                                </td>
                                <td class="InputNum">
                                    <div class="form-group InputGroup">
                                        <select id="tags" class="form-control select2" multiple="multiple"
                                                data-placeholder="Select a State" style="width: 100%;">
                                            <option>احمد</option>
                                            <option>منى</option>
                                            <option>ياسمين</option>
                                            <option>اميره</option>
                                            <option>جهاد</option>
                                            <option>شيماء</option>
                                            <option>على</option>
                                        </select>
                                    </div>
                                </td>



                            </tr>

                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="modal-footer footer-border">
                    <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                    <button type="button" class="btn save-btn" id="saveMatrial">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- model for add type -->
    <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modalbg-add">
                <div class="modal-header header-border">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافة نوع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="form-group center">

                        <input type="text" id="name-text" class="textStyle name-text">
                    </div>

                </div>
                <div class="modal-footer footer-border">

                    <button type="button" class="btn add-btn" data-dismiss="modal" aria-label="Close" value="اضافه" id="addgroup">اضافة</button>
                </div>
            </div>
        </div>
    </div>

    <div id="temodal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalbg-add">
                <div class="modal-header d-flex flex-row-reverse">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title ">حذف</h4>
                </div>
                <div class="modal-body">
                    <p>حذف نوع محصول؟</p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYes" data-dismiss="modal" class="danger btn btn-primary ">نعم</a>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger ">لا</a>
                </div>
            </div>

        </div>
    </div>



@endsection