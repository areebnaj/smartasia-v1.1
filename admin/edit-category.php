<?php include('includes/header.php');
include ('../functions/myfunctions.php');
include ('category-function.php');

if (isset($_SESSION['admin'])) {


    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $category = getByID("categories",$id);

                    if (mysqli_num_rows($category) > 0){
                        $data = mysqli_fetch_array($category);

                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Category</h4>
                            </div>
                            <div class="card-body">
                                <form action="category-function.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="category_id" value="<?=$data['id']?>">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="<?=$data['name']?>" placeholder="Enter Item Name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" value="<?=$data['slug']?>" placeholder="Enter Slug" class="form-control">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" placeholder="Enter Description" rows="3"><?=$data['description']?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="image">Upload Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <div class="mt-2">
                                            <label for="image">Current Image</label>
                                                <input type="hidden" name="old_image" value="<?=$data['images']?>">
                                            <img src="../upload/<?= htmlspecialchars($data['images']); ?>" height="50px" width="50px"  alt="<?=$data['name']?>"></div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" value="<?=$data['meta_title']?>" name="meta_title" placeholder="Meta Title">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" class="form-control" placeholder="Enter Meta Description" rows="3"><?=$data['meta_description']?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="meta_keyword">Meta Keyword</label>
                                            <textarea name="meta_keyword" rows="3" class="form-control" placeholder="Enter Meta Keywords"><?=$data['meta_keyword']?></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <input type="checkbox" <?=$data['status']?"checked":""?> name="status">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="popular">Popular</label>
                                            <input type="checkbox" <?=$data['popular']?"checked":""?> name="popular">
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-primary" name="update-category-btn" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "Category not Found";
                    }
                }
                else
                {
                    echo "Something Went Wrong";
                }

                ?>

            </div>

        </div>
    </div>
    <?php include('includes/footer.php');

} else {
    header("location: ../login.php");
}
?>