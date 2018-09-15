<?php


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Homepage', route('home'));
});

// Home > [Category]:
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');
    $trail->push($category->name, route('posts.index', $category));
});

// Home > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('posts.show', $post));
});
