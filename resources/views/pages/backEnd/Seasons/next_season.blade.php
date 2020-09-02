
@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script src="{{ asset('public') }}/js/backEnd/season.js"></script>
    @if(!empty($open_model) && $open_model == true)
        <script>
            $(function() {
                $('#editModal').modal('show');

            });
        </script>
    @endif
@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')
    <section class="content cropType">
        <div class="top-bar">
            <h6> المواسم >  الموسم القادم   </h6>
            <input type="hidden" id="view_name" value="{{@$view_name}}">
        </div>
        <div class="Tparent" >

            @if($healper->check_permission(38,2))
            <div class="row ml-3 mr-3 mt-3 p-3 filter-search-box">
                <div class="col-lg-10">
                    <div class="row filter-res">
                        <div class="col-lg-8 col-sm-12 col-md-12 col-12">
                            <div >
                                <label> تاريخ البداية :</label>
                            </div>
                            <form id="form_filter_date" method="post">
                            من <input type="date" id="from" name="season_start_filter" class="type-date">
                            الى <input type="date" id="to" name="season_end_filter" value="{{old('season_end_filter')}}" class="type-date" id="date">
                            </form>
                        </div>
                    </div>
                </div>
                <span class="btn btn-dark filter_but" style="height: 45px;border-radius: 21%;" onclick="filter('SeasonDataTable','setting/data_seasons/next_season')" >بحث</span>
            </div>
            @endif

            <div class="row m-4">
@if(!isset($open_model) )

                <div class="float-left">

                    @if($healper->check_permission(38,3))
                       <button class="add-crepto mr-2 mb-2  " data-toggle="modal" data-target="#exampleModalLong">أضافة </button>
                    @endif
                </div>
 @endif

            </div>

            <div class="row m-3 justify-content-center ">
                <div class="col-lg-10 ">

                    <table class="table zadnatable" id="SeasonDataTable">
                        <thead >
                        <tr >
                            <th>الكود</th>
                            <th>الاسم</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th ><i class="fas fa-bars"></i></th>

                        </tr>
                        </thead>

                    </table></div>




            </div>
            <form id="form_edit_season" method="post">
                <input type="hidden" name="id" id="id" @if(isset($season)) value="{{$season->id}}"   @endif>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" viewrow>
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


                                        <th scope="col">الاسم</th>
                                        <th scope="col"> بداية الموسم</th>
                                        <th scope="col">نهاية الموسم</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="InputNum">
                                            <div class="form-group InputGroup">
                                                <input type="text" name="title" @if(isset($season)) value="{{$season->title}}" @endif class="form-control numric edit-type" min="0" style="width: unset;">
                                                <input type="hidden" name="id" id="id" @if(isset($season)) value="{{$season->id}}"   @endif>
                                            </div>
                                        </td>

                                        <td class="InputNum"><div class="form-group InputGroup">
                                                {{--<div>--}}
                                                  <input type="date" name="season_start" @if(isset($season)) value="{{$season->season_start}}" @endif class="form-control numric edit-type" style="width: unset;">
                                               </div>
                                            <div id="season_start_demo"></div>
                                        </td>


                                        <td class="InputNum"><div class="form-group InputGroup">
                                                <input type="date" name="season_end"  @if(isset($season)) value="{{$season->season_end}}" @endif  class="form-control numric edit-type" style="width: unset;" >

                                            </div>
                                            <div id="season_end_demo"></div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer footer-border">

                            <button type="button" class="btn  save-btn save-edit SubmitButton" data-dismiss="modal" >حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>



        </div>
        <!--نهايه اصناف المحصول--><!-- basic Modal -->

        <form id="form_create_season" method="post">
            <input type="hidden" name="id" id="id" value="">
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" viewrow>
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
                                    <th scope="col">الاسم</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td class="InputNum">
                                        <div class="form-group InputGroup">
                                            <input type="text" name="title" class="form-control numric " min="0" style="width: unset;">
                                        </div>
                                        <div id="title_demo"></div>
                                    </td>

                                </tr>

                                </tbody>
                            </table>


                            <table class="table tableborder">

                                <thead>
                                <tr>

                                    <th scope="col"> بداية الموسم</th>
                                    <th scope="col">نهاية الموسم</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td class="InputNum"><div class="form-group InputGroup">
                                            <input type="date" name="season_start" class="form-control numric " style="width: unset;">

                                        </div>
                                        <div id="season_start_demo"></div>
                                    </td>
                                    <td class="InputNum"><div class="form-group InputGroup">
                                            <input type="date" name="season_end" class="form-control numric " style="width: unset;" >

                                        </div>
                                        <div id="season_end_demo"></div>
                                    </td>


                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer footer-border">
                        <button type="button" class="btn close-btn" data-dismiss="modal">غلق</button>
                        <button type="button" class="btn save-btn SubmitButton " >بداية</button>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </section>



@endsection