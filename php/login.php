<?php

include 'config_db.php';
session_start();

if(isset($_POST['submit']))
{
    $acc_email      = mysqli_real_escape_string($con,$_POST['acc_email']);
    $acc_password   = mysqli_real_escape_string($con,$_POST['acc_password']);

    $checkAccountQuery = "SELECT * FROM tbl_account WHERE acc_email = '$acc_email' AND acc_password = '$acc_password'";

    $result = mysqli_query($con, $checkAccountQuery);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        if($row['acc_type'] == 'admin')
        {
            $_SESSION['admin_name'] = $row['acc_name'];
            $_SESSION['admin_email'] = $row['acc_email'];
            $_SESSION['admin_id'] = $row['acc_id'];
            header('location:admin_page.php');
        }
        else if($row['acc_type'] == 'user')
        {
            $_SESSION['user_name'] = $row['acc_name'];
            $_SESSION['user_email'] = $row['acc_email'];
            $_SESSION['user_id'] = $row['acc_id'];
            header('location:home.php');
        }
    }
    else 
    {
        $message[] = 'Invalid email or password.';
    }
}

?> 


<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="/css/styles.css">
        <script type="text/javascript" src="/scripts/sc_login.js"></script>
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
        <h3>Login now</h3>
               <input type="email" id="acc_email" name="acc_email" placeholder="enter your email" required class="box">
               <h4 id="error_email" class="error"></h4>
               <input type="password" id="acc_password" name="acc_password" placeholder="enter your password" required class="box">
               <h4 id="error_password" class="error"></h4>
        <input type="submit" name="submit" value="Login now" class="btn" onclick="return validateForm()">
        <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
    </body>
</html>