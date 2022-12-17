@extends('layout')
@section('style')
    <!-- common css -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/font-awesome.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/animate.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.carousel.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.theme.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.transitions.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/style.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/responsive.css'}}">

@endsection
@section('text')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <form action="{{env('APP_URL').'/contact'}}" method="post">
                            <div class="box-header with-border">
                                @include('admin.errors')
                                {{$info??''}}
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('admin.name')}}</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                               name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                               name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('admin.email')}}</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                               name="email">
                                    </div>
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('admin.text')}}</label>
                                        <textarea id="" cols="30" rows="10" class="form-control"
                                                  name="content">{{old('content')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button class="btn btn-default"
                                        onclick="window.history.back()">{{__('admin.back')}}</button>
                                <input type="submit" class="btn btn-success pull-right" name="submit"
                                       value="{{__('admin.send')}}">
                            </div>
                        </form>       <!-- /.box-footer-->
                    </div>


                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
@section('js')
    <!-- js files -->
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery-1.11.3.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/bootstrap.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/owl.carousel.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery.stickit.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/menu.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/scripts.js'}}"></script>
@endsection
