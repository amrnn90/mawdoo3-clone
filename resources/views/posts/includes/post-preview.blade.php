<div class="post-preview">
    <a href="{{ route('posts.show', $post) }}">
        <div class="img-holder">
            <img src="{{ asset($post->thumb) }}" alt="{{ $post->title }}" class="post-preview__image">
        </div>
        <div class="post-preview__title">{{ $post->title }}</div>
    </a>
</div>