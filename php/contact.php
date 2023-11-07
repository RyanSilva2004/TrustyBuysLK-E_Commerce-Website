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

if(isset($_POST['msg_send']))
{

    $msg_name = mysqli_real_escape_string($con, $_POST['msg_name']);
    $msg_email = mysqli_real_escape_string($con, $_POST['msg_email']);
    $msg_number = $_POST['msg_number'];
    $msg_message = mysqli_real_escape_string($con, $_POST['msg_message']);
 
    $select_message = mysqli_query($con, "SELECT * FROM `tbl_messages` WHERE msg_name = '$msg_name' AND msg_email = '$msg_email' AND msg_number = '$msg_number' AND msg_message = '$msg_message'") or die('query failed');
 
    if(mysqli_num_rows($select_message) > 0){
       $message[] = 'message sent already!';
    }else{
       mysqli_query($con, "INSERT INTO `tbl_messages`(msg_name, msg_email, msg_number, msg_message) VALUES('$msg_name', '$msg_email', '$msg_number', '$msg_message')") or die('query failed');
       $message[] = 'message sent successfully!';
    }
 
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrustyBuysLK Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/css/styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post" onsubmit="return validateMessageForm()">
      <h3>say something!</h3>
      <input type="text" name="msg_name" required placeholder="enter message subject" class="box">
      <h4 class="error" id="msg_nameError"></h4>
      <input type="email" name="msg_email" required placeholder="enter your email" class="box">
      <h4 class="error" id="msg_emailError"></h4>
      <input type="number" name="msg_number" required placeholder="enter your number" class="box">
      <h4 class="error" id="msg_numberError"></h4>
      <textarea name="msg_message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <h4 class="error" id="msg_messageError"></h4>
      <input type="submit" value="send message" name="msg_send" class="btn" onclick="validateMessageForm()">
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="/scripts/sc_user.js"></script>

</body>
</html>