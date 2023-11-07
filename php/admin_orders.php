<?php

include 'config_db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(!isset($admin_id))
{
   header('location:login.php');
}

if(isset($_POST['update_order']))
{
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($con, "UPDATE `tbl_orders` SET payment_status = '$update_payment' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';
}

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM `tbl_orders` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="title">Placed Orders</h1>
   <div class="box-container">
      <?php
      $select_orders = mysqli_query($con, "SELECT * FROM `tbl_orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> Order ID : <span><?php echo $fetch_orders['order_id']; ?></span> </p>
         <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['order_name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['order_number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['order_email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['order_address']; ?></span> </p>
         <p> Total Products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total Price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment Method : <span><?php echo $fetch_orders['order_method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">Pending</option>
               <option value="completed">Completed</option>
            </select>
            <input type="submit" value="Update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['order_id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<script src="/scripts/sc_admin.js"></script>

</body>
</html>