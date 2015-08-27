<?php
include_once 'admin_include/functions.php';
session_start(); //Start the current session
sec_session_start();
session_destroy(); //Destroy it! So we are logged out now
$_SESSION['username'] = "";
unset($_SESSION);
session_regenerate_id(true);
header("location:login.php?msg=Successfully Logged out"); // Move back to login.php with a logout message
?>