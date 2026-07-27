
        $('.dropdown-item').on('click', function(e) {
            // منع الصفحة إنها تعمل Refresh لو اللينك فيه #
            e.preventDefault();

            // 1. جلب بيانات اللغة اللي اتداس عليها
            var newImg = $(this).find('img').attr('src');
            var newText = $(this).find('span').text();

            // 2. تحديث الزرار الرئيسي (العلم والنص)
            $('#languages img').attr('src', newImg);
            $('#languages span').text(newText);
        });
//

        window.addEventListener('load', function () {
            document.getElementById('loadingScreen').classList.add('hide');
        });

        document.querySelectorAll('a').forEach(function(link) {

            // تجاهل اللينكات الفارغة أو اللي بتفتح Modal
            if (
                link.getAttribute('href') &&
                !link.getAttribute('href').startsWith('#') &&
                link.getAttribute('target') !== '_blank'
            ) {
                link.addEventListener('click', function() {
                    document.getElementById('loadingScreen').classList.remove('hide');
                });
            }
        });
//

$(document).ready(function () {

    $('.edit-product').on('click', function () {

        let id = $(this).data('id');

        $.ajax({

            url: '/admin/products/' + id + '/edit',

            type: 'GET',

            success: function (product) {

                // Hidden ID
                $('#product_id').val(product.id);

                // Inputs
                $('#product_title').val(product.title);
                $('#product_description').val(product.description);
                $('#product_quantity').val(product.quantity);
                $('#product_price').val(product.price);

                // Select
                $('#product_category').val(product.category_id);

                // Form Action
                $('#editProductForm').attr(
                    'action',
                    '/admin/editProduct/' + product.id
                );

                // Open Modal
                $('#editProductModal').modal('show');

            },

            error: function () {

                alert('Something went wrong.');

            }

        });

    });

});

//
$(function () {

    $('.edit-category').click(function () {

        let id = $(this).data('id');

        $.ajax({

            url: '/admin/categories/' + id + '/edit',

            type: 'GET',

            success: function (response) {

                let category = response.category;

                // Form action
                $('#editCategoryForm').attr(
                    'action',
                    '/admin/editCategory/' + category.id
                );

                // Hidden id
                $('#category_id').val(category.id);

                // Name
                $('#category_name').val(category.name);

                // Description
                $('#category_description').val(category.description);

                // Image
                if(category.image){

                    $('#image_preview')
                        .attr('src','/storage/' + category.image)
                        .show();

                }else{

                    $('#image_preview').hide();

                }

                // Status
                $('input[name=status][value="'+category.status+'"]')
                    .prop('checked',true);

                // Parent Select
                let select = $('#parent_id');

                select.empty();

                select.append('<option value="">Select Parent</option>');

                response.parents.forEach(function(parent){

                    select.append(
                        '<option value="'+parent.id+'">'+
                        parent.name+
                        '</option>'
                    );

                });

                select.val(category.parent_id);
                
                console.log(response);
                // Show Modal
                $('#editCategoryModal').modal('show');

            }

        });

    });

});
