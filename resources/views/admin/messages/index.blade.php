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
              {{__('admin.email')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/admin/message_mailing_list'}}" class="btn btn-success">{{__('admin.add')}}</a>
                        <a href="{{env('APP_URL').'/admin/message_delete_all'}}" class="btn btn-success" onclick="return confirm('{{__('admin.are_you_sure')}}')">{{__('admin.delete_shows')}}</a>
                        <a href="{{env('APP_URL').'/admin/view_mailing'}}" class="btn btn-success" target="_blank">{{__('admin.template_mailing')}}</a>
                        <a href="{{env('APP_URL').'/admin/view_mailing_sub'}}" class="btn btn-success" target="_blank">{{__('admin.template_mailing_sub')}}</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.name')}}</th>
                            <th>{{__('admin.title')}}</th>
                            <th>{{__('admin.email')}}</th>
                            <th>{{__('admin.text')}}</th>
                            <th>{{__('admin.action')}}</th>
                            <th>{{__('admin.create_date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mails as $mail)
                            @if($mail->status==0)
                                <tr class="danger">
                            @else
                                <tr>
                            @endif
                                <td>
                                    {{$i++}}</td>
                                <td>{{$mail->name}}</td>
                                <td>{{$mail->title}}</td>
                                <td>{{$mail->email}}</td>
                                <td>{{substr($mail->content, 0, 100) }}</td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/messages/'.$mail->id}}"
                                          method="get">
                                        @csrf
                                        <button title="{{__('admin.show')}}" class="btn"><i class="fa fa-bars"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/messages/'.$mail->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button title="{{__('admin.delete')}}" onclick="return confirm('{{__('admin.are_you_sure')}}')" class="btn"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{$mail->created_at}}</td>
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
