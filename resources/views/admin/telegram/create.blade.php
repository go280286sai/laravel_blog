@extends('admin.layouts')

@section('style')
@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.add')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/admin/telegram_send'}}" method="post" enctype=multipart/form-data>
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
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.text')}}</label>
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="content"></textarea>
                            </div>
                            <label for="exampleInputEmail1">{{__('admin.send_photo')}}</label>
                            <div class="form-group">
                                <input type="file" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="photo">
                            </div>
                            <label for="exampleInputEmail1">{{__('admin.send_doc')}}</label>
                            <div class="form-group">
                                <input type="file" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="doc">
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
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection
