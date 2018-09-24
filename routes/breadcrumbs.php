<?php


Breadcrumbs::for('home', function ($trail) {
    $trail->push('الرئيسية', route('home'));
});

// Home > [Category]:
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');
    if ($category->parent) {
        $trail->push($category->parent->name, route('posts.index', $category->parent));
    }
    $trail->push($category->name, route('posts.index', $category));
});

// Home > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $category = $post->subcategory_id ? $post->subcategory : $post->category;

    $trail->parent('category', $category);

    $trail->push($post->title, route('posts.show', $post));
});
