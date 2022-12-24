@extends('layout')

@section('style')
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
                        <h3 class="text-uppercase">{{ __('messages.unsubscribe') }}</h3>
                        @include('admin.errors')
                        <br>
                        {{Form::open(['url'=>env('APP_URL').'/unsubscribe_email/', 'method'=>'post'])}}
                        {{Form::hidden('email', $id)}}
                        {{Form::button(__('messages.yes'), ['title'=>__('messages.yes'), 'class'=>'btn btn-success', 'type'=>'submit'])}}
                        {{Form::close()}}
                    </div>
                    <!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
