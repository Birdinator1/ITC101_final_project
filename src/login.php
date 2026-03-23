<!-- here is the PHP file for the login logic.  -->
<?php
session_start();

if (isset($_SESSION["error"])) {
    echo '<p style="color: red;">' . $_SESSION["error"] . '</p>';
    unset($_SESSION["error"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body></body>