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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.add_post')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/admin/posts'}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="title" value="{{old('title')}}">
                                @csrf
                            </div>
                            <div class="form-group">
                                <input type="file" id="exampleInputFile" name="image">
{{--                                <p class="help-block">Какое-нибудь уведомление о форматах..</p>--}}
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.category')}}</label>
                                {{Form::select('category_id',
                                    $categories,
                                    null,
                                    ['class' => 'form-control select2'])
                                }}
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.tags')}}</label>
                                {{Form::select('tags[]',
                                    $tags,
                                    null,
                                    ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>__("admin.select_tags")])
                                }}
                            </div>
                            <!-- Date -->
                            <div class="form-group">
                                <label>{{__('admin.date')}}:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="s_date"
                                           value="{{old('s_date')}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="is_featured">
                                </label>
                                <label>
                                    {{__('admin.recommend')}}
                                </label>
                            </div>
                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="status" checked  value="1" {{\Illuminate\Support\Facades\Auth::user()->email_verified_at??'disabled'}}>
                                </label>
                                <label>
                                    {{__('admin.draft')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.description')}}</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.content')}}</label>
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="window.history.back()"> {{__('admin.back')}}</button>
                        <button class="btn btn-warning pull-right"> {{__('admin.add')}}</button>
                    </div>
                </form>       <!-- /.box-footer-->
            </div>

            <!-- /.box -->

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
