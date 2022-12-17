@extends('admin.layouts')

@section('style')
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/bootstrap/css/bootstrap.min.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/font-awesome/4.5.0/css/font-awesome.min.css'}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/ionicons/2.0.1/css/ionicons.min.css'}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/AdminLTE.min.css'}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/skins/_all-skins.min.css'}}">
    <!-- Button style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.hello').', '. \Illuminate\Support\Facades\Auth::user()->name}}!
            </h1>
            <small><font color="red"> @if(\Illuminate\Support\Facades\Auth::user()->email_verified_at==null)
                        {{__('admin.limited_mode')}}
                    @endif</font></small>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                @if(\Illuminate\Support\Facades\Auth::user()->email_verified_at==null)
                    <div class="box-header with-border">
                        {!! __('admin.you_need_to_confirm') !!}
                        <form action="/email/verification-notification" method="post">
                            @csrf
                            <input type="hidden" name="user" value="{{\Illuminate\Support\Facades\Auth::user()}}">
                            <input type="submit" value="Repeat send">
                        </form>
                        <p><font color="red">{{$status??''}}</font></p>
                    </div>
                @endif
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('rule.rule')}}</h3>
                </div>
                {!! __('rule.text_rule') !!}
                <!-- /.box-body -->
                <div class="box-footer">
                    <p><font color="red">{{__('rule.rule_warning')}}</font></p>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <!-- jQuery 2.2.3 -->
    <script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{env('APP_URL').'/assets/bootstrap/js/bootstrap.min.js'}}"></script>
    <!-- SlimScroll -->
    <script src="{{env('APP_URL').'/assets/plugins/slimScroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL').'/assets/plugins/fastclick/fastclick.js'}}"></script>
    <!-- AdminLTE App -->
    <script src="{{env('APP_URL').'/assets/dist/js/app.min.js'}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{env('APP_URL').'/assets/dist/js/demo.js'}}"></script>
@endsection
