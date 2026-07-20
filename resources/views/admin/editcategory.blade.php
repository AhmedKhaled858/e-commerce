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
                @include("admin._categoryform",['button_label'=>'Update','is_modal'=>true])
                </div>

            </form>
        </div>
    </div>
</div>
