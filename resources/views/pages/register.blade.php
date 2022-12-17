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
                    <div class="leave-comment mr0">
                        <!--leave comment-->
                        <h3 class="text-uppercase">{{__('messages.register')}}</h3>
                        @include('admin.errors')
                        <br>
                        <p>{{$info??''}}</p>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/register">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name"></label><input type="text" class="form-control" id="name" name="name"
                                                                     placeholder="{{__('messages.name')}}" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="email"></label><input type="text" value="{{old('email')}}" class="form-control" id="email"
                                                                      name="email"
                                                                      placeholder="{{__('messages.email')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="password"></label><input type="password" class="form-control" id="password" name="password"
                                                                         placeholder="{{__('messages.password')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="password_confirmation"></label><input type="password" class="form-control" id="password_confirmation"
                                                                                      name="password_confirmation"
                                                                                      placeholder="{{__('messages.confirm_password')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">{{__('messages.register')}}</button>
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{__('messages.already_registered')}}
                            </a>
                        </form>
                        <div class="social"><a class="s-facebook social_item item" href="{{route('auth.facebook')}}"><i class="fa fa-facebook"></i></a>
                            <a class="ion-social-github social_item item" href="{{route('auth.github')}}"><i class="fa fa-github"></i></a>
                            <a class="s-linkedin social_item item" href="#"><i class="fa fa-linkedin"></i></a>
                            <a class="s-instagram social_item item" href="#"><i class="fa fa-instagram"></i></a></div>
                    </div><!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection

@section('js')
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery-1.11.3.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/bootstrap.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/owl.carousel.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery.stickit.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/map.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/menu.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/scripts.js'}}"></script>
@endsection
