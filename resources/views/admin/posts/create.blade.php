@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.add_post')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/admin/posts'}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                       name="title" value="{{old('title')}}">
                                @csrf
                            </div>
                            <div class="form-group">
                                <input type="file" id="exampleInputFile" name="image">
{{--                                <p class="help-block">Какое-нибудь уведомление о форматах..</p>--}}
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.category')}}</label>
                                {{Form::select('category_id',
                                    $categories,
                                    null,
                                    ['class' => 'form-control select2'])
                                }}
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.tags')}}</label>
                                {{Form::select('tags[]',
                                    $tags,
                                    null,
                                    ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>__("admin.select_tags")])
                                }}
                            </div>
                            <!-- Date -->
                            <div class="form-group">
                                <label>{{__('admin.date')}}:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="s_date"
                                           value="{{now()->format('d/m/Y')}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="is_featured">
                                </label>
                                <label>
                                    {{__('admin.recommend')}}
                                </label>
                            </div>
                            <!-- checkbox -->
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal" name="status" checked  value="1" {{\Illuminate\Support\Facades\Auth::user()->email_verified_at??'disabled'}}>
                                </label>
                                <label>
                                    {{__('admin.draft')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.description')}}</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.content')}}</label>
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="window.history.back()"> {{__('admin.back')}}</button>
                        <button class="btn btn-warning pull-right"> {{__('admin.add')}}</button>
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
