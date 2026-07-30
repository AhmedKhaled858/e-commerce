@extends('admin.maindesign')
@section('viewproducts')
    <div class="container-fluid px-5">

        <h2>{{ $category->name }}</h2>
        <div class="m-2">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Store</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $products = $category->products()->with('store')->latest()->paginate(5);
                @endphp
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td>{{ $product->title }}</td>
                        <td style="max-width:220px; white-space:normal; word-break:break-word;">
                            {{ Str::limit($product->description, 80, '...') }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status }}</td>
                        <td> <img class="img-thumbnail" src="{{ asset('storage/' . $product->product_image) }}" width="80"
                                height="80" load="lazy" alt="{{ $product->title }}" style="object-fit:cover;"></td>
                        <td>{{ $product->store->name ?? '' }}</td>


                    </tr>
                @empty
                    <tr>
                        <td class="text-center align-middle" colspan="8">No products found.</td>
                    </tr>
                @endforelse

            </tbody>

        </table>
        {{ $products->withQueryString()->links() }}
    </div>
@endsection
