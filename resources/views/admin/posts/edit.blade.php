@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               {{__('admin.edit')}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=>	['posts.update', $post->id],
            'files'	=>	true,
            'method'	=>	'put'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{__('admin.title')}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$post->title}}" name="title">
                        </div>

                        <div class="form-group">
                            <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="200">
                            <input type="file" id="exampleInputFile" name="image">

{{--                            <p class="help-block">Какое-нибудь уведомление о форматах..</p>--}}
                        </div>
                        <div class="form-group">
                            <label> {{__('admin.category')}}</label>
                            {{Form::select('category_id',
                                $categories,
                              $post->getCategoryID(),
                                ['class' => 'form-control select2'])
                            }}
                        </div>
                        <div class="form-group">
                            <label> {{__('admin.tags')}}</label>
                            {{Form::select('tags[]',
                                $tags,
                                $selectedTags,
                                ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>__("admin.select_tags")])
                            }}
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label> {{__('admin.date')}}:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" value="{{$post->s_date}}" name="s_date">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                {{Form::checkbox('is_featured', '1', $post->is_featured, ['class'=>'minimal'])}}
                            </label>
                            <label>
                                {{__('admin.recommend')}}
                            </label>
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name="status" {{\Illuminate\Support\Facades\Auth::user()->status??'checked'}} checked  {{\Illuminate\Support\Facades\Auth::user()->email_verified_at??'disabled'}}>
                            </label>
                            <label>
                                {{__('admin.draft')}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{__('admin.description')}}</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{$post->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> {{__('admin.content')}}</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" onclick="window.history.back()"> {{__('admin.back')}}</button>
                    <button class="btn btn-warning pull-right"> {{__('admin.edit')}}</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
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
