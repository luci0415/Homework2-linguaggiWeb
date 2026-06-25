<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// se l'utente è loggato → vai alla home
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Phasmophobia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">

        <h1 class="title">PHASMOPHOBIA</h1>

        <!-- se NON loggato → vai al login -->
        <a href="login.php" class="enter-btn">ENTER</a>

    </div>

</body>
</html>