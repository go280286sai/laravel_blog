@extends('layout')

@section('style')
@endsection

@section('text')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->getImage()}}" alt=""></a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                @if($post->hasCategory())
                                    <h6>
                                        <a href="{{route('category.show', $post->category->slug)}}"> {{$post->getCategoryTitle()}}</a>
                                    </h6>
                                @endif
                                <h1 class="entry-title"><a
                                        href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h1>
                            </header>
                            <div class="entry-content">
                                {!! $post->content !!}
                            </div>
                            <div class="decoration">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag.show', $tag->slug)}}"
                                       class="btn btn-default">{{$tag->title}}</a>
                                @endforeach
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By {{$post->user->name}} On  <strong
                                        class="red">{{$post->getDate()}}</strong></span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="{{route('auth.facebook')}}"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a class="ion-social-github" href="{{route('auth.github')}}"><i
                                                class="fa fa-github"></i></a></li>
                                    <li><a class="s-google-plus" id="shareBtn"
                                           href="{{route('post.show', $post->slug)}}"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="block_views">
                                <strong><small>{{__('messages.views_users').\Illuminate\Support\Facades\Cache::get($post->slug)}}</small></strong>
                            </div>
                        </div>
                    </article>
                    <div class="top-comment">
                        <!--top comment-->
                        <div class="pull-left image">
                            <img src="{{'/uploads/users/'.$post->user->avatar}}" alt="{{$post->user->name}}"
                                 width="70px">
                        </div>
                        <h4>{{$post->user->name}}</h4>
                        <p>{!! $post->user->myself !!}</p>
                    </div>
                    <!--top comment end-->
                    <div class="row">
                        <!--blog next previous-->
                        <div class="col-md-6">
                            @if($post->hasPrevious())
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->getPrevious()->slug)}}">
                                        <img src="{{$post->getPrevious()->getImage()}}" alt="">
                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>{{$post->getPrevious()->title}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($post->hasNext())
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->getNext()->slug)}}">
                                        <img src="{{$post->getNext()->getImage()}}" alt="">
                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-right fa fa-angle-right"></i></p>
                                                <h5>{{$post->getNext()->title}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--blog next previous end-->

                        @foreach($post->getComments() as $comment)
                            <div class="bottom-comment">
                                <!--bottom comment-->
                                <div class="comment-img">
                                    <img class="img-circle" src="{{$comment->user->getAvatar()}}" alt="" width="75"
                                         height="75">
                                </div>
                                <div class="comment-text">
                                    <h5>{{$comment->user->name}}</h5>
                                    <p class="comment-date">
                                        {{$comment->created_at->diffForHumans()}}
                                    </p>
                                    <p class="para">{{$comment->text}}</p>
                                </div>
                            </div>
                        @endforeach


                    <!-- end bottom comment-->
                    @if(Auth::check())
                        <div class="leave-comment" id="show">
                            <!--leave comment-->
                            <h4>{{__('messages.write_comment')}}</h4>
                            <p v-text="info" class="p_info_ok" v-if="status_info"></p>
                            <form class="form-horizontal contact-form" role="form" method="post"
                                  action="/admin/comment" id="add_comment">
                                {{csrf_field()}}
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <div class="form-group">
                                    <div class="col-md-12">
    										<textarea class="form-control" rows="6" name="message"
                                                      placeholder="{{__('messages.write_text')}}" id="write_message"></textarea>
                                    </div>
                                </div>
                                <button @click="addComment"
                                        class="btn send-btn">{{__('messages.post_comment')}}</button>
                            </form>
                        </div>
                        <!--end leave comment-->
                    @endif
                    <div class="related-post-carousel">
                        <!--related post carousel-->
                        <div class="related-heading">
                            <h4>{{__('messages.you_might_also_like')}}</h4>
                        </div>
                        <div class="items">
                            @foreach($post->related() as $item)
                                <div class="single-item">
                                    <a href="{{route('post.show', $item->slug)}}">
                                        <img src="{{$item->getImage()}}" alt="">
                                        <p>{{$item->title}}</p>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div><!--related post carousel-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection

@section('js')
    <script>
        Vue.createApp({
            data() {
                return {
                    info: '{{__('messages.add_comment')}}',
                    status_info: false
                }
            },
            methods: {
                addComment(event) {
                    event.preventDefault();
                    const add_comment = $('#add_comment')
                    $.ajax({
                        url: add_comment.attr('action'),
                        type: add_comment.attr('method'),
                        data: add_comment.serialize()
                    }).done(
                        () => {
                            this.setStatusComment();
                        }
                    );
                },
                setStatusComment() {
                    this.status_info = true
                    setTimeout(() => {
                        this.status_info = false
                    }, 3000);
                    $('#write_message').val('')
                }
            }
        }).mount('#show')
    </script>
@endsection
