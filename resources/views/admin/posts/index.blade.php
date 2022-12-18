@extends('admin.layouts')

@section('style')
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/bootstrap/css/bootstrap.min.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/font-awesome/4.5.0/css/font-awesome.min.css'}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/ionicons/2.0.1/css/ionicons.min.css'}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/iCheck/all.css'}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datepicker/datepicker3.css'}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/select2/select2.min.css'}}">
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
                                <td>{!! $post->status==1?'<font color="green">active</font>':'<font color="red">dev</font>'!!}
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
                        </tfoot>
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

    <!-- jQuery 2.2.3 -->
    <script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{env('APP_URL').'/assets/bootstrap/js/bootstrap.min.js'}}"></script>
    <!-- Select2 -->
    <script src="{{env('APP_URL').'/assets/plugins/select2/select2.full.min.js'}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{env('APP_URL').'/assets/plugins/datepicker/bootstrap-datepicker.js'}}"></script>
    <!-- SlimScroll -->
    <script src="{{env('APP_URL').'/assets/plugins/slimScroll/jquery.slimscroll.min.js'}}"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL').'/assets/plugins/fastclick/fastclick.js'}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{env('APP_URL').'/assets/plugins/iCheck/icheck.min.js'}}"></script>
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
