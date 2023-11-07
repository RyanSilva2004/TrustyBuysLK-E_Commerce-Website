<?php

include 'config_db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM `tbl_account` WHERE acc_id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">
   <h1 class="title">User Accounts</h1>
   <div class="box-container">
      <?php
      $select_users = mysqli_query($con, "SELECT * FROM `tbl_account`") or die('query failed');
      while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> User ID : <span><?php echo $fetch_users['acc_id']; ?></span> </p>
         <p> Username : <span><?php echo $fetch_users['acc_name']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_users['acc_email']; ?></span> </p>
         <!-- Assuming 'acc_type' is the equivalent of 'user_type' in your schema -->
         <p> User Type : <span style="color:<?php if($fetch_users['acc_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['acc_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['acc_id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
      </div>
      <?php
      };
      ?>
   </div>
</section>



<script src="/scripts/sc_admin.js"></script>

</body>
</html>