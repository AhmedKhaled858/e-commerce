<label for="category_name">Category Name</label>
{{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
<input type="text"  id="category_name" name="category_name" value="{{ $category->name ?? '' }}" class="form-control" required>
@error('category_name')
    <small class="text-danger">{{ $message }}</small>
@enderror
<br>
<label for="parent_id">Parent Category</label>
<select  id="parent_id" name="parent_id" class="form-control">
    <option value="">None</option>
    @foreach ($categories as $parentCategory)
        {{-- if the category is a parrent for another when go to this cat can't select child cat --}}

        @if ($parentCategory->id !== $category->id && $parentCategory->parent_id !== $category->id)
            <option value="{{ $parentCategory->id }}"
                {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                {{ $parentCategory->name }}
            </option>
        @endif
    @endforeach
</select>
@error('parent_id')
    <small class="text-danger">{{ $message }}</small>
@enderror
<br>
<label for="category_description">Category Description</label>
<textarea  id="category_description" name="category_description" class="form-control">{{ $category->description }}</textarea>
@error('description')
    <small class="text-danger">{{ $message }}</small>
@enderror
<br>
<label for="category_image">Category Image</label>

<input
    type="file"
    name="category_image"
    class="form-control"
    onchange="previewImage(this)">

@error('category_image')
    <small class="text-danger">{{ $message }}</small>
@enderror

<img
    class="img-thumbnail image-preview"
    src="{{ !empty($category->image) ? asset('storage/'.$category->image) : '' }}"
    alt="Preview"
    style="width:80px;height:80px;object-fit:cover;
           {{ empty($category->image) ? 'display:none;' : '' }}">
<br>
<label for="status"> Category Status</label>
<div class="form-check" id="status">
    <input class="form-check-input" type="radio" name="status" value='active' id="statusActive"
        {{ $category->status === 'active' ? 'checked' : '' }}>
    <label class="form-check-label" for="statusActive">
        Active
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" value="archived" name="status" id="statusArchived"
        {{ $category->status === 'archived' ? 'checked' : '' }}>
    <label class="form-check-label" for="statusArchived">
        Archived
    </label>
</div>


<div class="modal-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Submit' }}</button>
    @if($is_modal ?? true)
        <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">
            Close
        </button>
    @else
        <a href="{{ route('admin.listCategories') }}"
           class="btn btn-secondary">
            Back
        </a>
    @endif
</div>

<script>
function previewImage(input) {
    const preview = input.parentElement.querySelector('.image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>