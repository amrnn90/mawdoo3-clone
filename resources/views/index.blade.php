@extends('layouts.app')

@section('title', 'موضوع، أكبر موقع عربي بالعالم')

@section('content')
    <main class="homepage">
        @include('includes.hero', ['posts' => $latestPosts])
    
        <div class="container">
            <section class="section section-categories">
                <div class="section-title-wrapper">
                    <h2 class="section-title">
                        تصنيفات موضوع
                    </h2>
                </div>
                @include('includes.categories-grid', ['categories' => $categories])
            </section>
        </div>
    </main>
@endsection