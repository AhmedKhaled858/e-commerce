@extends('admin.maindesign')
@section('listcategory')

    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>
    <div class="container-fluid px-5">
        <h2>Products List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th style="width:150px;">Actions</th>
                </tr>
                
            </thead>
            <tbody>

                @if ($products->isEmpty())
                    <tr>
                        <td class="text-center align-middle" colspan="3">No products found.</td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td style="max-width:220px; white-space:normal; word-break:break-word;">
                                {{ Str::limit($product->description, 80, '...') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td> <img src="{{ asset('storage/' . $product->product_image) }}" width="80" height="80"
                                    load="lazy" alt="{{ $product->title }}" style="object-fit:cover;"></td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $product->id }}"><i class="las la-pen"></i>Edit</a>
                                <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>

                        </tr>
                        @include('admin.editproduct')
                    @endforeach
                    {{ $products->links() }}
                @endif
            </tbody>

        </table>
        <script src="{{ asset('front_end/js/timeout.js') }}"></script>
         
    @endsection
