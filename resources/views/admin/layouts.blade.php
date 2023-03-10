<!DOCTYPE html>
<html lang="{{env('LOCAL')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$admin->name}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/css/blog.css'}}">
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

    @section('style')

@show

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{env('APP_URL')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{env('APP_NAME')}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{env('APP_NAME')}}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{'/uploads/users/'.$admin->avatar}}" class="user-image" alt="">
                            <span class="hidden-xs">{{$admin->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{'/uploads/users/'.$admin->avatar}}" class="img-circle"
                                     alt="{{$admin->name}}">
                                <p>
                                    {{$admin->name}}
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{env('APP_URL').'/admin/profile/'}}"
                                       class="btn btn-default btn-flat">{{__('admin.profile')}}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{env('APP_URL').'/logout/'}}"
                                       class="btn btn-default btn-flat">{{__('admin.logout')}}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{'/uploads/users/'.$admin->avatar}}" class="img-circle" alt="">

                </div>
                <div class="pull-left info">
                    <p class="green">{{$admin->name}}</p>{{$admin->email}}
                </div>
            </div>
            <!-- search form -->
            <form action="/admin/search" method="post" class="sidebar-form">
                <div class="input-group">
                    @csrf
                    <input type="text" name="search" class="form-control" placeholder="{{__('admin.search')}}...">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <div id="admin">
                    <form action="/admin/chat_send" method="post">
                        <div class="input-group">
                            <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" id="getId">
                        </div>
                    </form>
                </div>
                <li class="header">{{__('admin.main_navigation')}}</li>
                <li class="treeview">
                    <a href="{{env('APP_URL').'/admin/profile/'}}">
                        <i class="fa fa-dashboard"></i> <span>{{__('admin.profile')}}</span>
                    </a>
                </li>
                <li><a href="{{env('APP_URL').'/admin/posts/'}}"><i class="fa fa-sticky-note-o"></i>
                        <span>{{__('admin.posts')}}</span></a></li>
                @if($admin->is_admin)
                    <li><a href="{{env('APP_URL').'/admin/categories/'}}"><i class="fa fa-list-ul"></i>
                            <span>{{__('admin.categories')}}</span></a></li>
                    <li><a href="{{env('APP_URL').'/admin/tags'}}"><i class="fa fa-tags"></i>
                            <span>{{__('admin.tags')}}</span></a></li>
                @endif
                <li>
                    <a href="{{env('APP_URL').'/admin/comments/'}}">
                        <i class="fa fa-commenting"></i> <span>{{__('admin.comments')}}</span>
                        <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$newCommentsCount}}</small>
            </span>
                    </a>
                </li>
                <li>
                    <a href="{{env('APP_URL').'/admin/chat/'}}" target="_blank">
                        <i class="fa fa-support"></i> <span>{{__('admin.chat')}}</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>


                @if($admin->is_admin)
                    <li><a href="{{env('APP_URL').'/admin/users/'}}"><i class="fa fa-users"></i>
                            <span>{{__('admin.users')}}</span></a></li>
                    <li><a href="{{env('APP_URL').'/admin/subscribers/'}}"><i class="fa fa-user-plus"></i>
                            <span>{{__('admin.subscriptions')}}</span></a></li>
                    <li>
                        <a href="{{env('APP_URL').'/admin/messages/'}}">
                            <i class="fa fa-mail-forward"></i> <span>{{__('admin.email')}}</span>
                            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$mail_count}}</small>
            </span>
                        </a>
                    </li>
                    <li><a href="{{env('APP_URL').'/telescope/'}}" target="_blank"><i class="fa fa-shower"></i>
                            <span>{{__('admin.resource_monitoring')}}</span></a></li>

                    <li><a href="{{env('APP_URL').'/admin/telegram/'}}"><i class="fa fa-male"></i>
                            <span>{{__('admin.telegram')}}</span> <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$telegrams_count}}</small>
            </span></a></li>

                @endif
                @if(!$admin->is_admin)
                    <li>
                        <form action="{{env('APP_URL').'/admin/users/'.$admin->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button onclick="return confirm({{__('admin.delete_info')}})"
                                    title="{{__('admin.delete')}}"><i
                                    class="fa-barcode fa-remove"><span>{{__('admin.delete_account')}}</span></i>
                            </button>
                        </form>
                    </li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    @section('text')
    @show
    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>


    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Alex Updated His Profile</h4>

                                <p>New phone +380000000</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
@vite('resources/js/app.js')
<script src="https://unpkg.com/vue@next"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<!-- ./wrapper -->
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
<!-- Plugins for input text -->
<script src="{{env('APP_URL').'/plugins/ckeditor/ckeditor.js'}}"></script>
<script src="{{env('APP_URL').'/plugins/ckfinder/ckfinder.js'}}"></script>
@section('js')
@show

<script>
    $(document).ready(function () {
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor(editor);
    })

</script>
</body>
</html>

