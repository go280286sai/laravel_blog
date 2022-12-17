<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">
        <aside class="widget news-letter">
            <h3 class="widget-title text-uppercase text-center"><strong class="red"> {{__('messages.subscription')}}</strong></h3>
            <form action="/subscribe" method="post">
                {{csrf_field()}}
                <label>
                    <input type="email" placeholder="{{__('messages.your_email_address')}}" name="email">
                </label>
                <input type="submit" value="{{__('messages.subscribe_now')}}"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center"><strong class="red">{{  __('messages.category') }}</strong> </h3>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{route('category.show', $category->slug)}}">{{$category->title}}</a>
                        <span class="post-count pull-right"> ({{$category->posts()->count()}})</span>
                    </li>
                @endforeach
            </ul>
        </aside>
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center"><strong class="red">{{__('messages.popular_posts')}}</strong></h3>
            @foreach($popularPosts as $post)
                <div class="popular-post">
                    <a href="{{route('post.show', $post->slug)}}" class="popular-img"><img src="{{$post->getImage()}}"
                                                                                           alt="">
                        <div class="p-overlay"></div>
                    </a>
                    <div class="p-content">
                        <a href="{{route('post.show', $post->slug)}}" class="text-uppercase">{{$post->title}}</a>
                        <span class="p-date">{{$post->getDate()}}</span>
                    </div>
                </div>
            @endforeach
        </aside>
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center"><strong class="red">{{__('messages.featured_posts')}}</strong></h3>
            <div id="widget-feature" class="owl-carousel">
                @foreach($featuredPosts as $post)
                    <div class="item">
                        <div class="feature-content">
                            <img src="{{$post->getImage()}}" alt="">
                            <a href="{{route('post.show', $post->slug)}}" class="overlay-text text-center">
                                <h5 class="text-uppercase">{{$post->title}}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center"><strong class="red">{{__('messages.recent_posts')}}</strong></h3>
            @foreach($recentPosts as $post)
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('post.show', $post->slug)}}" class="popular-img"><img
                                    src="{{$post->getImage()}}" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="{{route('post.show', $post->slug)}}" class="text-uppercase">{{$post->title}}</a>
                            <span class="p-date">{{$post->getDate()}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </aside>
    </div>
</div>
