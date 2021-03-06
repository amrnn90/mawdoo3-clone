@extends('layouts.withsidebar')

@section('title', "$post->title - موضوع")

@php
    $visitorsReadPosts = $post->visitorsAlsoRead();
    $category = $post->category;
    $author = $post->author;
@endphp

@section('main-content')
        {{ Breadcrumbs::render('post', $post) }}

        <div class="post">
            <div>
                @can('edit', $post)
                    <small>[<a href="{{ route('posts.edit', $post) }}">تعديل</a>]</small>
                @endcan
                @can('destroy', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline">
                        @csrf @method('DELETE')
                        [<a href="javascript:" class="text-danger" onclick="this.parentNode.submit()"><small>حذف</small></a>]
                    </form>
                @endcan
            </div>
            <h1 class="post__title">
                {{ $post->title }}
            </h1>
            <div class="post__meta">
                بواسطة
                <span class="post__meta-em">
                    {{ $author->name }}
                </span>
                آخر تحديث 

                <span class="post__meta-em">
                    {{ $post->updated_at->formatLocalized('%d %B %Y') }}
                </span>
            </div>
            <div class="post__image">
                <div class="img-holder img-holder--post-image">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                </div>
            </div>
    
            <div class="post__content-wrapper">
                <div class="post__toc" data-no-swup>
                    <div class="tocbot"></div>
                </div>
                <div class="post__content">
                    <article class="post-content">
                        {!! $post->content !!}
                    </article>

                    <div class="post__social">
                        <div class="post__social-share">
                            <h4>
                                <i class="fa fa-share"></i>
                                شارك الموضوع 
                            </h4>
                            <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                            <div class="addthis_inline_share_toolbox_9jan"></div> 
                        </div>
                        <div class="post__social-viewcount">
                            <div class="post__social-viewcount-icon">
                                <i class="fa fa-eye"></i>
                            </div>
                            <span class="post__socil-viewcount-text">
                                {{ $post->viewCount }} مشاهدة
                            </span>
                        </div>
                    </div>
                </div>
            </div>

 

        </div>
        <section>
            <h2 class="section-header">مقالات ذات صلة</h2>
            <div class="flex-grid-wrapper">
                <div class="posts-grid">
                    @foreach ($post->relatedPosts(6) as $p)
                        <div class="posts-grid__item">
                            @include('posts/includes/post-preview', ['post' => $p])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection

@section('sidebar')
    <div class="sidebar-section">
        <h4 class="sidebar-section__header">الزوار شاهدوا أيضاً</h4>
        <div class="flex-grid-wrapper">
            <div class="posts-grid posts-grid--tight">
                @foreach ($visitorsReadPosts as $p)
                    <div class="posts-grid__item">
                        @include('posts/includes/post-preview', ['post' => $p])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="sidebar-section">
        <h4 class="sidebar-section__header">مقالات من تصنيف {{ $category->name }}</h4>
        <div class="flex-grid-wrapper">
            <div class="posts-grid posts-grid--tight">
                @foreach ($category->posts([$post->id])->limit(10)->get() as $p)
                    <div class="posts-grid__item">
                        @include('posts/includes/post-preview', ['post' => $p])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection