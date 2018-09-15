@php
    $post = $post ?? new \App\Post();
    $route = $post->exists ? route('posts.update', $post) : route('posts.store');
@endphp

<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" id="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id)  ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" rows="6" id="content" class="form-control">{{ old('content', $post->content) }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">{{ $post->exists ? 'Update' : 'Publish' }} Post</button>
    </div>
</form>