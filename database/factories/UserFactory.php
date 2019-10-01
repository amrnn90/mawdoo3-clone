<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use FactoryHelpers\PostContentGenerator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique->realText(10),
    ];
});


$factory->define(App\Post::class, function (Faker $faker) {
    $users = App\User::limit(50)->get();

    if (!Storage::exists('public/posts')) {
        Storage::makeDirectory('public/posts');
    }

    if (count(Storage::allFiles('public/posts')) < 10) {
        for ($i = 0; $i < 10; $i++) {
            $faker->image(Storage::path('public/posts'), 640, 480, null, false);
        }
    }
    
    $images = Storage::allFiles('public/posts');
    $image = Storage::path($images[rand(0, count($images) - 1)]);
    $imageName = App\UploadedMedia::add($image, true)->name;

    $categories = App\Category::getCategoriesWithSub();
    $category = $categories->random();

    $content = app()->make(PostContentGenerator::class)->generate();

    return [
        'title' => $faker->realText(50),
        'content' => $content,
        'image' => $imageName,
        'category_id' => $category->id,
        'subcategory_id' => $category->subcategories->count() ? $category->subcategories->random()->id : null,
        'user_id' => $users->random()->id,
    ];
});
