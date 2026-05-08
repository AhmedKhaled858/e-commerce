@extends('admin.maindesign')
@section('listcategory')

<div class="container">
    <h2>Categories List</h2>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->isEmpty())
                <tr>
                    <td class="text-center align-middle" colspan="3">No categories found.</td>
                </tr>
            @else
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>

                        <div style="display: flex; justify-content: center; gap: 10px;">
                             <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $category->id }}"><i
                                                    class="las la-pen"></i>Edit</a>
                        <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        </div>
                     
                    </td>

                </tr>
                    @include('admin.editcategory')
                @endforeach
            @endif
        </tbody>
    </table>
    <script src="{{ asset('front_end/js/timeout.js') }}"></script>
@endsection