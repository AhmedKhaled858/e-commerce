@extends('admin.maindesign')
@section('trashcategory')
    <div class="container -mb-px">
        <h2>Categories Trash</h2>
        <div class="m-2">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
        <br>
        <form action="{{ route('admin.trashCategory') }}" method="GET" class="d-flex justify-content-between mb-4">
            <x-form.input name="search" type="text" class="mx-3" placeholder="Search categories Trash..."
                value="{{ request('search') }}" />
            <button type="submit" class="btn btn-primary mx-2">Search</button>
        </form>
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- here for else & empty using if category collection have a data return it and if not (empty) return the message --}}
                @forelse($categories as $category)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>

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
                        <td>{{ Str::title($category->status) }}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>

                            <div style="display: flex; justify-content: center; gap: 10px;">
                                {{-- <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $category->id }}">
                                    <i class="las la-pen"></i>Edit</a> --}}

                                <form action="{{ route('admin.restoreCategory', $category->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                                </form>
                                <form action="{{ route('admin.forceDeleteCategory', $category->id) }}" method="POST"
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
                        <td class="text-center" colspan="8">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $categories->withQueryString()->links() }}
        <script src="{{ asset('front_end/js/timeout.js') }}"></script>
    @endsection
