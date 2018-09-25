@extends('layouts.withsidebar')

@section('title', "")

@section('main-content')
    <div class="tabs">
        <div class="tabs__tab tabs__tab--active">
            أحدث المواضيع
        </div>
    </div>
    
    <div class="flex-grid-wrapper">
        <div class="posts-grid">            
            @foreach ($posts as $post)
                <div class="posts-grid__item">
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post) }}">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="post-preview__image">
                            <div class="post-preview__title">{{ $post->title }}</div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>
    <a href="javascript:" class="btn btn--full btn--gray load-more no-more-items">عرض المزيد من المواضيع</a>
@endsection

@section('sidebar')
    <div class="sidebar-section">
        <h4 class="sidebar-section__header">
            أهم التصنيفات
        </h4>
        @foreach ($popularCategories as $c)
            <a href="{{ route('posts.indexForCategory', $c) }}" class="sidebar-section__link">{{ $c->name }}</a>
        @endforeach
    </div>
@endsection