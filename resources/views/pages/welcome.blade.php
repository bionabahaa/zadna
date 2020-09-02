@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
{{--  <script src="{{ asset('public') }}/js/backEnd/category.js"></script>  --}}
@endsection
@section('page_header')
<div class="row">
    <div class="col-md-6">
        <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-block btn-lg waves-effect">
            <i class="material-icons">home</i>
            <span>إضافه جديده</span>
        </a>
    </div>
</div>


@endsection
@section('page_content')
@inject('healper', 'App\Http\Controllers\BladeController')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example" id="CategoryDataTable">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>العنوان</th>
                            <th>الميزانيه الشبكيه</th>
                            <th>مضافه بتاريخ</th>
                            <th>الاعدادات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>الكود</th>
                            <th>العنوان</th>
                            <th>الميزانيه الشبكيه</th>
                            <th>مضافه بتاريخ</th>
                            <th>الاعدادات</th>
                        </tr>
                        <tr>
                                <th>الكود</th>
                                <th>العنوان</th>
                                <th>الميزانيه الشبكيه</th>
                                <th>مضافه بتاريخ</th>
                                <th>الاعدادات</th>
                            </tr>
                            <tr>
                                    <th>الكود</th>
                                    <th>العنوان</th>
                                    <th>الميزانيه الشبكيه</th>
                                    <th>مضافه بتاريخ</th>
                                    <th>الاعدادات</th>
                                </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
