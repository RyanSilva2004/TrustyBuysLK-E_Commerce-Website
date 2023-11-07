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
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrusyBuysLK My Orders</title>

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
   <h3>My Orders</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="placed-orders">

   <div class="box-container">

      <?php
         $order_query = mysqli_query($con, "SELECT * FROM `tbl_orders` WHERE order_email = '$user_email'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['order_name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['order_number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['order_email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['order_address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['order_method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <!-- You may need to update 'payment_status' to match your database schema -->
         <p> order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>


<?php include 'footer.php'; ?>


</body>
</html>