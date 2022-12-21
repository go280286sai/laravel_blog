@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.add_category')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                {{Form::open(['url'=>env('APP_URL').'/admin/categories', 'method'=>'POST'])}}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('admin.name')}}</label>
                            {{Form::text('title', '', ['class'=>"form-control", 'id'=>"exampleInputEmail1" ])}}
                            @csrf
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{Form::button(__('admin.back'), ['class'=>'btn btn-default', 'onclick'=>"window.history.back()"])}}
                    {{Form::submit(__('admin.add'), ['name'=> 'submit', 'class'=>"btn btn-warning pull-right"])}}
                </div>
                {{Form::close()}}
                <!-- /.box-footer-->
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
