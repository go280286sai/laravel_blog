@extends('admin.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.comments_list')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/admin/comments_trash'}}"
                               class="btn btn-success">{{__('admin.recovery')}}</a>
                        </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>{{__('admin.post')}}</th>
                            <th>{{__('admin.text')}}</th>
                            <th>{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$comment->title}}</td>
                                <td>{{$comment->text}}
                                </td>
                                <td>
                                    @if($comment->status == 1)
                                        <form action="{{env('APP_URL').'/admin/comments/toggle/'.$comment->id}}"
                                              method="get">
                                            <button type="submit">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{env('APP_URL').'/admin/comments/toggle/'.$comment->id}}"
                                              method="get">
                                            <button type="submit">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif
                                    {{Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'delete'])}}
                                    <button title="{{__('admin.delete')}}"
                                            onclick="return confirm('{{__('admin.are_you_sure')}}')" type="submit"
                                            class="delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {{Form::close()}}
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
