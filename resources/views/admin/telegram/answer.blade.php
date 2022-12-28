@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.send_message')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/admin/telegram_sendAnswer'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.chat_number')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       value="{{$chat_id}}" name="chat_id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> {{__('admin.message_number')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       value="{{$message_id}}" name="message_id">
                                <input type="hidden" name="id" value="{{$id}}">
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="exampleInputEmail1"> {{__('admin.text')}}</label>
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="window.history.back()"> {{__('admin.back')}}</button>
                        <input type="submit" class="btn btn-success pull-right" name="submit"
                               value=" {{__('admin.send')}}">
                    </div>
                </form>       <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
