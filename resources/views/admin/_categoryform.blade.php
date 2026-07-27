<input type="hidden" id="category_id" name="id">

<x-form.label id="category_name">
    Category Name
</x-form.label>

<x-form.input
    type="text"
    id="category_name"
    name="category_name"
    placeholder="Enter category name"
/>

<br>

<x-form.label id="parent_id">
    Parent Category
</x-form.label>

<x-form.select
    id="parent_id"
    name="parent_id"
    :options="[]"
    placeholder="Select Parent Category"
/>

<br>

<x-form.label id="category_description">
    Category Description
</x-form.label>

<x-form.textare
    id="category_description"
    name="category_description"
    placeholder="Enter category description"
/>

<br>

<x-form.label id="category_image">
    Category Image
</x-form.label>

<x-form.input
    type="file"
    id="category_image"
    name="category_image"
    accept="image/*"
    onchange="previewImage(this)"
/>

<img
    id="image_preview"
    class="img-thumbnail image-preview"
    src=""
    style="display:none;width:80px;height:80px;object-fit:cover;"
>

<br>

<x-form.label id="status">
    Status
</x-form.label>

<x-form.radio
    id="status"
    name="status"
    :options="[
        'active'=>'Active',
        'archived'=>'Archived'
    ]"
/>

<div class="modal-footer">

    <button
        type="submit"
        class="btn btn-primary">

        {{ $button_label ?? 'Submit' }}

    </button>

    @if($is_modal ?? true)

        <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal">

            Close

        </button>

    @else

        <a
            href="{{ route('admin.listCategories') }}"
            class="btn btn-secondary">

            Back

        </a>

    @endif

</div>

<script>

function previewImage(input){

    let preview=document.getElementById('image_preview');

    if(input.files && input.files[0]){

        let reader=new FileReader();

        reader.onload=function(e){

            preview.src=e.target.result;

            preview.style.display='block';

        }

        reader.readAsDataURL(input.files[0]);

    }

}

</script>