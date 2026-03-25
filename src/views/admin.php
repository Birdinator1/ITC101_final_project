<!-- This file will be a simple html page with the flag. -->
<?php
session_start();

if (!isset($_SESSION["auth"]) or $_SESSION["auth"] !== true) {
    header("Location: ./views/login.php");
    exit;
}
?>

<p>byuctf{s00pa_s3cr3t_fl4g_placeholder}</p>
