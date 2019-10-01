@extends('layouts.app')

@section('title', "تعديل: $post->title - موضوع")

@section('content')
    <div class="container">
        @include('posts.includes.form')
    </div>
@endsection