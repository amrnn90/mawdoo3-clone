@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <h4>Popular Categories</h4>
                    @foreach ($popularCategories as $category)
                        <div class="list-group-item">
                            <a href="#">{{ $category->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                <h4>{{ $category->name }}</h4>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card">
                                <a href="{{ route('posts.show', $post) }}" class="card-body">
                                    <div class="card-title h5">{{ $post->title }}</div>
                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="card-img">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection