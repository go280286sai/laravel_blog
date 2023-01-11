<!DOCTYPE html>
<html lang="{{env('LOCAL')}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon icon -->
    <title>{{env('APP_NAME')}}</title>
    <!-- common css -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/css/blog.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/font-awesome.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/animate.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.carousel.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.theme.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.transitions.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/style.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/responsive.css'}}">
    <script src="https://unpkg.com/vue@next"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@section('style')
    @show

    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{env('APP_URL').'/assets/front/js/html5shiv.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/front/js/respond.js'}}"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{env('APP_URL').'/assets/front/images/favicon.png'}}">

</head>
<body>
<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <div class="navbar-header">
                <span class="icon-bar item"><a href="/greeting/uk"><strong class="{{\Illuminate\Support\Facades\App::getLocale()=='uk'?'red':''}}">uk</strong></a></span>
                <span class="icon-bar item"><a href="/greeting/ru"><strong class="{{\Illuminate\Support\Facades\App::getLocale()=='ru'?'red':''}}">ru</strong></a></span>
                <span class="icon-bar item"><a href="/greeting/en"><strong class="{{\Illuminate\Support\Facades\App::getLocale()=='en'?'red':''}}">en</strong></a></span>
                <a class="navbar-brand" href="/"><img src="{{env('APP_URL').'/assets/front/images/logo.png'}}"
                                                      alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav text-uppercase">
                    <li><a href="/"><i @if($home??false)class="red" @endif>{{__('messages.homepage')}}</i></a></li>
                    <li><a href="/about"><i @if($me??false)class="red" @endif>{{__('messages.about_me')}}</i></a></li>
                    <li><a href="/contact"><i @if($contact??false)class="red" @endif>{{__('messages.contact')}}</i></a></li>
                </ul>
                <ul class="nav navbar-nav text-uppercase pull-right">
                    @if(Auth::check())
                        <li><a href="/admin/dashboard">{{__('messages.my_profile')}}</a></li>
                        <li><a href="/logout">{{__('messages.logout')}}</a></li>
                    @else
                        <li><a href="/register">{{__('messages.register')}}</a></li>
                        <li><a href="/login">{{__('messages.login')}}</a></li>
                    @endif
                </ul>
                <div>
                </div>
                <!-- /.search form -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="cm-searching pull-right">
                <form action="/search" method="post" class="sidebar-form">
                    <div class="input-group">
                        @csrf
                        <label>
                            <input type="text" name="search" class="form-control" placeholder="{{__('messages.search')}}...">
                        </label>
                    </div>
                </form>
            </div>
            <div><h5 class="top_text">{{__('messages.title_message')}}</h5></div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-info">
                    {{session('status')}}
                </div>
            @endif
        </div>
    </div>
</div>

@section('text')
@show

<!--footer start-->
<div id="footer">
    <div class="footer-instagram-section">

    </div>
</div>

<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="{{env('APP_URL').'/assets/front/images/footer-logo.png'}}" alt="">
                    </div>
                    <div class="about-content">Lorem ipsum dolor sit amet, consecrate disciplining elite, sed diam
                        noname
                        usermod temper indent ut labor et color magna aliquot erat, sed voluptuous. At vero eos et
                        accused et justo duo Flores et ea rebut magna text ar kowtow din.
                    </div>
                    <div class="address">
                        <h4 class="text-uppercase">contact Info</h4>
                        <p> Ukraine, Kharkov</p>
                        <p> Phone: +38 000 000 00</p>
                        <p>admin@admin.ua</p>
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Testimonials</h3>

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!--Indicator-->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, constipating elite, sed diam noname usermod
                                            untempered ut labor et color magna aliquot erat,sed diam voluptuous. At
                                            vero eos et accused justo duo dolores et ea rebut.evergreen no sea stigmata
                                            magna aliquot erat</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="{{env('APP_URL').'/assets/front/images/author.png'}}" alt="">

                                        <div class="author-text">
                                            <h4>Alex</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, constipating elite, sed diam noname usermod
                                            untempered ut labor et color magna aliquot erat,sed diam voluptuous. At
                                            vero eos et accused justo duo dolores et ea rebut.evergreen no sea stigmata
                                            magna aliquot erat</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="{{env('APP_URL').'/assets/front/images/author.png'}}" alt="">

                                        <div class="author-text">
                                            <h4>Sergey</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, constipating elite, sed diam noname usermod
                                            untempered ut labor et color magna aliquot erat,sed diam voluptuous. At
                                            vero eos et accused justo duo dolores et ea rebut.evergreen no sea stigmata
                                            magna aliquot erat</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="{{env('APP_URL').'/assets/front/images/author.png'}}" alt="">
                                        <div class="author-text">
                                            <h4>Sophia</h4>
                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Custom Category Post</h3>
                    <div class="custom-post">
                        <div>
                            <a href="#"><img src="{{env('APP_URL').'/assets/front/images/footer-img.png'}}" alt=""></a>
                        </div>
                        <div>
                            <a href="#" class="text-uppercase">Home is peaceful Place</a>
                            <span class="p-date"></span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; 2022 <a href="#">Blog, </a> Designed with <i
                            class="fa fa-heart"></i> by <a href="#">Alex Coop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery-1.11.3.min.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/bootstrap.min.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/owl.carousel.min.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery.stickit.min.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/menu.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/scripts.js'}}"></script>
<script type="text/javascript" src="{{env('APP_URL').'/assets/js/share-buttons.js'}}"></script>
@section('js')
@show

</body>
</html>
