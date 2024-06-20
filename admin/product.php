<?php
include('includes/header.php');
include('../functions/myfunctions.php');

if (isset($_SESSION['admin'])) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body" id="product_table">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Selling Price</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $product = getAll("products");
                            if(mysqli_num_rows($product) > 0) {
                                foreach ($product as $item) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['id']) ?></td>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><?= htmlspecialchars($item['slug']) ?></td>
                                        <td>
                                            <img src="../upload/<?= htmlspecialchars($item['image']); ?>" width="90px" height="90px" alt="<?= htmlspecialchars($item['product_name']); ?>">
                                        </td>
                                        <td><?= htmlspecialchars($item['selling_price']) ?></td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= htmlspecialchars($item['color']) ?></td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden" ?></td>
                                        <td>
                                            <a href="edit-product.php?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger  delete_product_btn" value="<?=$item['id'];?>" type="button">Delete</button>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No records found</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('includes/footer.php');

} else {
    header("location: ../login.php");
    exit();
}
?>
