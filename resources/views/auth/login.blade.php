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
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="leave-comment mr0">
                        <!--leave comment-->
                        @if(session('status'))
                            <div class="alert alert-danger">
                                {{session('status')}}
                            </div>
                        @endif
                        <h3 class="text-uppercase">{{ __('messages.login') }}</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="{{ route('login') }}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="email"></label><input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"
                                                                      placeholder="{{ __('messages.email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="password"></label><input type="password" class="form-control" id="password" name="password"
                                                                         placeholder="{{ __('messages.password') }}">
                                </div>
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"  name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('messages.remember_me') }}</span>
                                </label>
                            </div>
                            <div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('messages.forgot_your_password') }}
                                    </a>
                                @endif
                                    <button type="submit" class="btn send-btn">{{__('messages.login')}}</button>
                            </div>
                        </form>
                    </div>
                    <!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
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
