@extends('admin.maindesign')

@section('createcategory')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.storeCategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="category_name" id="category_name"
                                    placeholder="Enter Category Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                              <div class="form-group">
                                <label for="description">Category Description</label>
                                <textarea name="category_description" id="category_description" 
                                    placeholder="Enter Category Description" class="form-control" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_image">Category Image</label>
                                <input type="file" name="category_image" id="category_image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src ="{{ asset('front_end/js/timeout.js') }}"></script>
        
@endsection
