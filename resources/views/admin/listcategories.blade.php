@extends('admin.maindesign')
@section('listcategory')

<div class="container">
    <h2>Categories List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->isEmpty())
                <tr>
                    <td class="text-center align-middle" colspan="2">No categories found.</td>
                </tr>
            @else
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection