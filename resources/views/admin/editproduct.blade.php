<!-- Modal -->
<div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.editProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                {{-- {{ method_field('patch') }} --}}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="product_title">Product Title</label>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="text" name="product_title" value="{{ $product->title }}" class="form-control">
                    <br>
                    <label for="product_description">Product Description</label>
                    <textarea name="product_description" id="product_description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                        <br>
                        <label for="product_quantity">Product Quantity</label>
                        <input type="text" name="product_quantity" value="{{ $product->quantity }}" class="form-control" min ="0">
                        <br>
                        <label for="product_price">Product Price</label>
                          <input type="text" name="product_price" value="{{ $product->price }}" class="form-control" min ="0" step="0.01">
                            <br>
                            <label for="product_image">Product Image</label>
                           <input type="file" name="product_image" value="{{$product->product_image}}" class="form-control">
                            <br>
                            <label for="product_category">Category</label>
                          <select name="product_category" id="product_category" class="form-control">
                                    <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit"
                        class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>