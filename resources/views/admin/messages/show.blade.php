@extends('admin.layouts')
@section('style')
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/bootstrap/css/bootstrap.min.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/font-awesome/4.5.0/css/font-awesome.min.css'}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/ionicons/2.0.1/css/ionicons.min.css'}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/AdminLTE.min.css'}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/skins/_all-skins.min.css'}}">
    <!-- Button style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Darker background on mouse-over */
        .btn:hover {
            background-color: #8aa4af;
        }
    </style>
@endsection
@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              {{__('admin.email')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="#">
                        <div class="box-header with-border">
                            @include('admin.errors')
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.name')}}</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                           name="name" value="{{$message->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                           name="title" value="{{$message->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.email')}}</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                           name="email" value="{{$message->email}}">
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.text')}}</label>
                                    <textarea id="" cols="30" rows="10" class="form-control"
                                              name="content">{{$message->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default"
                                    onclick="window.history.back()">{{__('admin.back')}}</button>

                        </div>
                    </form>
                    <form action="{{env('APP_URL').'/admin/message_getAnswer'}}" method="post">
                        <input type="hidden" name="name" value="{{$message->name}}">
                        <input type="hidden" name="title" value="{{$message->title}}">
                        <input type="hidden" name="email" value="{{$message->email}}">
                        <input type="hidden" name="content" value="{{$message->content}}">
                        @csrf
                        <button class="btn btn-warning pull-right"> {{__('admin.edit')}}</button>
                    </form>

                </div>
                <!-- /.box-body -->
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
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <!-- SlimScroll -->
    <script src="{{env('APP_URL').'/assets/plugins/slimScroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL').'/assets/plugins/fastclick/fastclick.js'}}"></script>
    <!-- AdminLTE App -->
    <script src="{{env('APP_URL').'/assets/dist/js/app.min.js'}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{env('APP_URL').'/assets/dist/js/demo.js'}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
        $(document).ready(function () {
            console.log($('#del_cat'))
        })
        $.ajax({
            url: "{{env('APP_URL').'/admin/messages/'.$message->id}}",
            type: "put",
            data: $('form').serialize(),
            }
        )
    </script>
@endsection
