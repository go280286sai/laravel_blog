@extends('admin.layouts')

@section('text')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="leave-comment mr0"><!--leave comment-->
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                @include('admin.errors')
                <br>
                <img src="{{$user->getAvatar()}}" alt="" class="profile-image" width="200px">
                {{Form::open(['url'=>'/admin/profile', 'method'=>'post', 'class'=>'orm-horizontal contact-form', 'files'=>true])}}
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::label('name', ' ')}}
                        {{Form::text($name='name', $value=$user->name, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>__('admin.name')])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::label('birthday', ' ')}}
                        {{Form::date($name='birthday', $value=$user->birthday, ['class'=>'form-control', 'id'=>'birthday', 'placeholder'=>__('admin.date')])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::label('phone', ' ')}}
                        {{Form::number($name='phone', $value=$user->phone, ['class'=>'form-control', 'id'=>'phone', 'placeholder'=>__('admin.phone_number')])}}
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-md-12">
                        <div class="form-control btn_top">
                            {{Form::radio($name='gender_id', $value=1, ($user->gender_id=='1')?'checked':'', ['class'=>'form-check-input ', 'id'=>'flexRadioDefault1'])}}
                            {{Form::label('flexRadioDefault1', __('admin.gender_male'), ['class'=>'form-check-label'])}}
                        </div>
                        <div class="form-control">
                            {{Form::radio($name='gender_id', $value=2, ($user->gender_id=='2')?'checked':'', ['class'=>'form-check-input', 'id'=>'flexRadioDefault2'])}}
                            {{Form::label('flexRadioDefault2', __('admin.gender_female'), ['class'=>'form-check-label'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::label('exampleInputEmail1', __('admin.about'))}}
                        <textarea name="myself" id="" cols="30" rows="10"
                                  class="form-control">{{$user->myself}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::label('password', ' ')}}
                        {{Form::password('password', ['class'=>'form-control', 'id'=>'password', 'placeholder'=>__('admin.new_password')])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::file('avatar', ['id'=>'image', 'class'=>'form-control btn_top'])}}

                    </div>
                    {{Form::submit($value=__('admin.update'), ['class'=>'btn btn-success btn_top'])}}
                </div>



                        {{Form::close()}}
            </div>
            <!--end leave comment-->
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
