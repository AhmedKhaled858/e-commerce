<x-form.input type="hidden" name="product_id" id="product_id" value="{{ $product->id ?? '' }}" />

<x-form.label id="product_title">Product Title </x-form.label>
<x-form.input type="text" id="product_title" name="product_title" placeholder="Enter Product Title" required />
<br>

<x-form.label id="product_description"> Product Description</x-form.label>
<x-form.textare id="product_description" name="product_description" placeholder="Enter Product Description" />
<br>

<x-form.label id="product_quantity"> Product Quantity</x-form.label>
<x-form.input type="number" id="product_quantity" name="product_quantity" placeholder="Enter Product Quantity"
    required />

<br>

<x-form.label id="product_price"> Product Price</x-form.label>
<x-form.input type="number" id="product_price" name="product_price" placeholder="Enter Product Price for per unit"
     />

<br>

<x-form.label id="product_image"> Product Image</x-form.label>
<x-form.input type="file" id="product_image" name="product_image" placeholder="Enter Product Image"  />
<br>
<x-form.label id="tags">Tags</x-form.label>
<x-form.input id="tags" name="tags"  placeholder="Enter tags "  />

<br>

<x-form.label id="product_category">Category</x-form.label>
<x-form.select id="product_category" name="product_category" :options="$categories" placeholder="Select Category" required />
<div class="modal-footer">

    <button type="submit" class="btn btn-primary">

        {{ $button_label ?? 'Submit' }}

    </button>

    @if ($is_modal ?? true)
        <button type="button" class="btn btn-secondary" data-dismiss="modal">

            Close

        </button>
    @else
        <a href="{{ route('admin.ViewProducts') }}" class="btn btn-secondary">

            Back

        </a>
    @endif

</div>
@push('styles')
    <link href="{{ asset('admin/css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush
    
@push('scripts')
   <script src="{{ asset('admin/js/tagify.js') }}"></script>
<script>
  
    var inputElm = document.querySelector('[name=tags]');
    tagify = new Tagify (inputElm);
</script>
@endpush



   
    

