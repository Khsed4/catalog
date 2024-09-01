<select class="form-select form-select-sm" name="category_id" id='category' disabled>
    <option value="0">ALL</option>
    @for ($i = 0; $i < count($categories); $i++)
        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
    @endfor
</select>
