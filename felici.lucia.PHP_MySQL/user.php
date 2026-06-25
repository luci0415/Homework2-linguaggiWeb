<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

session_start();

/* CONTROLLO LOGIN */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

/* RECUPERO DATI UTENTE */
$email = $_SESSION['user'];

$stmt = $db->query("
    SELECT nome, cognome, username, email
    FROM users
    WHERE email = '$email';
");

$utente = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile</title>

    <link rel="stylesheet" href="user.css">

    <!-- Font horror -->
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <!-- Icone -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<!-- SFONDO (NEBBIA / HORROR) -->
<div class="fog"></div>

<!-- TOP BAR -->
<div id="top-bar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="book-of-ghosts.php">Book of Ghosts</a></li>
        <li><a href="items.php">Items</a></li>
        <li><a href="cursed-possessions.php">Cursed Possessions</a></li>
        <li><a href="maps.php">Maps</a></li>
        <!-- Icona Utente -->
        <li class="user-icon">
            <a href="user.php" title="Profilo Utente">
                <i class="fa-solid fa-user-secret"></i>
            </a>
        </li>
    </ul>
</div>

<!-- TITOLO -->
<div id="page-title">
    <h1>Profile</h1>
    <h2>- Ghost Hunter -</h2>
</div>

<!-- CONTENUTO PROFILO -->
<div class="profile-container">

    <div class="profile-card">

        <!-- ICONA -->
        <div class="avatar">
            <i class="fa-solid fa-ghost"></i>
        </div>

        <!-- DATI UTENTE -->
        <div class="info">

            <p><span>First name:</span> <?= htmlspecialchars($utente['nome']) ?></p>

            <p><span>Last name:</span> <?= htmlspecialchars($utente['cognome']) ?></p>

            <p><span>Username:</span> <?= htmlspecialchars($utente['username']) ?></p>

            <p><span>Email:</span> <?= htmlspecialchars($utente['email']) ?></p>

        </div>

        <!-- BOTTONI -->
        <div class="buttons">

            <a class="btn" href="home.php">
                <i class="fa-solid fa-house"></i>
                Home
            </a>

            <a class="btn logout" href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>