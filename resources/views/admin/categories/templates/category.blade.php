<ul>
    @foreach($categories as $category)
        <li>
            <div class="category-header context-actions" data-id="{{ $category->id }}" data-sort="{{ $category->sort }}">
                @if($category->children->count() > 0)
                <div class="arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
                @endif
                <div class="category-name">{{ $category->translate->name }}</div>
                <div class="category-sort"
                     data-id="{{ $category->id }}"
                     data-action="{{ route('admin.categories.sort', ['category' => $category->id, 'vector' => 'decrement']) }}" >
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="category-sort"
                     data-id="{{ $category->id }}"
                     data-action="{{ route('admin.categories.sort', ['category' => $category->id, 'vector' => 'increment']) }}" >
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="category-create"
                     data-id="{{ $category->id }}"
                     data-action-edit="{{ route('admin.categories.edit', ['category' => $category->id, 'new' => true]) }}"
                     data-action-save="{{ route('admin.categories.store') }}" >
                    <i class="fas fa-plus"></i>
                </div>
                <div class="category-edit"
                     data-id="{{ $category->id }}"
                     data-action-edit="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                     data-action-save="{{ route('admin.categories.update', ['category' => $category->id]) }}" >
                    <i class="fas fa-edit"></i>
                </div>
            </div>
            @if($category->children->count() > 0)
            <div class="category-children">
                @include('admin.categories.templates.category', ['categories' => $category->children])
            </div>
            @endif
        </li>
    @endforeach
</ul>
