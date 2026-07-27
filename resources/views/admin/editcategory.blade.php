<!-- Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="editCategoryModalLabel">
                    Edit Category
                </h5>

                <button type="button" class="close" data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">

                @csrf
                @method("PUT")
                <div class="modal-body">

                    @include('admin._categoryform', [
                        'button_label' => 'Update',
                        'is_modal' => true,
                    ])

                </div>

            </form>

        </div>

    </div>

</div>
