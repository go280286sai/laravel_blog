@extends('admin.layouts')

@section('style')

@endsection

@section('text')
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
                                <td>
                                    <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="recover_all">
                                        <button title="Восстановить все записи?"
                                                onclick="return confirm('are you sure?')"
                                                class="btn btn-success"><i>{{__('admin.recovery_all')}}</i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                        @csrf
                                        <input type="hidden" name="target" value="trash_all">
                                        <button title="Удалить все записи?"
                                                onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                class="btn btn-success btn_left"><i>{{__('admin.delete_all')}}</i></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin.title')}}</th>
                            <th>{{__('admin.user')}}</th>
                            <th>{{__('admin.date_of_registration')}}</th>
                            <th>{{__('admin.date_of_delete')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trash as $item)
                            @if($item->user->name??false)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        {{$item->title}}
                                    </td>
                                    <td> {{$item->user->name??__('admin.user_delete')}}</td>
                                    <td>{{date_format($item->created_at, 'd-m-Y')}}
                                    </td>
                                    <td>
                                        {{date_format($item->deleted_at, 'd-m-Y')}}
                                    </td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                            @csrf
                                            <input type="hidden" name="target" value="recover">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button title="{{__('admin.recovery')}}?"
                                                    onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                    class="btn"><i
                                                    class="fa fa-bars"></i></button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/posts_recover'}}" method="post">
                                            @csrf
                                            <input type="hidden" name="target" value="trash">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button title="{{__('admin.delete_permanently')}}"
                                                    onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                    class="btn"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-default" onclick="window.history.back()">{{__('admin.back')}}</button>
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
