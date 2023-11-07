<?php

include 'config_db.php';

if(isset($_POST['submit']))
{
    $acc_name       = mysqli_real_escape_string($con,$_POST['acc_name']);
    $acc_email      = mysqli_real_escape_string($con,$_POST['acc_email']);
    $acc_password   = mysqli_real_escape_string($con,$_POST['acc_password']);
    $acc_gender     = mysqli_real_escape_string($con,$_POST['acc_gender']);

    $checkEmailQuery = "SELECT * FROM tbl_account WHERE acc_email = '$acc_email'";

    $result = mysqli_query($con, $checkEmailQuery);

    if(mysqli_num_rows($result) > 0)
    {
        $message[] = 'An account with this email already exists.';
    } 
    else 
    {
        $sql = "INSERT INTO tbl_account (acc_name, acc_email, acc_password, acc_gender, acc_type) VALUES ('$acc_name', '$acc_email', '$acc_password', '$acc_gender', 'user')";
        if(mysqli_query($con, $sql))
        {
            $message[] = 'Account created successfully.';
        } 
        else
        {
            $message[] = "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    }
}

?>

<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="/css/styles.css">
        <script type="text/javascript" src="/scripts/sc_registor.js"></script>
    </head>

    <body class="login_register">

    <?php
    if(isset($message))
    {
        foreach($message as $message)
        {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <div class="form-container">
        <form action="" method="post" onsubmit="return validateForm()">
        <h3>Register now</h3>
               <input type="text" id="acc_name" name="acc_name" placeholder="enter your name" required class="box">
               <h4 id="error_name" class="error"></h4>
               <input type="email" id="acc_email" name="acc_email" placeholder="enter your email" required class="box">
               <h4 id="error_email" class="error"></h4>
               <input type="password" id="acc_password" name="acc_password" placeholder="enter your password" required class="box">
               <h4 id="error_password" class="error"></h4>
               <input type="password" id="acc_cpassword" name="acc_cpassword" placeholder="confirm your password" required class="box">
               <h4 id="error_cpassword" class="error"></h4>
               <select name="acc_gender" class="box">
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
               </select>
        <input type="submit" name="submit" value="register now" class="btn" onclick="return validateForm()">
        <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
    </body>
</html>