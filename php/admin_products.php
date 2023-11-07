<?php

include 'config_db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['add_product'])){

    $name = mysqli_real_escape_string($con, $_POST['add_name']);
    $price = $_POST['add_price'];
    $qty = $_POST['add_qty'];
    $image = $_FILES['add_image']['name'];
    $image_size = $_FILES['add_image']['size'];
    $image_tmp_name = $_FILES['add_image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
 
    $select_product_name = mysqli_query($con, "SELECT prod_name FROM `tbl_products` WHERE prod_name = '$name'") or die('query failed');
 
    if(mysqli_num_rows($select_product_name) > 0){
       $message[] = 'product name already added';
    }else{
       $add_product_query = mysqli_query($con, "INSERT INTO `tbl_products`(prod_name, prod_price, prod_image, prod_qty) VALUES('$name', '$price', '$image', '$qty')") or die('query failed');
 
       if($add_product_query){
          if($image_size > 5000000){
             $message[] = 'image size is too large';
          }else{
             move_uploaded_file($image_tmp_name, $image_folder);
             $message[] = 'product added successfully!';
          }
       }else{
          $message[] = 'product could not be added!';
       }
    }   
}

if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($con, "SELECT prod_image FROM `tbl_products` WHERE prod_id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['prod_image']);
    
    if(mysqli_query($con, "DELETE FROM `tbl_products` WHERE prod_id = '$delete_id'"))
    {
        $message[] = "Product deleted successfully.";
        header('location:admin_products.php');
    } 
    else 
    {
        $message[] = "Failed to delete product.";
    }
 }

 if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_qty = $_POST['update_qty']; 

   mysqli_query($con, "UPDATE `tbl_products` SET prod_name = '$update_name', prod_price = '$update_price', prod_qty = '$update_qty' WHERE prod_id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 5000000){
         $message[] = 'Image file size is too large';
      }else{
         mysqli_query($con, "UPDATE `tbl_products` SET prod_image = '$update_image' WHERE prod_id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
         $message[] = "Product Updated successfully.";
      }
   }

   header('location:admin_products.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Products</title>

   <!-- J Query -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<!--Products CRUD-->
<section class="add-products">
   <h1 class="title">Products</h1>
   <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateAddProductsForm()">
      <h3>Add New Product</h3>
      <input type="text" name="add_name" class="box" placeholder="enter product name" required>
      <h4 class="error" id="add_nameError"></h4>
      <input type="number" min="0" name="add_price" class="box" placeholder="enter product price" required>
      <h4 class="error" id="add_priceError"></h4>
      <input type="number" min="0" name="add_qty" class="box" placeholder="enter product quantity" required>
      <h4 class="error" id="add_qtyError"></h4>
      <input type="file" name="add_image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <h4 class="error" id="add_imageError"></h4>
      <input type="submit" value="add product" name="add_product" class="btn" onclick="validateAddProductsForm()">
   </form>
</section>

<section class="show-products">
   <div class="box-container">
      <?php
         $select_products = mysqli_query($con, "SELECT * FROM `tbl_products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>

    <div class="box">
        <img src="uploaded_img/<?php echo $fetch_products['prod_image']; ?>" alt="" style="width: 200px; height: 200px;">
        <div class="name"><?php echo $fetch_products['prod_name']; ?></div>
        <div class="price">$<?php echo $fetch_products['prod_price']; ?>/-</div>
        <a href="admin_products.php?update=<?php echo $fetch_products['prod_id']; ?>" class="option-btn">update</a>
        <a href="admin_products.php?delete=<?php echo $fetch_products['prod_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
    </div>

      <?php
        }
         } 
         else 
         {
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
   </div>
</section>




<section class="edit-product-form">
   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($con, "SELECT * FROM `tbl_products` WHERE prod_id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateEditProductsForm()">
      <h3>Edit Product</h3>
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['prod_id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['prod_image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['prod_image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['prod_name']; ?>" class="box" required placeholder="enter product name">
      <h4 class="error" id="update_nameError"></h4>
      <input type="number" name="update_price" value="<?php echo $fetch_update['prod_price']; ?>" min="0" class="box" required placeholder="enter product price">
      <h4 class="error" id="update_priceError"></h4>
      <input type="number" name="update_qty" value="<?php echo $fetch_update['prod_qty']; ?>" min="0" class="box" required placeholder="enter product quantity">
      <h4 class="error" id="update_qtyError"></h4>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <h4 class="error" id="update_imageError"></h4>
      <input type="submit" value="Update Product" name="update_product" class="btn" onclick=" validateEditProductsForm()">
      <input type="reset" value="cancel" id="close-update" class="option-btn" onclick="document.querySelector('.edit-product-form').style.display = 'none'">
   </form>
   <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
</section>


<script src="/scripts/sc_admin.js"></script>

</body>
</html>