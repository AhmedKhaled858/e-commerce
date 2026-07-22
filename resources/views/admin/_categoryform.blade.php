
{{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
<x-form.label id="category_name">Category Name</x-form.label>
<x-form.input type="text" id="category_name" name="category_name" placeholder="Enter category name" value="{{ old('category_name',$category->name) }}" />
<br>
<x-form.label id="parent_id">Parent Category</x-form.label>
<x-form.select
    id="parent_id"
    name="parent_id"
    :options="$category->availableParents()"
    :value="$category->parent_id"
    placeholder="Select"
/>
<br>

<x-form.label id="category_description">Category Description</x-form.label>
<x-form.textare id="category_description" name="category_description" placeholder="Enter category description" value="{{ old('category_description',$category->description) }}" />
<br>
<x-form.label id="category_image">Category Image</x-form.label>
<x-form.input type="file" id="category_image" name="category_image" accept="image/*" onchange="previewImage(this)" />
<img
    class="img-thumbnail image-preview"
    src="{{ !empty($category->image) ? asset('storage/'.$category->image) : '' }}"
    alt="Preview"
    style="width:80px;height:80px;object-fit:cover;
           {{ empty($category->image) ? 'display:none;' : '' }}">
<br>
<x-form.label id="status">Status</x-form.label>
<x-form.radio id="status" name="status" :options="['active' => 'Active', 'archived' => 'Archived']" :selected="old('status',$category->status)" />
    
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