@extends('admin.layouts')
@section('style')
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/bootstrap/css/bootstrap.min.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/font-awesome/4.5.0/css/font-awesome.min.css'}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/ionicons/2.0.1/css/ionicons.min.css'}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/iCheck/all.css'}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datepicker/datepicker3.css'}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/select2/select2.min.css'}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/AdminLTE.min.css'}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/skins/_all-skins.min.css'}}">
@endsection

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
                            <label for="birthday"></label><input type="date" class="form-control" id="birthday" name="birthday"
                                                                 placeholder="{{__('admin.date')}}" value="{{$user->birthday}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="phone"></label><input type="number" class="form-control" id="phone" name="phone"
                                                              placeholder="{{__('admin.phone_number')}}" value="{{$user->phone}}">
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
                            <label for=""></label><textarea name="myself" id="" cols="30" rows="10" class="form-control">{{$user->myself}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="password"></label><input type="password" class="form-control" id="password" name="password"
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
    <!-- jQuery 2.2.3 -->
    <script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{env('APP_URL').'/assets/bootstrap/js/bootstrap.min.js'}}"></script>
    <!-- Select2 -->
    <script src="{{env('APP_URL').'/assets/plugins/select2/select2.full.min.js'}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{env('APP_URL').'/assets/plugins/datepicker/bootstrap-datepicker.js'}}"></script>
    <!-- SlimScroll -->
    <script src="{{env('APP_URL').'/assets/plugins/slimScroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL').'/assets/plugins/fastclick/fastclick.js'}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{env('APP_URL').'/assets/plugins/iCheck/icheck.min.js'}}"></script>
    <!-- AdminLTE App -->
    <script src="{{env('APP_URL').'/assets/dist/js/app.min.js'}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{env('APP_URL').'/assets/dist/js/demo.js'}}"></script>
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
