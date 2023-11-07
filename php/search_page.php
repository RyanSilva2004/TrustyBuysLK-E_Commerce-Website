<?php

include 'config_db.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email']; 

if(!isset($user_id))
{
   header('location:login.php');
}

if(!isset($user_email))
{
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $prod_name = $_POST['product_name'];
    $prod_price = $_POST['product_price'];
    $prod_image = $_POST['product_image'];
    $prod_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($con, "SELECT * FROM `tbl_cart` WHERE cart_name = '$prod_name' AND cart_email = '$user_email'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($con, "INSERT INTO `tbl_cart`(cart_email, cart_name, cart_price, cart_quantity, cart_image) VALUES('$user_email', '$prod_name', '$prod_price', '$prod_quantity', '$prod_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 };
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrusyBuysLK Search</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="/scripts/sc_user.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="heading">
   <h3>Search Produts</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<!-- JQuery Animations -->
<script>
$(document).ready(function() {
        $('.box').hide().each(function(i) {
            $(this).delay(200 * i).animate({
                height: 'toggle',
                width: 'toggle'
            }, 1000);
        });
    });
</script>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="search products..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($con, "SELECT * FROM `tbl_products` WHERE prod_name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>

   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['prod_image']; ?>" alt="" class="image" style="width: 200px; height: 200px;">
      <div class="name"><?php echo $fetch_product['prod_name']; ?></div>
      <div class="price">$<?php echo $fetch_product['prod_price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['prod_name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['prod_price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['prod_image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
   </form>

   <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
   </div>

</section>


<?php include 'footer.php'; ?>

<script src="/scripts/sc_user.js"></script>
</body>
</html>