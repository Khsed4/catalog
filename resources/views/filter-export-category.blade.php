<select class="form-select form-select-sm" name="category_id" id='fCategory' disabled>
    @for ($i = 0; $i < count($categories); $i++)
        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>
    @endfor
</select>
