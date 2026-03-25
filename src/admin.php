<!-- This file will be a simple html page with the flag. -->
<?php
session_start();

if (!isset($_SESSION["logged_in"]) or $_SESSION["logged_in"] !== true) {
    header("Location: ./views/login.php");
    exit;
}
?>

<p>byuctf{s00pa_s3cr3t_fl4g_placeholder}</p>
