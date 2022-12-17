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
    <!-- Button style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .btn:hover {
            background-color: #8aa4af;
        }
    </style>
@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.list_posts')}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <table><tr>
                                <td> <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="recover_all">
                                        <button title="Восстановить все записи?" onclick="return confirm('are you sure?')"
                                                class="btn btn-success"><i>{{__('admin.recovery_all')}}</i></button>
                                    </form></td>
                                <td> | </td>
                                <td> <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="trash_all">
                                        <button title="Удалить все записи?" onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                class="btn btn-success"><i>{{__('admin.delete_all')}}</i></button>
                                    </form></td></tr></table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.title')}}</th>
                            <th>{{__('admin.text')}}</th>
                            <th>{{__('admin.user')}}</th>
                            <th>{{__('admin.date_of_registration')}}</th>
                            <th>{{__('admin.date_of_delete')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trash as $item)
                            @if($item->user->name??false)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    {{$item->title}}
                                </td>
                                <td> {{$item->user->name??__('admin.user_delete')}}</td>
                                <td>{{date_format($item->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    {{date_format($item->deleted_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="recover">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button title="{{__('admin.recovery')}}?" onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                class="btn"><i
                                                class="fa fa-bars"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="trash">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button title="{{__('admin.delete_permanently')}}" onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                class="btn"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-default" onclick="window.history.back()">{{__('admin.back')}}</button>
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
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
