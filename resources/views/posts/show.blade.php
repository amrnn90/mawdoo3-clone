@extends('layouts.app')

@section('title', "$post->title - موضوع")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9 offset-3">
                {{ Breadcrumbs::render('post', $post) }}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                @php
                     $visitorsReadPosts = $post->visitorsAlsoRead();
                     $category = $post->category;
                     $author = $post->author;
                @endphp
                <h4>Visitors also read</h4>
                <div class="row no-gutters">
                    @foreach ($visitorsReadPosts as $p)
                        <div class="col-6">
                            <div class="card">
                                <a href="{{ route('posts.show', $p) }}" class="card-body">
                                    <div class="card-title h5">{{ $p->title }}</div>
                                    <img src="{{ asset($p->image) }}" alt="{{ $p->title }}" class="card-img">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h4>Posts in {{ $category->name }}</h4>
                <div class="list-group">
                    <div class="row no-gutters">
                        @foreach ($category->posts([$post->id])->inRandomOrder()->limit(7)->get() as $p)
                            <div class="col-6">
                                <div class="card">
                                    <a href="{{ route('posts.show', $p) }}" class="card-body">
                                        <div class="card-title h5">{{ $p->title }}</div>
                                        <img src="{{ asset($p->image) }}" alt="{{ $p->title }}" class="card-img">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-9">
                <h2>
                    {{ $post->title }}
                    @can('edit', $post)
                        <small>[<a href="{{ route('posts.edit', $post) }}">edit</a>]</small>
                    @endcan
                    @can('destroy', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline">
                            @csrf @method('DELETE')
                            [<a href="javascript:" class="text-danger" onclick="this.parentNode.submit()"><small>delete</small></a>]
                        </form>
                    @endcan
                </h2>
                <div class="mb-4">
                    <div>{{ $post->created_at->toFormattedDateString() }}</div>
                    Authored by <strong>{{ $author->name }}</strong> in 
                    <a href="{{ route('posts.index', $category) }}">{{$category->name}}</a>
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 100%">
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5>Related Posts</h5>
                        <div class="list-group">
                            @foreach ($post->relatedPosts(6) as $p)
                                <a href="{{ route('posts.show', $p) }}" class="list-group-item">
                                    {{ $p->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-8">
                        <article>
                            {!! $post->content !!}
                        </article>
                        <div class="alert alert-info">
                            post was viewed <strong> {{ $post->viewCount }} {{str_plural('time', $post->viewCount)}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection