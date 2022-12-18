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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
             {{__('admin.comments_list')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/admin/comments_trash'}}"
                               class="btn btn-success">{{__('admin.recovery')}}</a>
                        </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>{{__('admin.post')}}</th>
                            <th>{{__('admin.text')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$comment->title}}</td>
                                <td>{{$comment->text}}
                                </td>
                                <td>
                                    @if($comment->status == 1)
                                        <form action="{{env('APP_URL').'/admin/comments/toggle/'.$comment->id}}" method="get">
                                            <button type="submit" >
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{env('APP_URL').'/admin/comments/toggle/'.$comment->id}}" method="get">
                                            <button type="submit" >
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                    {{Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'delete'])}}
                                    <button onclick="return confirm('{{__('admin.are_you_sure')}}')" type="submit" class="delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {{Form::close()}}
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
    </script>
@endsection
