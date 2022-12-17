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
                {{__('admin.users')}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('users.create')}}" class="btn btn-success">{{__('admin.add')}}</a>
                        <a href="{{env('APP_URL').'/admin/users_trash'}}" class="btn btn-success">{{__('admin.recovery')}}</a>
                    </div>
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
                                        <font color="green"> <strong>{{__('admin.online')}}</strong> </font>
                                    @else
                                        <font color="#8b0000"> <strong>{{__('admin.offline')}}</strong> </font>
                                    @endif
                                </td>
                                <td><strong>{{__('admin.email')}}:</strong> {{$user->email}}
                                    <br><strong>{{__('admin.gender')}}:</strong> {{$user->gender->name??'none'}}
                                    <br><strong>{{__('admin.birthday')}}:</strong> {{ $user->birthday??'none' }}
                                    <br><strong>{{__('admin.phone_number')}}:</strong> {{$user->phone??'none'}}
                                    <br><strong>{{__('admin.create_date')}}:</strong> {{date_format($user->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/users/'.$user->id.'/edit/'}}"
                                          method="post">
                                        @method('put')
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
