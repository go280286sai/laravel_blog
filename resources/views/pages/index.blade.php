@extends('layout')

@section('style')
@endsection

@section('text')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($posts as $post)
                <article class="post">
                    <div class="post-thumb">
                        <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->getImage()}}" alt=""></a>
                        <a href="{{route('post.show', $post->slug)}}" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">{{__('messages.view_post')}}</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                        @if($post->hasCategory())
                            <h6><a href="{{route('category.show', $post->category->slug)}}"> {{$post->getCategoryTitle()}}</a></h6>
                        @endif
                            <h1 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h1>
                        </header>
                        <div class="entry-content">
                            {!!$post->description!!}
                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="{{route('post.show', $post->slug)}}" class="more-link">{{__('messages.continue_reading')}}</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">By {{$post->user->name}} On <strong class="red">{{$post->getDate()}}</strong> </span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                @endforeach
                {{$posts->links()}}
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection

@section('js')
@endsection