@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{__('admin.tags')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/admin/tags/create'}}"
                           class="btn btn-success">{{__('admin.add')}}</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.title')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->title}}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/tags/'.$item->id.'/edit/'}}"
                                          method="get">
                                        @csrf
                                        <button class="btn"><i class="fa fa-bars" title="{{__('admin.edit')}}"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/tags/'.$item->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button title="{{__('admin.delete')}}"
                                                onclick="return confirm('{{__('admin.are_you_sure')}}')" class="btn"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
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
    </script>
@endsection
