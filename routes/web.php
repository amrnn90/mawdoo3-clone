<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/posts/', 'PostsController@index')->name('posts.index');
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/edit/{post}', 'PostsController@edit')->name('posts.edit');
Route::post('/posts', 'PostsController@store')->name('posts.store');
Route::post('/posts/{post}', 'PostsController@update')->name('posts.update');
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::get('/category/{category}', 'PostsController@indexForCategory')->name('posts.indexForCategory');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');

Route::get('/uploads', 'UploadsController@load')->name('uploads.load');
Route::post('/uploads', 'UploadsController@store')->name('uploads.store');
Route::delete('/uploads', 'UploadsController@revert')->name('uploads.revert');