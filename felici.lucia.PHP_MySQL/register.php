<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Controllo della registrazione
if (isset($_POST['submit'])) {

    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $cognome = filter_var($_POST['cognome'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    // Controllo email esistente
    $select = $db->prepare("SELECT * FROM users WHERE email = ?");
    $select->execute([$email]);

    if ($select->rowCount() > 0) {

        $message = "Email already registered<br/><a href=\"register.php\">Back to signup</a>";

    } else {

        if ($pass != $cpass) {

            $message = "Passwords are not the same!<br/><a href=\"register.php\">Back to signup</a>";

        } else {

            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            $insert = $db->prepare(
                "INSERT INTO users (nome, cognome, email, password, username)
                 VALUES (?, ?, ?, ?, ?)"
            );

            $insert->execute([
                $nome,
                $cognome,
                $email,
                $hashed_pass,
                $username
            ]);

            $message = "Signed in successfully!<br/><a href=\"login.php\">Login</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="icon" href="image/logo2.jpg">

    <link rel="stylesheet" href="login-register.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

<?php
if (isset($message)) {
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
}
?>

<section class="register-container">

    <form action="" method="POST" class="register-form">

        <h3 class="title">Sign in</h3>

        <div class="input-group">
            <input type="text" name="name" placeholder="First name" required>
        </div>

        <div class="input-group">
            <input type="text" name="cognome" placeholder="Last name" required>
        </div>

        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="pass" placeholder="Password" required>
        </div>

        <div class="input-group">
            <input type="password" name="cpass" placeholder="Confirm Password" required>
        </div>

        <input type="submit" value="Register" class="btn" name="submit">

        <p class="login-link">
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </form>

</section>

</body>
</html>