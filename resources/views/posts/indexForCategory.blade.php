@extends('layouts.withsidebar')

@section('title', "تصنيف: {$category->name} - موضوع")

@section('main-content')
    <div class="tabs">
        <div class="tabs__tab tabs__tab--active">
            {{ $category->name }}
        </div>
    </div>
    
    <div class="flex-grid-wrapper">
        <div class="posts-grid">            
            @foreach ($posts as $post)
                <div class="posts-grid__item">
                    @include('posts/includes/post-preview', ['post' => $post])
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>
    <a href="javascript:" class="btn btn--full btn--gray my-5 load-more {{!$posts->hasMorePages() ? 'no-more-items' : ''}}">عرض المزيد من المواضيع</a>
@endsection

@section('sidebar')
    @if ($category->subcategories()->exists())
        <div class="sidebar-section">
            <h4 class="sidebar-section__header">
                تصنيفات فرعية
            </h4>
            @foreach ($category->subcategories as $c)
                <a href="{{ route('posts.indexForCategory', $c) }}" class="sidebar-section__link">{{ $c->name }}</a>
            @endforeach
        </div>
    @endif

    <div class="sidebar-section">
        <h4 class="sidebar-section__header">
            أهم التصنيفات
        </h4>
        @foreach ($popularCategories as $c)
            <a href="{{ route('posts.indexForCategory', $c) }}" class="sidebar-section__link">{{ $c->name }}</a>
        @endforeach
    </div>
@endsection