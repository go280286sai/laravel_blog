@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{__('admin.telegram')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/admin/telegram_write/'}}"
                           class="btn btn-success">{{__('admin.add')}}</a>
                        <a href="{{env('APP_URL').'/admin/telegram_update/'}}"
                           class="btn btn-success btn_left">{{__('admin.update')}}</a>
                    </div>
                    <div id="successful">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{__('admin.first_name')}}</th>
                                <th>{{__('admin.last_name')}}</th>
                                <th>{{__('admin.username')}}</th>
                                <th>{{__('admin.text')}}</th>
                                <th>{{__('admin.answer')}}</th>
                                <th>{{__('admin.action')}}</th>
                                <th>{{__('admin.create_date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $item)
                                {{\App\Models\Telegram::statusAnswer($item['id'])}}
                                <tr>
                                    <td>
                                        {{$i++}}</td>
                                    <td>{{$item['first_name']}}</td>
                                    <td>{{$item['last_name']}}</td>
                                    <td>{{$item['username']}}</td>
                                    <td>{{$item['text']}}</td>
                                    <td>{{$item['answer']}}</td>
                                    <td>
                                        <form action="{{env('APP_URL').'/admin/telegram_answer/'}}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item['id']}}">
                                            <input type="hidden" name="chat_id" value="{{$item['chat_id']}}">
                                            <input type="hidden" name="message_id" value="{{$item['message_id']}}">
                                            <button title="{{__('admin.show')}}" class="btn"><i class="fa fa-bars"></i>
                                            </button>
                                        </form>
                                        <form action="{{env('APP_URL').'/admin/telegram_remove/'.$item['id']}}"
                                              method="get">
                                            @csrf
                                            <button title="{{__('admin.delete')}}"
                                                    onclick="return confirm('{{__('admin.are_you_sure')}}')"
                                                    class="btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>{{$item['send_date']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <!-- page script -->
@endsection
