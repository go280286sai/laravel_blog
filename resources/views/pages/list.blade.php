@extends('layout')

@section('style')
    <!-- common css -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/font-awesome.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/animate.min.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.carousel.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.theme.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/owl.transitions.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/style.css'}}">
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/front/css/responsive.css'}}">
@endsection

@section('text')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6">
                        <article class="post post-grid">
                            <div class="post-thumb">
                                <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->getImage()}}" alt=""></a>
                                <a href="{{route('post.show', $post->slug)}}" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">{{__('messages.view_post')}}</div>
                                </a>
                            </div>
                            <div class="post-content">
                                <header class="entry-header text-center text-uppercase">
                                    @if($post->hasCategory())
		                            <h6><a href="{{route('category.show', $post->category->slug)}}">{{$post->getCategoryTitle()}}</a></h6>
		                            @endif
                                    <h1 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h1>
                                </header>
                                <div class="entry-content">
                                    {!! $post->description !!}
                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By {{$post->user->name}} On <strong style="color: red">{{$post->getDate()}}</strong> </span>
                                    </div>
                                </div>
                            </div>

                        </article>
                    </div>
                @endforeach
                </div>
                {{$posts->links()}}
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection

@section('js')
    <!-- js files -->
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery-1.11.3.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/bootstrap.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/owl.carousel.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/jquery.stickit.min.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/menu.js'}}"></script>
    <script type="text/javascript" src="{{env('APP_URL').'/assets/front/js/scripts.js'}}"></script>
@endsection
