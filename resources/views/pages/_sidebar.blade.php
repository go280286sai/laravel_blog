<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar" id="sub">
        <aside class="widget news-letter">
            <h3 class="widget-title text-uppercase text-center"><strong
                    class="red"> {{__('messages.subscription')}}</strong></h3>
            <div :class="statusClass" v-if="status">
            <small v-text="statusText"></small></div>
            <form action="/subscribe" method="post" id="subs">
                @csrf
                <label>
                    <input type="email" placeholder="{{__('messages.your_email_address')}}" name="email" id="send">
                </label>
                <input type="submit" @click="sendSubscribe" value="{{__('messages.subscribe_now')}}"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center"><strong class="red">{{__('messages.category')}}</strong>
            </h3>
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
            <h3 class="widget-title text-uppercase text-center"><strong
                    class="red">{{__('messages.popular_posts')}}</strong></h3>
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
            <h3 class="widget-title text-uppercase text-center"><strong
                    class="red">{{__('messages.featured_posts')}}</strong></h3>
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
            <h3 class="widget-title text-uppercase text-center"><strong
                    class="red">{{__('messages.recent_posts')}}</strong></h3>
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
<script>
    Vue.createApp({
        data() {
            return {
                status:false,
                statusText:'',
                statusClass:''
            }
        },
        methods: {
          sendSubscribe(event) {
                event.preventDefault()
              let send = $('#send').val()
              this.statusText=''
              this.statusClass = 'p_info_ok'
              const pattern = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u;
              if(send.length===0 || !pattern.exec(send)){
                  return this.setStatus('err');
              }
                $.ajax({
                    url: '/subscribe',
                    type: $('#subs').attr('method'),
                    data: $('#subs').serialize(),
                }).done(()=>{
                    this.setStatus('ok')
                    $('#send').val('')
                }).fail(err=>{
                    this.setStatus(err.responseJSON.message)
                });

            },
            setStatus(text) {
                if (text === 'err') {
                    this.statusClass = 'p_info_danger'
                    this.statusText = '{{__('messages.invalid_mail_entered')}}'
                    return this.getStatus()
                }
                else if (text === 'ok') {
                    this.statusText = '{{__('messages.check_your_mailbox')}}'
                    return this.getStatus()
                } else {
                    this.statusText = text;
                    this.statusClass = 'p_info_danger'
                    return this.getStatus()
                }
            },
            getStatus(){
              this.status=true
                setTimeout(()=>{
                    this.status=false
                }, 3000);
            }
        }
    }).mount('#sub');
</script>
