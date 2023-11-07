<?php

include 'config_db.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

?>