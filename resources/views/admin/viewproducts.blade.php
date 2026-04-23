@extends('admin.maindesign')
@section('listcategory')
    <style>
        #loadingScreen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #22252a;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #ccc;
            border-top: 5px solid #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>
    @if (session('success'))
        <div class="alert alert-success" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h2>Products List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
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
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td> <img src="{{ asset($product->product_image) }}" width="80" height="80" load="lazy"
                                    alt="{{ $product->title }}" style="object-fit:cover;"></td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $product->id }}"><i class="las la-pen"></i>Edit</a>
                                <form action="{{route('admin.deleteProduct', $product->id)}}" method="POST" style="display: inline;">
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
        <script>
            setTimeout(function() {
                let alertBox = document.getElementById('successAlert');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 3000);
        </script>
        <script>
            window.addEventListener("load", function() {
                document.getElementById("loadingScreen").style.display = "none";
            });
        </script>
    @endsection
