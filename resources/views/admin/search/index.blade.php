@extends('admin.layouts')

@section('style')
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/bootstrap/css/bootstrap.min.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/font-awesome/4.5.0/css/font-awesome.min.css'}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/ionicons/2.0.1/css/ionicons.min.css'}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/AdminLTE.min.css'}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/dist/css/skins/_all-skins.min.css'}}">
    <!-- Button style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Darker background on mouse-over */
        .btn:hover {
            background-color: #8aa4af;
        }
    </style>
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
                                        <button class="btn" title="Редактирование поста"><i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/admin/posts/'.$post->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('are you sure?')" class="btn"
                                                title="Удаление поста"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)

                                    <td>
                                        <form action="{{env('APP_URL').'/admin/viewMail'}}"
                                              method="post">
                                            <input type="hidden" name="email" value="{{$post->user->email??''}}">
                                            <input type="hidden" name="title" value="{{$post->title}}">

                                            @csrf
                                            <button class="btn" title="Отправить сообщение пользователю"><i
                                                    class="fa fa-mail-forward"></i></button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/post_comment'}}" method="post">
                                            <input type="hidden" name="id" value="{{$post->id}}">
                                            <input type="hidden" name="comment" value="{!! $post->comment??'' !!}">
                                            @csrf
                                            <button class="btn" title="Добавить комментарий к посту"><i
                                                    class="fa fa-comment"></i></button>
                                        </form>
                                    </td>
                                    <td>{!! $post->comment??'' !!}</td>
                                @endif
                                <td>{!! $post->status==0?'<font color="green">active</font>':'<font color="red">dev</font>'!!}
                                    @if($post->status == 0)
                                        <form action="/admin/posts/toggle/{{$post->id}}" method="get">
                                            <button type="submit">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="/admin/posts/toggle/{{$post->id}}" method="get">
                                            <button type="submit">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>

                    @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <section class="content-header">
                            <h1>
                                Список комментарий
                            </h1>
                        </section>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Текст</th>
                            <th>Действия</th>
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
                                            <button type="submit" >
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="/admin/comments/toggle/{{$comment->id}}" method="get">
                                            <button type="submit" >
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                    {{Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'delete'])}}
                                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {{Form::close()}}
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                        <section class="content-header">
                            <h1>
                                Список пользователей
                            </h1>
                        </section>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Contact info</th>
                                <th>Аватар</th>
                                <th>Действия</th>
                                <th>Notes</th>
                                <th>Comment</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}
                                        <br>
                                        @if(\Illuminate\Support\Facades\Cache::get($user->id))
                                            <font color="green"> <strong>Online</strong> </font>
                                        @else
                                            <font color="#8b0000"> <strong>Offline</strong> </font>
                                        @endif


                                    </td>
                                    <td><strong>E-mail:</strong> {{$user->email}}
                                        <br><strong>gender:</strong> {{$user->gender->name??'none'}}
                                        <br><strong>Birthday:</strong> {{ $user->birthday??'none' }}
                                        <br><strong>Phone number:</strong> {{$user->phone??'none'}}
                                        <br><strong>Create date:</strong> {{date_format($user->created_at, 'd-m-Y')}}
                                    </td>
                                    <td>
                                        <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
                                    </td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/users/'.$user->id.'/edit/'}}"
                                              method="post">
                                            @method('put')
                                            @csrf
                                            <button class="btn" title="Редактирование поста"><i class="fa fa-bars"></i>
                                            </button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/users/'.$user->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('are you sure?')" class="btn"
                                                    title="Удаление поста"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{env('APP_URL').'/admin/viewMailUser'}}"
                                              method="post">
                                            <input type="hidden" name="email" value="{{$user->email}}">
                                            <input type="hidden" name="title" value="Message for {{$user->name}}">

                                            @csrf
                                            <button class="btn" title="Отправить сообщение пользователю"><i
                                                    class="fa fa-mail-forward"></i></button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/user_comment'}}" method="post">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <input type="hidden" name="comment" value="{!! $user->comment??'' !!}">
                                            @csrf
                                            <button class="btn" title="Добавить комментарий к посту"><i
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
                            </tfoot>
                        </table>
                        <section class="content-header">
                            <h1>
                                Список подписчиков
                            </h1>
                        </section>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Дата регистрации</th>
                                <th>Статус</th>
                                <th>Действие</th>
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
                                    <td>{!! $sub->token?"<font color='red'>no active</font>":"<font color='green'>active</font>" !!}
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
                            </tfoot>
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

    <!-- jQuery 2.2.3 -->
    <script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{env('APP_URL').'/assets/bootstrap/js/bootstrap.min.js'}}"></script>
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <!-- SlimScroll -->
    <script src="{{env('APP_URL').'/assets/plugins/slimScroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL').'/assets/plugins/fastclick/fastclick.js'}}"></script>
    <!-- AdminLTE App -->
    <script src="{{env('APP_URL').'/assets/dist/js/app.min.js'}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{env('APP_URL').'/assets/dist/js/demo.js'}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
