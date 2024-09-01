<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
echo "Welcome " . $_SESSION['username'] . "! You are logged in.";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>home page</h1>
    <p>You are successfully logged in.</p>
    <a href="logout.php">Logout</a>

</body>

</html>