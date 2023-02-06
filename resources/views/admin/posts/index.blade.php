@extends('admin.layouts')

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               {{__('admin.list_posts')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL').'/admin/posts/create'}}"
                                       class="btn btn-success">{{__('admin.add')}}</a></td>
                                <td>@if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                        <a href="{{env('APP_URL').'/admin/posts_trash'}}"
                                           class="btn btn-success btn_left">{{__('admin.recovery')}}</a>
                                    @endif</td>
                            </tr>
                        </table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <th>{{__('admin.user')}}</th>
                            @endif
                            <th>{{__('admin.title')}}</th>
                            <th>{{__('admin.category')}}</th>
                            <th>{{__('admin.tags')}}</th>
                            <th>{{__('admin.img')}}</th>
                            <th>{{__('admin.views')}}</th>
                            <th>{{__('admin.action')}}</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <th>{{__('admin.options')}}</th>
                                <th>{{__('admin.comments')}}</th>
                            @endif
                            <th>{{__('admin.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$i++}}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                    <td>{{$post->user->email??''}}</td>
                                @endif
                                <td>{{$post->title}}</td>
                                <td>{{$post->getCategoryTitle()}}</td>
                                <td>{{$post->getTagsTitles()}}</td>
                                <td>
                                    <img src="{{$post->getImage()}}" alt="" width="100">
                                </td>
                                <td>{{$post->views}}</td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/posts/'.$post->id.'/edit/'}}"
                                          method="get">
                                        @csrf
                                        <button class="btn" title="{{__('admin.edit_posts')}}"><i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/posts/'.$post->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('{{__('admin.are_you_sure')}}')" class="btn"
                                                title="{{__('admin.delete_post')}}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)

                                    <td>
                                        <form action="{{env('APP_URL').'/admin/viewMail'}}"
                                              method="post">
                                            <input type="hidden" name="email" value="{{$post->user->email??''}}">
                                            <input type="hidden" name="title" value="{{$post->title}}">

                                            @csrf
                                            <button class="btn" title="{{__('admin.send_message')}}"><i
                                                    class="fa fa-mail-forward"></i></button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/post_comment'}}" method="post">
                                            <input type="hidden" name="id" value="{{$post->id}}">
                                            <input type="hidden" name="comment" value="{!! $post->comment??'' !!}">
                                            @csrf
                                            <button class="btn" title="{{__('admin.add_comment')}}"><i
                                                    class="fa fa-comment"></i></button>
                                        </form>
                                    </td>
                                    <td>{!! $post->comment??'' !!}</td>
                                @endif
                                <td>{!! $post->status==1?'<font class="green" >active</font>':'<font class="red">dev</font>'!!}
                                    @if($post->status == 1)
                                        <form action="/admin/posts/toggle/{{$post->id}}" method="get">
                                            <button type="submit" >
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="/admin/posts/toggle/{{$post->id}}" method="get">
                                            <button type="submit" {{\Illuminate\Support\Facades\Auth::user()->email_verified_at??'disabled'}}>
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
@endsection
