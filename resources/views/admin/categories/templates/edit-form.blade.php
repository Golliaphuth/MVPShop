<form id="editCategoryForm" action="#" method="POST">

    @if($new)
        @foreach(config('app.locales') as $lng)
            <div class="input-group input-group-static mb-4">
                <label for="categoryName_{{$lng}}">Название {{$lng}}</label>
                <input name="name[{{$lng}}]" id="categoryName_{{$lng}}" type="text" class="form-control" value="">
            </div>
        @endforeach
            <div class="input-group input-group-static mb-4">
                <label for="categoryParent">Родительская категория</label>
                <select name="parent_id" id="categoryParent" class="form-control">
                    <option value="0">Без родительской катеогрии</option>
                    @foreach($categories as $category)
                        {{ category_select_render($category, 0, ($current) ? $current->id : null) }}
                    @endforeach
                </select>
            </div>
    @else
        @foreach($current->translates as $translate)
            <div class="input-group input-group-static mb-4">
                <label for="categoryName_{{$translate->lang}}">Название {{$translate->lang}}</label>
                <input name="name[{{$translate->lang}}]" id="categoryName_{{$translate->lang}}" type="text" class="form-control" value="{{ $translate->name }}">
            </div>
        @endforeach
            <div class="input-group input-group-static mb-4">
                <label for="categoryParent">Родительская категория</label>
                <select name="parent_id" id="categoryParent" class="form-control">
                    <option value="0">Без родительской катеогрии</option>
                    @foreach($categories as $category)
                        {{ category_select_render($category, 0, ($current->parent) ? $current->parent->id : null) }}
                    @endforeach
                </select>
            </div>
    @endif




</form>
