@extends('layouts.withsidebar')

@php
    $isMostViewed = request()->has('mostViewed');
    $isLatest = !$isMostViewed;
@endphp

@if ($isMostViewed)    
    @section('title', 'الأكثر مشاهدة - موضوع')
@else
    @section('title', 'أحدث المواضيع - موضوع')
@endif

@section('main-content')
        <div class="tabs">
            <div class="tabs__tab {{ $isLatest ? 'tabs__tab--active' : '' }}">
                <a href="{{ route('posts.index', ['latest' => 1]) }}" class="tabs__tab-link" data-no-swup>
                    أحدث المواضيع
                </a>
            </div>
            <div class="tabs__tab {{ $isMostViewed ? 'tabs__tab--active' : '' }}">
                <a href="{{ route('posts.index', ['mostViewed' => 1]) }}" class="tabs__tab-link" data-no-swup>
                    الأكثر مشاهدة
                </a>
            </div>
        </div>
        
        <div class="posts-list">
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
            <a href="javascript:" class="btn btn--full btn--gray load-more {{!$posts->hasMorePages() ? 'no-more-items' : ''}}">عرض المزيد من المواضيع</a>
        </div>
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