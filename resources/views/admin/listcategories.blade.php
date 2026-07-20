@extends('admin.maindesign')
@section('listcategory')
    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>
    <div class="container">
        <h2>Categories List</h2>
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>created_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- here for else & empty using if category collection have a data return it and if not (empty) return the message --}}
                @forelse($categories as $category)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                        <td>
                            <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $category->description }}
                            </div>
                        </td>
                        <td>
                            @if ($category->image)
                                <img class="img-thumbnail" id='img-cover' src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td>

                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $category->id }}">
                                    <i class="las la-pen"></i>Edit</a>

                                <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>

                        </td>

                    </tr>
                    @include('admin.editcategory')
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <script src="{{ asset('front_end/js/timeout.js') }}"></script>
    @endsection
