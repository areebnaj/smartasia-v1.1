<?php include('includes/header.php');
include ('../functions/myfunctions.php');


if (isset($_SESSION['admin'])) {


    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php

                if (isset($_GET['id'])){
                    $id =$_GET['id'];
                    $product =getById("products",$id);

                    if (mysqli_num_rows($product)>0){
                        $data = mysqli_fetch_array($product);
                        ?>
                          <div class="card">
                    <div class="card-header">
                        <h4>Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="category-function.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" class="form-select mb-2">
                                        <option selected>Category</option>
                                        <?php
                                        $categories = getAll("categories");
                                        if (mysqli_num_rows($categories)>0){
                                            foreach ($categories as $item){
                                                ?>
                                                <option value="<?=$item['id'];?>" <?=$data['category_id']==$item['id']?'selected':'' ?> ><?=$item['name'];?></option>
                                                <?php
                                            }
                                        }
                                        else{
                                            echo "No Category Available";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <input type="hidden" name="product_id" value="<?=$data['id']?>">
                                <div class="col-md-6">
                                    <label for="name">Product Name</label>
                                    <input type="text" required name="product_name" value="<?= $data['product_name']?>" placeholder="Enter Item Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label for="slug">Slug</label>
                                    <input type="text" required name="slug" value="<?= $data['slug']?>" placeholder="Enter Slug" class="form-control mb-2">
                                </div>


                                <div class="col-md-4">
                                    <label for="orginal_price">Orginal Price</label>
                                    <input type="number" name="orginal_price" value="<?= $data['orginal_price']?>" placeholder="Enter orginal price" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="number" required name="selling_price" value="<?= $data['selling_price']?>" placeholder="Enter Selling Price" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" required name="quantity" value="<?= $data['quantity']?>" placeholder="Enter Quantity" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="color">color</label>
                                    <input type="text" required name="color" value="<?= $data['color']?>" placeholder="Enter color" class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <input type="checkbox" name="status" <?=$data['status']?"checked":""?>  class="mb-2 mt-3">
                                </div>

                                <div class="col-md-3">
                                    <label for="trending">Trending</label>
                                    <input type="checkbox" <?=$data['trending']?"checked":""?> name="trending" class="mb-2 mt-3">
                                </div>


                                <div class="col-md-12">
                                    <label for="small_description">Small Description</label>
                                    <textarea name="small_description" required class="form-control mb-2" placeholder="Enter Small Description" rows="3"><?= $data['small_description']?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" required class="form-control mb-2" placeholder="Enter Description" rows="3"><?= $data['description']?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="image">Upload Image</label>
                                    <input type="file" name="image" class="form-control mb-2">
                                    <div class="mt-2">
                                        <label for="image">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?=$data['image']?>">
                                        <img src="../upload/<?= htmlspecialchars($data['image']); ?>" height="50px" width="50px"  alt="<?=$data['product_name']?>"></div>
                                </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control mb-2" value="<?= $data['meta_title']?>" name="meta_title" placeholder="Meta Title">
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" class="form-control mb-2" placeholder="Enter Meta Description" rows="3"><?= $data['meta_description']?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea name="meta_keywords" rows="3" class="form-control mb-2" placeholder="Enter Meta Keywords"><?= $data['meta_keywords']?></textarea>
                                </div>


                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary" name="edit-product-btn" type="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                          </div>
                        <?php
                    }else{
                            echo "Product Not found for given id";
                        }
                }else{
                    echo "Id missing from Url";

                }

                ?>



        </div>
    </div>
    <?php include('includes/footer.php');

} else {
    header("location: ../login.php");
}
?>


