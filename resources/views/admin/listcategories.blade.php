@extends('admin.maindesign')
@section('listcategory')
    <div class="container -mb-px">
        <h2>Categories List</h2>
        <div class="m-2">
            <a href="{{ route('admin.createCategory') }}" class="btn btn-sm btn-outline-info mr-2">Create</a>
            <a href="{{ route('admin.trashCategory') }}" class="btn btn-sm btn-outline-primary">Trash</a>
        </div>
        <br>
        <form action="{{ route('admin.listCategories') }}" method="GET" class="d-flex justify-content-between mb-4">
            <x-form.input name="search" type="text" class="mx-3" placeholder="Search categories..."
                value="{{ request('search') }}" />
            <x-form.select id="status" name="status" :options="[['id' => 'active', 'name' => 'Active'], ['id' => 'archived', 'name' => 'Archived']]" :value="request('status')" placeholder="Select Status" />
            <button type="submit" class="btn btn-primary mx-2">Search</button>
        </form>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Description</th>
                    <th>Products #</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>created_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- here for else & empty using if category collection have a data return it and if not (empty) return the message --}}
                @forelse($categories as $category)
                    <tr>

                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td><a href="{{ route('admin.showCategory', $category->id) }}">{{ $category->name }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                        <td>
                            <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $category->description }}
                            </div>
                        </td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            @if ($category->image)
                                <img class="img-thumbnail" id='img-cover' src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ Str::title($category->status) }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>

                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <button type="button" class="btn btn-sm btn-info edit-category"
                                    data-id="{{ $category->id }}">
                                    <i class="las la-pen"></i> Edit
                                </button>
                                {{-- <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                    href="#edit{{ $category->id }}">
                                    <i class="las la-pen"></i>Edit</a> --}}

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
                @empty
                    <tr>
                        <td class="text-center" colspan="8">No categories found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        {{ $categories->withQueryString()->links() }}
        @include('admin.editcategory')

        <script src="{{ asset('front_end/js/timeout.js') }}"></script>
    @endsection
