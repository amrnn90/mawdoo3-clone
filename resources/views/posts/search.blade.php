@extends('layouts.app')

@section('title', 'بحث - موضوع')

@section('content')
    <div class="search-page container">
        <h1 class="page-title">
            نتائج البحث عن: {{ request('q') }}
        </h1>

        <div class="search-results">
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
        </div>
    </div>
@endsection