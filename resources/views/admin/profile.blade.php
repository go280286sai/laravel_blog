@extends('admin.layouts')

@section('text')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="leave-comment mr0"><!--leave comment-->
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                @include('admin.errors')
                <br>
                <img src="{{$user->getAvatar()}}" alt="" class="profile-image" width="200px">
                <form class="form-horizontal contact-form" role="form" method="post" action="/admin/profile"
                      enctype="multipart/form-data">
                    <br>
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="name"></label><input type="text" class="form-control" id="name" name="name"
                                                             placeholder="{{__('admin.name')}}" value="{{$user->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="birthday"></label><input type="date" class="form-control" id="birthday"
                                                                 name="birthday"
                                                                 placeholder="{{__('admin.date')}}"
                                                                 value="{{$user->birthday}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="phone"></label><input type="number" class="form-control" id="phone" name="phone"
                                                              placeholder="{{__('admin.phone_number')}}"
                                                              value="{{$user->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-control">
                                <input class="form-check-input" type="radio" name="gender_id"
                                       id="flexRadioDefault1"
                                       value="1" {{($user->gender_id=='1')?'checked':''}}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{__('admin.gender_male')}}
                                </label>
                            </div>
                            <div class="form-control">
                                <input class="form-check-input" type="radio" name="gender_id"
                                       id="flexRadioDefault2" value="2"
                                    {{($user->gender_id=='2')?'checked':''}}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    {{__('admin.gender_female')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">{{__('admin.about')}}</label>
                            <label for=""></label><textarea name="myself" id="" cols="30" rows="10"
                                                            class="form-control">{{$user->myself}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="password"></label><input type="password" class="form-control" id="password"
                                                                 name="password"
                                                                 placeholder="{{__('admin.new_password')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="file" class="form-control" id="image" name="avatar">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{__('admin.update')}}</button>
                </form>
            </div><!--end leave comment-->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection
