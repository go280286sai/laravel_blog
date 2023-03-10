@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.edit_tag')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/admin/tags/'.$tag->id}}" method="post">@method('PUT')
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="title"
                                       value="{{$tag->title}}">
                                @csrf
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="window.history.back()">{{__('admin.back')}}</button>
                        <input type="submit" class="btn btn-warning pull-right" value="{{__('admin.edit')}}">
                    </div>
                    <!-- /.box-footer-->
                </form>
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
