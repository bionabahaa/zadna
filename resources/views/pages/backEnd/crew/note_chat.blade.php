@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
    <script>
        var operation_page=1;
        $(function () {
            $(".select2").select2();
        });
    </script>

    <script src="{{ asset('public') }}/js/backEnd/crew.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')


    <div class="tab-pane fade" id="notes-chat" role="tabpanel" aria-labelledby="notes-tab" style="border-right: 1px solid #dee2e6;border-left: 1px solid #dee2e6;">

        <div class="container">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="panel panel-primary">

                        <div class="panel-body">
                            <ul class="chat p-2">

                                <li class=" clearfix rec">

                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted float-right">
                                                <span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                            <strong class="primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>

                                <li class=" clearfix sent">

                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font float-right">Jack Sparrow</strong>
                                            <small class="text-muted">
                                                <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                        </div>
                                        <p class="float-right">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>


                                <li class="clearfix rec">

                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted float-right">
                                                <span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                            <strong class="primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix sent">

                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font float-right">Jack Sparrow</strong>
                                            <small class="text-muted">
                                                <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                        </div>
                                        <p class="float-right">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group mt-2">
                                                    <span class="input-group-btn">

                                                        <button class="btn btn-warning btn-md " id="btn-chat">
                                                            إرسال</button>

                                                    </span>
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="ادخل رسالتك هنا.." />

                                <button class="btn btn-danger btn-md " id="notes-back">
                                    رجوع</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection