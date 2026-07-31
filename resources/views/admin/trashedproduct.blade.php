@extends('admin.maindesign')
@section('trash')
    <div class="container -mb-px">
        <h2>Products Trash</h2>
        <div class="m-2">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
        <br>
        <form action="{{ route('admin.trashProduct') }}" method="GET" class="d-flex justify-content-between mb-4">
            <x-form.input name="search" type="text" class="mx-3" placeholder="Search categories Trash..."
                value="{{ request('search') }}" />
            <button type="submit" class="btn btn-primary mx-2">Search</button>
        </form>
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- here for else & empty using if category collection have a data return it and if not (empty) return the message --}}
                @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->title }}</td>
                        <td>
                            <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $product->description }}
                            </div>
                        </td>
                        <td>
                            @if ($product->product_image)
                                <img class="img-thumbnail" id='img-cover' src="{{ asset('storage/' . $product->product_image) }}"
                                    alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ Str::title($product->status) }}</td>
                        <td>{{ $product->deleted_at }}</td>
                        <td>

                            <div style="display: flex; justify-content: center; gap: 10px;">
                                {{-- <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $category->id }}">
                                    <i class="las la-pen"></i>Edit</a> --}}

                                <form action="{{ route('admin.restoreProduct', $product->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                                </form>
                                <form action="{{ route('admin.forceDeleteProduct', $product->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->withQueryString()->links() }}
        <script src="{{ asset('front_end/js/timeout.js') }}"></script>
    @endsection
