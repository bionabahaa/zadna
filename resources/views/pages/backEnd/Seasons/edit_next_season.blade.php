@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
    <script src="{{ asset('public') }}/js/backEnd/season.js"></script>

@endsection
@section('page_header')
@endsection
@section('page_content')
    @inject('healper', 'App\Http\Controllers\BladeController')

    <section class="content cropType">
        <div class="top-bar">
            <h6> المواسم >  الموسم القادم >  تعديل  </h6>
            <input type="hidden" id="view_name" value="{{@$view_name}}">
        </div>
        <div class="Tparent" >
            <form id="form_edit_season" method="post">
                <input type="hidden" name="id" id="id" @if(isset($season)) value="{{$season->id}}"   @endif>
                            <div>
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
                                                </div>
                                                <div id="title_demo"></div>
                                            </td>
                                            <td class="InputNum"><div class="form-group InputGroup">
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
                                @if($healper->check_permission(38,5))
                                <button type="button" class="btn  save-btn save-edit SubmitButton" data-dismiss="modal" >تعديل</button>
                                @endif
                            </div>



            </form>



        </div>


    </section>


@endsection