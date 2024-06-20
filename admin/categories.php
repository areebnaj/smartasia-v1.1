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
                        <h4>Categories</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $category = getAll("categories");
                            if(mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['id']) ?></td>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td>
                                            <img src="../upload/<?= htmlspecialchars($item['images']); ?>" width="90px" height="90px" alt="<?= htmlspecialchars($item['name']); ?>">
                                        </td>
                                        <td><?= $item['status'] == '0' ? "Visible" : "Hidden" ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-primary">Edit</a>
                                            <form action="category-function.php" method="post">
                                                <input type="hidden" name="category_id" value="<?= htmlspecialchars($item['id']) ?>">
                                            <button class="btn btn-danger" type="submit" name="delete-category-btn">Delete</button>
                                            </form>
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
