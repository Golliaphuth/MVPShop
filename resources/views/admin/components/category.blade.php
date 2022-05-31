<ul>
    @foreach($categories as $category)
        <li>
            {{ $category->translate->name }}
            @if($category->childs()->count())
                @include('admin.components.category', ['categories' => $category->childs])
            @endif
        </li>
    @endforeach
</ul>
