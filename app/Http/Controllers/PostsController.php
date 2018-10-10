<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostForm;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\PostFilter;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['indexForCategory', 'index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->query();
        if (!(isset($params['latest']) or isset($params['mostViewed']))) {
            $params['latest'] = 1;
        }
        $posts = PostFilter::filter($params)->paginate(12)->appends(request()->except(['page','_token']));;

        return view('posts.index')->with(compact('posts', 'category'));
    }

    public function indexForCategory(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(12);

        return view('posts.indexForCategory')->with(compact('posts', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostForm $request)
    {
        // dd($request->all());
        $data = $request->only(['title', 'content', 'category_id', 'subcategory_id', 'image']);
        $data['content'] = clean($data['content']);
        $data['image'] = $data['image'] ?? null;

        $post = Post::create($data);

        session()->flash('success', 'Post created successfully.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->view();
        return view('posts.show')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('posts.edit')->with(compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostForm $request)
    {
        $this->authorize('edit', $post);

        $data = $request->only(['title', 'content', 'category_id', 'subcategory_id', 'image']);
        $data['content'] = clean($data['content']);
        $data['image'] = $data['image'] ?? null;

        $post->fill($data);
        $post->save();

        session()->flash('success', 'Post updated successfully.');

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        session()->flash('success', 'Post was deleted.');

        return redirect('/');
    }
}
