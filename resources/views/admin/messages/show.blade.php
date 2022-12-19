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
            <form action="{{env('APP_URL').'/admin/message_getAnswer'}}" method="post">
                <input type="hidden" name="name" value="{{$message->name}}">
                <input type="hidden" name="title" value="{{$message->title}}">
                <input type="hidden" name="email" value="{{$message->email}}">
                <input type="hidden" name="content" value="{{$message->content}}">
                @csrf
                <button class="btn btn-warning pull-left"> {{__('admin.answer')}}</button>
            </form>
            <br>
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
        $.ajax({
                url: "{{env('APP_URL').'/admin/messages/'.$message->id}}",
                type: "put",
                data: $('form').serialize(),
            }
        )
    </script>
@endsection
