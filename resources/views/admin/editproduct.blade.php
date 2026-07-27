<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">
                    Edit Product
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="editProductForm" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">
                    
                    <input type="hidden" name="id" id="product_id">

                    <label for="product_title">Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control">

                    <br>

                    <label for="product_description">Product Description</label>

                    <textarea name="product_description" id="product_description" rows="6" class="form-control"></textarea>

                    <br>

                    <label for="product_quantity">Product Quantity</label>

                    <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                        min="0">

                    <br>

                    <label for="product_price">Product Price</label>

                    <input type="number" step="0.01" min="0" name="product_price" id="product_price"
                        class="form-control">

                    <br>

                    <label for="product_image">Product Image</label>

                    <input type="file" name="product_image" id="product_image" class="form-control">

                    <br>

                    <label for="product_category">Category</label>

                    <select name="product_category" id="product_category" class="form-control">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
