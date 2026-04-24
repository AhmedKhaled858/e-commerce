@extends('admin.maindesign')

@section('addproduct')

    @if (session('success'))
        <div class="alert alert-success" id="alertBox">
            {{ session('success') }}
        </div>
    @endif

    {{-- @if ($errors->any())
        <div class="alert alert-danger" id='alertBox'>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Product</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">

                                <label for="product_title">Product Title</label>
                                <input type="text" name="product_title" id="product_title" required
                                    value="{{ old('product_title') }}" placeholder="Enter Product title"
                                    class="form-control">
                                @error('product_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>

                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" name="product_description" id="product_description" required cols="30" rows="10"
                                    placeholder="Enter Product Description">{{ old('product_description') }}</textarea>
                                @error('product_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>

                                <label for="product_quantity">Product Quantity</label>
                                <input type="number" name="product_quantity" id="product_quantity"  min="0" required
                                    value="{{ old('product_quantity') }}" placeholder="Enter Product Quantity" 
                                    class="form-control">
                                @error('product_quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>

                                <label for="product_price">Product Price</label>
                                <input type="number" name="product_price" id="product_price" required  min="0" step="0.01"
                                    value="{{ old('product_price') }}" placeholder="Enter Product Price"
                                    class="form-control">
                                @error('product_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>

                                <label for="product_image">Product Image</label>
                                <input type="file" name="product_image" id="product_image" required class="form-control">
                                @error('product_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>

                                <label for="product_category">Category</label>
                                <select name="product_category" id="product_category" class="form-control">

                                    <option value="" style="color: black">Select Category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" required style="color: black"
                                            {{ old('product_category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('product_category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Add Product</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>

@endsection
