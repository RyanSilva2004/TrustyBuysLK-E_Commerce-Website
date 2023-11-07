<?php

include 'config_db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id))
{
   header('location:login.php');
}

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM `tbl_messages` WHERE msg_id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Contacts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<section class="messages">
   <h1 class="title">Messages</h1>
   <div class="box-container">
      <?php
      $select_message = mysqli_query($con, "SELECT * FROM `tbl_messages`") or die('query failed');
      while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <div class="box">
         <p> Message ID : <span><?php echo $fetch_message['msg_id']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_message['msg_name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_message['msg_number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_message['msg_email']; ?></span> </p>
         <p> Message : <span><?php echo $fetch_message['msg_message']; ?></span> </p>
         <a href="admin_contacts.php?delete=<?php echo $fetch_message['msg_id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete Message</a>
      </div>
      <?php
      };
      ?>
   </div>
</section>


<script src="/scripts/sc_admin.js"></script>

</body>
</html>