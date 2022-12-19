@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

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
                                <th>{{__('admin.besides')}}</th>
                                <th>{{__('admin.comments')}}</th>
                            @endif
                            <th>{{__('admin.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
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
                                          method="post">
                                        @method('put')
                                        @csrf
                                        <button class="btn" title="{{__('admin.edit')}}"><i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/posts/'.$post->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('are you sure?')" class="btn"
                                                title="{{__('admin.delete')}}"><i class="fa fa-trash"></i></button>
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

                    @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <section class="content-header">
                            <h1>
                                {{__('admin.comments_list')}}
                            </h1>
                        </section>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>{{__('admin.text')}}</th>
                                <th>{{__('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->text}}
                                    </td>
                                    <td>
                                        @if($comment->status == 1)
                                            <form action="/admin/comments/toggle/{{$comment->id}}" method="get">
                                                <button type="submit">
                                                    <i class="fa fa-unlock"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="/admin/comments/toggle/{{$comment->id}}" method="get">
                                                <button type="submit">
                                                    <i class="fa fa-lock"></i>
                                                </button>
                                            </form>
                                        @endif
                                        {{Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'delete'])}}
                                        <button title="{{__('admin.delete')}}" onclick="return confirm('are you sure?')" type="submit" class="delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    {{Form::close()}}
                                </tr>
                            @endforeach
                        </table>
                        <section class="content-header">
                            <h1>
                               {{__('admin.users')}}
                            </h1>
                        </section>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{__('admin.name')}}</th>
                                <th>{{__('admin.contact_info')}}</th>
                                <th>{{__('admin.avatar')}}</th>
                                <th>{{__('admin.action')}}</th>
                                <th>{{__('admin.options')}}</th>
                                <th>{{__('admin.comments')}}</th>
                                <th>{{__('admin.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}
                                        <br>
                                        @if(\Illuminate\Support\Facades\Cache::get($user->id))
                                            <strong class="green">{{__('admin.online')}}</strong>
                                        @else
                                            <strong class="red">{{__('admin.offline')}}</strong>
                                        @endif
                                    </td>
                                    <td><strong>{{__('admin.email')}}:</strong> {{$user->email}}
                                        <br><strong>{{__('admin.gender')}}:</strong> {{$user->gender->name??'none'}}
                                        <br><strong>{{__('admin.birthday')}}:</strong> {{$user->birthday??'none' }}
                                        <br><strong>{{__('admin.phone_number')}}:</strong> {{$user->phone??'none'}}
                                        <br><strong>{{__('admin.create_date')}}
                                            :</strong> {{date_format($user->created_at, 'd-m-Y')}}
                                    </td>
                                    <td>
                                        <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
                                    </td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/users/'.$user->id.'/edit/'}}"
                                              method="get">
                                            @csrf
                                            <button class="btn" title="{{__('admin.edit')}}"><i class="fa fa-bars"></i>
                                            </button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/users/'.$user->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('{{__('admin.are_you_sure')}}')" class="btn"
                                                    title="{{__('admin.delete')}}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/viewMailUser'}}"
                                              method="post">
                                            <input type="hidden" name="email" value="{{$user->email}}">
                                            <input type="hidden" name="title" value="Message for {{$user->name}}">
                                            @csrf
                                            <button class="btn" title="{{__('admin.send_message')}}"><i
                                                    class="fa fa-mail-forward"></i></button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/user_comment'}}" method="post">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <input type="hidden" name="comment" value="{!! $user->comment??'' !!}">
                                            @csrf
                                            <button class="btn" title="{{__('admin.add_comment')}}"><i
                                                    class="fa fa-comment"></i></button>
                                        </form>
                                    </td>
                                    <td>{!! $user->comment??'' !!}</td>
                                    <td>
                                        {{$user->status==1?'active':'lock'}}
                                        <br>
                                        @if($user->status == 1)
                                            <form action="/admin/toggle/{{$user->id}}" method="get">
                                                <button type="submit">
                                                    <i class="fa fa-unlock"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="/admin/toggle/{{$user->id}}" method="get">
                                                <button type="submit">
                                                    <i class="fa fa-lock"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <section class="content-header">
                            <h1>
                                {{__('admin.list_subscriptions')}}
                            </h1>
                        </section>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{__('admin.email')}}</th>
                                <th>{{__('admin.date_of_registration')}}</th>
                                <th>{{__('admin.status')}}</th>
                                <th>{{__('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subs as $sub)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$sub->email}}
                                    </td>
                                    <td>{{date_format($sub->created_at, 'd-m-Y')}}
                                    </td>
                                    <td>{!! $sub->token?"<font class='red'>no active</font>":"<font class='green'>active</font>" !!}
                                    </td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/subscribers/'.$sub->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('are you sure?')" class="btn"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
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
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
