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

if(isset($_POST['order_btn'])){

    $msg_name = mysqli_real_escape_string($con, $_POST['order_name']);
    $msg_number = $_POST['order_number'];
    $msg_email = mysqli_real_escape_string($con, $_POST['order_email']);
    $method = mysqli_real_escape_string($con, $_POST['order_method']);
    $address = mysqli_real_escape_string($con, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');
 
    $cart_total = 0;
    $cart_products[] = '';
 
    $cart_query = mysqli_query($con, "SELECT * FROM `tbl_cart` WHERE cart_email = '$msg_email'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
       while($cart_item = mysqli_fetch_assoc($cart_query)){
          $cart_products[] = $cart_item['cart_name'].' ('.$cart_item['cart_qty'].') ';
          $sub_total = ($cart_item['cart_price'] * $cart_item['cart_qty']);
          $cart_total += $sub_total;
 
          // Reduce the quantity in tbl_products
          mysqli_query($con, "UPDATE `tbl_products` SET prod_qty = prod_qty - {$cart_item['cart_qty']} WHERE prod_name = '{$cart_item['cart_name']}'") or die('query failed');

       }
    }
 
    $total_products = implode(', ',$cart_products);
 
    $order_query = mysqli_query($con, "SELECT * FROM `tbl_orders` WHERE order_name = '$msg_name' AND order_number = '$msg_number' AND order_email = '$msg_email' AND order_method = '$method' AND order_address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
 
    if($cart_total == 0){
       $message[] = 'your cart is empty';
    }else{
       if(mysqli_num_rows($order_query) > 0){
          $message[] = 'order already placed!'; 
       }else{
          mysqli_query($con, "INSERT INTO `tbl_orders`(order_name, order_number, order_email, order_method, order_address, total_products, total_price, placed_on) VALUES('$msg_name', '$msg_number', '$msg_email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
          $message[] = 'order placed successfully!';
          mysqli_query($con, "DELETE FROM `tbl_cart` WHERE cart_email = '$user_email'") or die('query failed');
       }
    } 
 
 }
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrusyBuysLK Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type="text/javascript" src="\scripts\sc_chechout.js"></script>
</head>
<body>
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($con, "SELECT * FROM `tbl_cart` WHERE cart_email = '$user_email'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['cart_price'] * $fetch_cart['cart_qty']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['cart_name']; ?> <span>(<?php echo '$'.$fetch_cart['cart_price'].'/-'.' x '. $fetch_cart['cart_qty']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post" onsubmit="return validateOrderForm()">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="order_name" id="order_name" required placeholder="enter your name">
            <h4 class="error" id="error_name"></h4>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="order_number" id="order_number" required placeholder="enter your number">
            <h4 class="error" id="error_number"></h4>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="order_email" id="order_email" required placeholder="enter your email">
            <h4 class="error" id="error_email"></h4>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="order_method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. House / Flat no." id="flat">
            <h4 class="error" id="error_flat"></h4>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. Street Name" id="street">
            <h4 class="error" id="error_street"></h4>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Colombo" id="city">
            <h4 class="error" id="error_city"></h4>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. Western" id="state">
            <h4 class="error" id="error_state"></h4>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. Sri Lanka" id="country">
            <h4 class="error" id="error_country"></h4>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456" id="pin_code">
            <h4 class="error" id="error_pincode"></h4>
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name= "order_btn" onclick="validateOrderForm()">
   </form>
</section>



<?php include 'footer.php'; ?>


</body>
</html>