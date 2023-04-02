<div class="social-share">
    <span class="social-share-title pull-left text-capitalize">By {{$post->user->name}} On <strong
            class="red">{{$post->getDate()}}</strong> </span>
            {!! ShareButtons::page(route('post.show', $post->slug), $post->title, [
                    'block_prefix' => '<ul class="text-center pull-right">',
                    'block_suffix' => '</ul>',
                    'element_prefix' => '<li>',
                    'element_suffix' => '</li>',
               ])->facebook()
                 ->twitter()
                 ->linkedin()
                 ->telegram()
                 ->whatsapp()
                 ->skype()
                 ->copylink()
                 ->mailto()
            !!}
</div>
