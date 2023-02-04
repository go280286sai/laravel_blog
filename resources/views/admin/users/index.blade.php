@extends('admin.layouts')

@section('style')

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
                        <a href="{{env('APP_URL').'/admin/users_trash'}}"
                           class="btn btn-success">{{__('admin.recovery')}}</a>
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
                                        <strong class="green">{{__('admin.online')}}</strong>
                                        <form action="{{env('APP_URL').'/admin/chat_user/'.$user->id}}"
                                              method="get">
                                            @csrf
                                            <button class="btn" title="{{__('admin.add_private_message')}}"><i class="fa fa-send"></i>
                                            </button>
                                        </form>
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
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
