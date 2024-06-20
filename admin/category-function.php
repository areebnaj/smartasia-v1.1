<?php
session_start();
include('../config/dbcon.php');
global $con;

if (isset($_POST['add-category-btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';


    $image = $_FILES['image']['name'];
    $path = "../upload";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Validate and move the uploaded file
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename)) {
        // Prepare and bind parameters to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular,images) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
        if ($stmt) {
            $stmt->bind_param("sssssssis", $name, $slug, $description, $meta_title, $meta_description, $meta_keywords, $status, $popular,$filename);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Category Added Successfully";
            } else {
                $_SESSION['message'] = "Something Went Wrong: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Failed to prepare statement: " . $con->error;
        }
    } else {
        $_SESSION['message'] = "Failed to upload image.";
    }

    header('Location: add-category.php');
    exit(0);
}

elseif (isset($_POST['update-category-btn'])) {
    $category_id = $_POST['category_id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keyword']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../upload";

    // Validate and move the uploaded file
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $update_query = "UPDATE categories SET name=?, slug=?, description=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, popular=?,images=? WHERE id=?";
    $stmt = $con->prepare($update_query);

    if ($stmt) {
        $stmt->bind_param("sssssssisi", $name, $slug, $description, $meta_title, $meta_description, $meta_keywords, $status, $popular, $update_filename, $category_id);

        if ($stmt->execute()) {
            if ($new_image != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
                if (file_exists($path . '/' . $old_image)) {
                    unlink($path . '/' . $old_image);
                }
            }
            $_SESSION['message'] = 'Category Updated Successfully';
            header('Location: categories.php');
            exit(0);
        } else {
            $_SESSION['message'] = 'Something Went Wrong: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Failed to prepare statement: ' . $con->error;
    }

    header('Location: edit-category.php?id=' . $category_id);
    exit(0);
}

elseif (isset($_POST['delete-category-btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    // Fetch the category to get the image filename
    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);

    if ($category_query_run && mysqli_num_rows($category_query_run) > 0) {
        $category_data = mysqli_fetch_array($category_query_run);
        $image = $category_data['images'];

        // Delete the category
        $delete_query = "DELETE FROM categories WHERE id='$category_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if ($delete_query_run) {
            // Delete the image file if it exists
            if (file_exists("../upload/" . $image)) {
                unlink("../upload/" . $image);
            }
            $_SESSION['message'] = "Item Deleted Successfully";
        } else {
            $_SESSION['message'] = "Something Went Wrong: " . mysqli_error($con);
        }
    } else {
        $_SESSION['message'] = "Category not found";
    }

    header('location: categories.php');
    exit(0);
}

elseif (isset($_POST['add-product-btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['product_name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $orginal_price = mysqli_real_escape_string($con, $_POST['orginal_price']);
    $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $color = mysqli_real_escape_string($con, $_POST['color']);

    $image = $_FILES['image']['name'];
    $path = "../upload";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "" && $slug != "" && $description != "" && $selling_price != "") {
        // Validate and move the uploaded file
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename)) {
            // Prepare and bind parameters to prevent SQL injection
            $stmt = $con->prepare("INSERT INTO products (category_id, product_name, slug, small_description, description, meta_title, meta_description, meta_keywords, status, trending, orginal_price, selling_price, quantity, color, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("issssssssiiisss", $category_id, $name, $slug, $small_description, $description, $meta_title, $meta_description, $meta_keywords, $status, $trending, $orginal_price, $selling_price, $quantity, $color, $filename);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Product Added Successfully";
                } else {
                    $_SESSION['message'] = "Something Went Wrong: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $_SESSION['message'] = "Failed to prepare statement: " . $con->error;
            }
        } else {
            $_SESSION['message'] = "Failed to upload image.";
        }
    } else {
        $_SESSION['message'] = "Please fill all fields";
    }

    header('location: add-product.php');
    exit(0);
}

elseif (isset($_POST['edit-product-btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['product_name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $orginal_price = mysqli_real_escape_string($con, $_POST['orginal_price']);
    $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $color = mysqli_real_escape_string($con, $_POST['color']);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../upload";

    // Validate and move the uploaded file
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $update_query = "UPDATE products SET category_id=?, product_name=?, slug=?, small_description=?, description=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, trending=?, orginal_price=?, selling_price=?, quantity=?, color=?, image=? WHERE id=?";
    $stmt = $con->prepare($update_query);

    if ($stmt) {
        $stmt->bind_param("issssssssiiisssi", $category_id, $name, $slug, $small_description, $description, $meta_title, $meta_description, $meta_keywords, $status, $trending, $orginal_price, $selling_price, $quantity, $color, $update_filename, $product_id);

        if ($stmt->execute()) {
            if ($new_image != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
                if (file_exists($path . '/' . $old_image)) {
                    unlink($path . '/' . $old_image);
                }
            }
            $_SESSION['message'] = 'Product Updated Successfully';
            header('Location: product.php');
            exit(0);
        } else {
            $_SESSION['message'] = 'Something Went Wrong: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Failed to prepare statement: ' . $con->error;
    }

    header('Location: edit-product.php?id=' . $product_id);
    exit(0);
}

elseif (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    // Fetch the product to get the image filename
    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);

    if ($product_query_run && mysqli_num_rows($product_query_run) > 0) {
        $product_data = mysqli_fetch_array($product_query_run);
        $image = $product_data['image'];

        // Delete the product
        $delete_query = "DELETE FROM products WHERE id='$product_id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if ($delete_query_run) {
            // Delete the image file if it exists
            if (file_exists("../upload/" . $image)) {
                unlink("../upload/" . $image);
            }
            echo 200;
        } else {
            echo 500;
        }
    } else {
        echo 404; // Product not found
    }
    exit(0);
}





?>
