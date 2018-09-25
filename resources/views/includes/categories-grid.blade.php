<div class="categories-grid">
    @foreach ($categories as $category)        
        @php
            $slug = str_slug($category->name);
        @endphp
        <div class="categories-grid__block categories-grid__block--{{$slug}}">
            <a href="{{ route('posts.indexForCategory', $category) }}" class="categories-grid__block-header">
                <span class="categories-grid__category-icon"></span>
                <h4 class="categories-grid__category-name">{{ $category->name }}</h4>
            </a>
            <div class="categories-grid__block-body">
                @foreach ($category->subcategories as $subcat)
                    <a  class="categories-grid__subcategory-name" href="{{ route('posts.indexForCategory', $subcat) }}">
                        {{ $subcat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</div>