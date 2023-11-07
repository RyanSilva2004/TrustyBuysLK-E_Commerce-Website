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

if(isset($_POST['update_cart']))
{
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($con, "UPDATE `tbl_cart` SET cart_qty = '$cart_quantity' WHERE cart_id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}
 
if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM `tbl_cart` WHERE cart_id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}
 
if(isset($_GET['delete_all']))
{
    mysqli_query($con, "DELETE FROM `tbl_cart` WHERE acc_id = '$acc_id'") or die('query failed');
    header('location:cart.php');
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrusyBuysLk My Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<!-- JQuery Animations -->
<script>
$(document).ready(function() {
    $('.box').css('position','relative').css('top','-100px').css('opacity', 0).each(function(i) {
        $(this).delay(200 * i).animate({
            top: '0px',
            opacity: 1
        }, 1000);
    });
});
</script>

<?php include 'header.php'; ?>
<div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($con, "SELECT * FROM `tbl_cart` WHERE cart_email = '$user_email'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['cart_id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['cart_image']; ?>" alt="" style="width: 200px; height: 200px;">
         <div class="name"><?php echo $fetch_cart['cart_name']; ?></div>
         <div class="price">$<?php echo $fetch_cart['cart_price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['cart_qty']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetch_cart['cart_qty'] * $fetch_cart['cart_price']); ?>/-</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
      </div>
   </div>

</section>


<?php include 'footer.php'; ?>

<script src="/scripts/sc_user.js"></script>
</body>
</html>