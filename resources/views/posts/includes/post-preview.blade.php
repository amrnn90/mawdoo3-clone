<div class="post-preview">
    <a href="{{ route('posts.show', $post) }}" title="{{ $post->title }}">
        <div class="img-holder img-holder--fill">
            <img src="{{ asset($post->thumb) }}" alt="{{ $post->title }}" class="post-preview__image">
        </div>
        <div class="post-preview__title dont-break-out">{{ $post->title }}</div>
    </a>
</div>