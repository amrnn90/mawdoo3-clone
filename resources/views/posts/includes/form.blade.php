@php
    $post = $post ?? new \App\Post();
    $route = $post->exists ? route('posts.update', $post) : route('posts.store');
@endphp

{{-- @if($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif --}}


<form action="{{ $route }}" class="post-form parsley" method="POST" enctype="multipart/form-data" data-parsley-focus="none">
    @csrf
    <h1 class="post-form__header">
        @if ($post->exists)
            تعديل: {{$post->title }} 
        @else 
            اكتب موضوع جديد
        @endif
    </h1>

    <div class="post-form__groups-wrapper">
        <div class="post-form__group post-form__group--1">
            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" id="title" class="form-control" required autofocus>
            </div>
        </div>
    
        <div class="ppost-form__group post-form__group--2">
            <div class="form-group">
                <label for="category_id">القسم</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id)  ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">الصورة</label>
                <input type="file" name="image" id="image" data-source="{{ old('image', $post->imageName) }}" class="form-control-file">
                <input type="hidden" value="_" data-parsley-filepond="#image">
            </div>
        </div>
    
    
        <div class="post-form__group post-form__group--3">
            <div class="form-group">
                <label for="content">المحتوى</label>
                <textarea name="content" rows="6" id="content" class="tinymce-el form-control" required>{{ old('content', $post->content) }}</textarea>
            </div>
        </div>

    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">{{ $post->exists ? 'اتمام التعديل' : 'انشر الموضوع' }} </button>
    </div>
</form>