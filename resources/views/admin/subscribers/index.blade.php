@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.list_subscriptions')}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/admin/subscribers/create'}}" class="btn btn-success">{{__('admin.add')}}</a>
                        <a href="{{env('APP_URL').'/admin/subscribers_trash'}}" class="btn btn-success">{{__('admin.recovery')}}</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.email')}}</th>
                            <th>{{__('admin.date_of_registration')}}</th>
                            <th>{{__('admin.status')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subs as $sub)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$sub->email}}
                                </td>
                                <td>{{date_format($sub->created_at, 'd-m-Y')}}
                                </td>
                                <td>{!! $sub->token?"<font class='red'>no active</font>":"<font class='green'>active</font>" !!}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/subscribers/'.$sub->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button title="{{__('admin.delete')}}" onclick="return confirm({{__('admin.are_you_sure')}})" class="btn"><i
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
    </script>
@endsection
