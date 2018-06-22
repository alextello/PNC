<header class="container-flex space-between">
        <div class="date">
        <span class="c-gris">{{ optional($post->published_at)->format('M d') }} / {{ $post->owner->name }}</span>
        <hr>
        <span class="label label-warning"><a href="{{ route('subcategories.show', $post->tags->subcategory ) }}">{{ $post->tags->subcategory->name }}</a></span>
        </div>
        <div class="post-category">
        <span class="category"><a href="{{ route('categories.show', $post->tags->subcategory->category )}}">{{ $post->tags->subcategory->category->name }}</a></span>
        </div>
      </header>