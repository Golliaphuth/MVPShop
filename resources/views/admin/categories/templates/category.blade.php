
<ul class="category-ul">
    @foreach($categories as $category)
        <li class="category-li">
            <div class="category-name @if($category->children()->count()) with-children @endif">
                @if($category->children()->count())
                    <span class="category-toggle">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif
                {{ $category->translate->name }}
            </div>
            <div class="category-children">
                @if($category->children()->count())
                    @include('admin.categories.templates.category', ['categories' => $category->children])
                @endif
            </div>
        </li>
    @endforeach
</ul>
