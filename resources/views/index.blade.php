@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h1>Welcome</h1>
            <a href="{{ route('posts.create') }}">Create Post</a>
        </div>
        <div class="jumbotron">
            <h2 class="mb-4">Categories</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-3">
                        <a href="{{ route('posts.index', $category) }}">{{ $category->name }}</a>
                    </div>
                @endforeach
            </div>
            <example-component></example-component>
        </div>
    </div>
@endsection