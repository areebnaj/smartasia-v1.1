<?php include('includes/header.php');
include ('../functions/myfunctions.php');

if (isset($_SESSION['admin'])) {


    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                                                   <option value="<?=$item['id'];?>"><?=$item['name'];?></option>
                                                   <?php
                                               }
                                           }
                                           else{
                                               echo "No Category Available";
                                           }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Product Name</label>
                                    <input type="text" required name="product_name" placeholder="Enter Item Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label for="slug">Slug</label>
                                    <input type="text" required name="slug" placeholder="Enter Slug" class="form-control mb-2">
                                </div>


                                <div class="col-md-4">
                                    <label for="orginal_price">Orginal Price</label>
                                    <input type="number" name="orginal_price" placeholder="Enter orginal price" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="number" required name="selling_price" placeholder="Enter Selling Price" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" required name="quantity" placeholder="Enter Quantity" class="form-control mb-2">
                                </div>

                                <div class="col-md-4">
                                    <label for="color">color</label>
                                    <input type="text" required name="color" placeholder="Enter color" class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <label for="status">Status</label>
                                    <input type="checkbox" name="status" class="mb-2 mt-3">
                                </div>

                                <div class="col-md-3">
                                    <label for="trending">Trending</label>
                                    <input type="checkbox" name="trending" class="mb-2 mt-3">
                                </div>


                                <div class="col-md-12">
                                    <label for="small_description">Small Description</label>
                                    <textarea name="small_description" required class="form-control mb-2" placeholder="Enter Small Description" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" required class="form-control mb-2" placeholder="Enter Description" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="image">Upload Image</label>
                                    <input type="file" required name="image" class="form-control mb-2">
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Title">
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" class="form-control mb-2" placeholder="Enter Meta Description" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea name="meta_keywords" rows="3" class="form-control mb-2" placeholder="Enter Meta Keywords"></textarea>
                                </div>


                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary" name="add-product-btn" type="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php');

} else {
    header("location: ../login.php");
}
?>


