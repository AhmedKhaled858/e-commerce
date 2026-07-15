<!-- Modal -->
<div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.editCategory', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                {{-- {{ method_field('patch') }} --}}
                {{-- {{ csrf_field() }} --}}
                @csrf
                <div class="modal-body">
                    <label for="category_name">Category Name</label>
                    {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
                    <input type="text" name="category_name" value="{{ $category->name }}" class="form-control">
                    <label for="parent_id">Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach ($categories as $parentCategory)
                            @if ($parentCategory->id !== $category->id)
                                <option value="{{ $parentCategory->id }}"
                                    {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                    {{ $parentCategory->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <label for="exampleInputPassword1">Category Description</label>
                    <textarea name="category_description" class="form-control">{{ $category->description }}</textarea>
                    <label for="exampleInputPassword1">Category Image</label>
                    <input type="file" name="category_image" class="form-control">
                    <label for="exampleInputPassword1"> Category Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value='active' id="statusActive"
                            {{ $category->status === 'active' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusActive">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="archived" name="status"
                            id="statusArchived" {{ $category->status === 'archived' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusArchived">
                            Archived
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
