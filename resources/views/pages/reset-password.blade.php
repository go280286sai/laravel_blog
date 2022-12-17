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
                    <div class="leave-comment mr0"><!--leave comment-->
                        <h3 class="text-uppercase">{{__('messages.remember_me_password')}}</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="POST"
                              action="{{ route('password.update') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <!-- Email Address -->
                            <div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="email"></label><input type="text"
                                                                          value="{{old('email', $request->email)}}"
                                                                          class="form-control" id="email"
                                                                          name="email"
                                                                          placeholder="{{__('messages.email')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="password"></label><input type="password" class="form-control"
                                                                             id="password"
                                                                             name="password"
                                                                             placeholder="{{__('messages.password')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="password"></label><input type="password" class="form-control"
                                                                             id="password"
                                                                             name="password_confirmation"
                                                                             placeholder="{{__('messages.confirm_password')}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">{{__('messages.send_password')}}</button>
                        </form>
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
    <script type="text/javascript">
        /* ==== google map ====*/
        function initialize() {
            let mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng(23.7893837, 90.38596079999999),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            };

            let map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

            let marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.7893837, 90.38596079999999),
            });

            marker.setMap(map);
            let infowindow = new google.maps.InfoWindow({
                content: "Our location!"
            });

            infowindow.open(map, marker);

        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/menu.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/scripts.js'}}"></script>
@endsection



