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
              {{__('admin.categories')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/admin/categories/create'}}" class="btn btn-success">{{__('admin.add')}}</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.name')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$category->title}}</td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/categories/'.$category->id.'/edit/'}}"
                                          method="get">
                                        @csrf
                                        <button class="btn"><i class="fa fa-bars"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/categories/'.$category->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('{{__('admin.are_you_sure')}}')" class="btn"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
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
    </script>
@endsection
