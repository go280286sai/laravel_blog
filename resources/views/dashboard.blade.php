@extends('admin.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.hello').', '. \Illuminate\Support\Facades\Auth::user()->name}}!
            </h1>
            <small class="red">@if(\Illuminate\Support\Facades\Auth::user()->email_verified_at==null)
                        {{__('admin.limited_mode')}}
                    @endif</small>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                @if(\Illuminate\Support\Facades\Auth::user()->email_verified_at==null)
                    <div class="box-header with-border">
                        {!! __('admin.you_need_to_confirm') !!}
                        <form action="{{env('APP_URL').'/email/verification-notification'}}" method="post">
                            @csrf
                            <input type="hidden" name="user" value="{{\Illuminate\Support\Facades\Auth::user()}}">
                            <input type="submit" value="Repeat send">
                        </form>
                        <p class="red">{{$status??''}}</p>
                    </div>
                @endif
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('rule.rule')}}</h3>
                </div>
                {!! __('rule.text_rule') !!}
                <!-- /.box-body -->
                <div class="box-footer">
                    <p class="red">{{__('rule.rule_warning')}}</p>
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

@endsection
