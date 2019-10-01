@extends('layouts.app')

@section('title', 'أكتب موضوعك - موضوع')

@section('content')
    <div class="container">
        @include('posts.includes.form')
    </div>
@endsection
