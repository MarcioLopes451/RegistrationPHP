<?php
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h2>login</h2>
        username: <br>
        <input type="text" name="username"> <br>
        password: <br>
        <input type="password" name="password"> <br>
        <input type="submit" name="submit" value="register">
    </form>
    <div>
        <p>don't have an account ?</p>
        <a href="index.php">create account</a>
    </div>
</body>

</html>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo 'Please enter a username.';
    } elseif (empty($password)) {
        echo 'Please enter a password.';
    } else {

        $sql = "SELECT * FROM users WHERE user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: homepage.php');
                exit();
            } else {
                echo 'Invalid password.';
            }
        } else {
            echo 'Username not found.';
        }
    }
}

mysqli_close($conn);
?>