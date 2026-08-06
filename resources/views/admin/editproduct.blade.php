<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">
                    Edit Product
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="editProductForm" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">
                    @include('admin._productform',['button_label'=>'Update','is_modal'=>true])
                </div>

            </form>

        </div>
    </div>

</div>
