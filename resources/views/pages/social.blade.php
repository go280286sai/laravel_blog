<div class="social-share">
    <span class="social-share-title pull-left text-capitalize">By {{$post->user->name}} On <strong class="red">{{$post->getDate()}}</strong> </span>
    <ul class="text-center pull-right">
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->facebook() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->twitter() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->linkedin() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->telegram() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->whatsapp() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->skype() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->copylink() !!}</li>
        <li>{!! ShareButtons::page(route('post.show', $post->slug), $post->title)->mailto() !!}</li>
    </ul>
</div>
