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
                    <form action="{{env('APP_URL').'/admin/message_sendMailing'}}" method="post">
                        <div class="box-header with-border">
                            @include('admin.errors')
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                           name="title">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mailing" id="flexRadioDefault2" value="for_users" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{__('admin.for_users')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mailing" id="flexRadioDefault2" value="for_subscription">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{__('admin.for_subscription')}}
                                    </label>
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('admin.text')}}</label>
                                    <textarea id="" cols="30" rows="10" class="form-control"
                                              name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default"
                                    onclick="window.history.back()">{{__('admin.back')}}</button>
                            <button class="btn btn-warning pull-right"> {{__('admin.send')}}</button>
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
    </script>
@endsection
