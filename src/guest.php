<!-- This one will give them a sad message saying that there's nothing for guests because they're lame and their privelege is weak. -->
<?php
session_start();

if (!isset($_SESSION["logged_in"]) or $_SESSION["logged_in"] !== true) {
    header("Location: ./views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Page</title>
</head>
<body>
    <p>Welcome to this soopa secure website! We don't have anything for guests here, sorry. Enjoy this picture, though!</p>
    <!-- TO-DO: Link silly picture here (very important) -->
</body>