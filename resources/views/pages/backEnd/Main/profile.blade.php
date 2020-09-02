@extends('layouts.backEnd')
@section('page_css')
@endsection
@section('page_script')
<script src="{{ asset('public') }}/js/backEnd/mission.js"></script>
@endsection
@section('page_header')
@endsection
@section('page_content')
<section class="content cropType">
        <div class="top-bar">
            <h6><i class="fas fa-user-circle mr-2"></i> اسم المستخدم</h6>
        </div>
        <div class="Tparent">
            <div class="row m-3  mt-5 justify-content-center">
                <div class="col-4 form-container">
                    <form>
                        <div class="form-group">
                            <label for="user-name">الاسم بالكامل</label>
                            <input type="text" name="title" value="{{ $info->username }}" class="form-control" id="user-name">
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" value="{{ $info->email }}" class="form-control" id="email" placeholder="name@example.com">
                        </div>
                        {{-- <div class="form-group">
                            <label for="pass">الرقم السري</label>
                            <input type="password" class="form-control" id="pass">
                        </div> --}}
                        <div class="form-group">
                            <label for="position">الوظيفه</label>
                                <select class="form-control" id="position" disabled>
                                    <option>{{ $info->role_title }}</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="type">نوع المستخدم</label>
                            <select class="form-control" value="{{ $info->type_title }}"  id="type" disabled>
                <option>دائم</option>

              </select>
                        </div>

                        {{-- <button type="submit" class="btn save-btn ">حفظ</button> --}}



                    </form>
                </div>

            </div>


        </div>

    </section>

@endsection