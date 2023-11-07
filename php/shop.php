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

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($con, "SELECT * FROM `tbl_cart` WHERE cart_name = '$product_name' AND cart_email = '$user_email'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0)
   {
      $message[] = 'Already added to cart!';
   }
   else
   {
      mysqli_query($con, "INSERT INTO `tbl_cart`(cart_email, cart_name, cart_price, cart_qty, cart_image) VALUES('$user_email', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product added to cart!';
   }

}
?>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrustyBuysLK Store</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <meta name="description" content="Learn more about TrustyBuysLK, your trusted source for mobile phones and accessories. Discover our story, values, and commitment to providing high-quality products.">
   <meta name="keywords" content="About TrustyBuysLK, Mobile Phones, Phone Accessories, E-commerce, Online Shopping">

</head>
<body>

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

   <?php include 'header.php'; ?>
   <div class="heading">
        <h3>our shop</h3>
        <p> <a href="home.php">home</a> / shop </p>
    </div>

    <section class="products">
    <h1 class="title">Latest Products</h1>

        <div class="box-container">

            <?php  
                $select_products = mysqli_query($con, "SELECT * FROM `tbl_products`") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
            <img class="image" src="uploaded_img/<?php echo $fetch_products['prod_image']; ?>" alt="" style="width: 200px; height: 200px;">
            <div class="name"><?php echo $fetch_products['prod_name']; ?></div>
            <div class="price">$<?php echo $fetch_products['prod_price']; ?>/-</div>
            <div><h3><br>Remaining Quantity: <?php echo $fetch_products['prod_qty']; ?></h3></div> <!-- Added remaining quantity -->
            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['prod_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['prod_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['prod_image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
                }
            }
            else
            {               
                echo '<p class="empty">No products added yet!</p>';
            }
            ?>
        </div>

</section>


   <?php include 'footer.php'; ?>

   <script src="/scripts/sc_user.js"></script>
</body>
</html>