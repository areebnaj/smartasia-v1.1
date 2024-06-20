<?php include('includes/header.php');

if (isset($_SESSION['admin'])) {


    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Category</h4>
                    </div>
                       <div class="card-body">
                          <form action="category-function.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                 <div class="col-md-6">
                                     <label for="name">Name</label>
                                     <input type="text" name="name" placeholder="Enter Item Name" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="slug">Slug</label>
                                     <input type="text" name="slug" placeholder="Enter Slug" class="form-control">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="description">Description</label>
                                     <textarea name="description" class="form-control" placeholder="Enter Description" rows="3"></textarea>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="image">Upload Image</label>
                                     <input type="file" name="image" class="form-control">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="meta_title">Meta Title</label>
                                     <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                                 </div>

                                 <div class="col-md-12">
                                     <label for="meta_description">Meta Description</label>
                                     <textarea name="meta_description" class="form-control" placeholder="Enter Meta Description" rows="3"></textarea>
                                 </div>

                                 <div class="col-md-12">
                                     <label for="meta_keyword">Meta Keyword</label>
                                     <textarea name="meta_keyword" rows="3" class="form-control" placeholder="Enter Meta Keywords"></textarea>
                                 </div>

                                 <div class="col-md-6">
                                     <label for="status">Status</label>
                                     <input type="checkbox" name="status">
                                 </div>

                                 <div class="col-md-6">
                                     <label for="popular">Popular</label>
                                     <input type="checkbox" name="popular">
                                 </div>

                                 <div class="col-md-12">
                                     <button class="btn btn-primary" name="add-category-btn" type="submit">Save</button>
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


