<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/* se già loggato → vai alla home */
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

$controllo = false;
$row = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = strtolower($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $result = $db->prepare($sql);
    $result->execute([$email]);

    if ($result->rowCount() == 1) {

        $row = $result->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {
            $controllo = true;
        }
    }

    if ($controllo) {

        /* SESSIONE UNIFICATA */
        $_SESSION['user'] = $email;

        header("Location: home.php");
        exit();

    } else {

        echo <<<heredoc
            <p class="message">
                Wrong email or password.
            </p>
        heredoc;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="login-register.css">
</head>

<body>

<div class="login-container">

    <h2 class="title">Log into your account</h2>

    <form action="" method="post">

        <div class="input-group">
            <input type="text" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="button-group">

            <input type="submit" value="Login" class="btn">
            <input type="reset" value="reset" class="btn reset">

        </div>

        <br>

        <p class="register-link">
            Create an account?
            <a href="register.php">Register</a><br/>
            or <a href="home.php">get in as a guest</a>
        </p>

    </form>

</div>

</body>
</html>