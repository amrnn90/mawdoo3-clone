<div class="hero">
    @php
        $midindex = intval($posts->count()/2);
        $leftPosts = $posts->slice(0, $midindex);
        $rightPosts = $posts->slice($midindex);
    @endphp
    <div class="hero__container">
        <div class="hero__grid-container hero__grid-container--left">
            <div class="flex-grid-wrap">
                <div class="hero__grid">
                    @foreach ($leftPosts as $p)
                        <a href="{{ route('posts.show', $p) }}" class="hero__grid-item">
                            <div class="img-holder img-holder--hero-grid-image">
                                <img src="{{ asset($p->thumb) }}" alt="">
                            </div>
                            <h4 class="hero__post-title">
                                {{ $p->title }}
                            </h4>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="hero__center">
            <div class="hero__intro">
                <h1 class="hero__heading">أهلاً بك في موضوع، أكبر موقع عربي بالعالم.</h1>
                <div class="hero__search-form">
                    @include('includes.search-form')
                </div>
            </div>
        </div>

        <div class="hero__grid-container hero__grid-container--right">
            <div class="flex-grid-wrap">
                <div class="hero__grid">
                    @foreach ($rightPosts as $p)
                        <a href="{{ route('posts.show', $p) }}" class="hero__grid-item">
                            <div class="img-holder img-holder--hero-grid-image">
                                <img src="{{ asset($p->thumb) }}" alt="">
                            </div>
                            <h4 class="hero__post-title">
                                {{ $p->title }}
                            </h4>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>