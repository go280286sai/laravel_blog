@extends('layout')

@section('style')
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
                        <form class="form-horizontal contact-form" role="form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="email"></label>
                                        <input type="text" value="{{old('email')}}" class="form-control" id="email"
                                                                          name="email"
                                                                          placeholder="{{__('messages.email')}}">
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
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/map.js'}}"></script>
@section('js')
@endsection
