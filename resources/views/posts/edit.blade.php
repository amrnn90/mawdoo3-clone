@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Edit Post: <span class="text-dimmed">{{ $post->title }}</span></h1>
                @include('posts.includes.form')
            </div>
        </div>
    </div>
@endsection