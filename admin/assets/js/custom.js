$(document).ready(function () {
    $('.delete_product_btn').click(function (e) {
        e.preventDefault();

        var id = $(this).val();
        // alert(id);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "/smartasia/admin/category-function.php",
                    data: {
                        'product_id': id,
                        'delete_product_btn': true,
                    },
                    success: function (response) {
                        console.log(response); // This should output "File reached!" if successful
                        if (response == 200) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        } else if (response == 500) {
                            Swal.fire({
                                title: "Error!",
                                text: "Something Went Wrong.",
                                icon: "error"
                            });
                        } else if (response == 404) {
                            Swal.fire({
                                title: "Error!",
                                text: "Product not found.",
                                icon: "error"
                            });
                        }
                    }
                });

            }
        });
    });
});
