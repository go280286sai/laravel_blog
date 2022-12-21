@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
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
                        <a href="{{env('APP_URL').'/admin/categories/create'}}"
                           class="btn btn-success">{{__('admin.add')}}</a>
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
                                    {{Form::open(['url'=>env('APP_URL').'/admin/categories/'.$category->id.'/edit/', 'method'=>'get'])}}
                                    {{Form::button('<i class="fa fa-bars"></i>', ['title'=>__('admin.edit'), 'class'=>'btn', 'type'=>'submit'])}}
                                    @csrf
                                    {{Form::close()}}
                                    {{Form::open(['url'=>env('APP_URL').'/admin/categories/'.$category->id, 'method'=>'delete'])}}
                                    {{Form::button('<i class="fa fa-trash"></i>', ['title'=>__('admin.delete'), 'class'=>'btn', 'type'=>'submit'])}}
                                    @csrf
                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
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
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
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
