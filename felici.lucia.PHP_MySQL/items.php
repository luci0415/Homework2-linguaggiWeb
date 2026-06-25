<?php

require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Titolo della pagina -->
    <title>Book of Ghosts</title>

    <!-- Icona user -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"

    <!-- Foglio di stile principale -->
    <link rel="stylesheet" href="items.css" />

    <style>
        <?php
        $stmt = $db->query("SELECT * FROM items;");
        while ($row = $stmt->fetch()) {
            $itemID = $row['cssID'];
            echo <<<heredoc
                .item.item$itemID::after {background-image: url("{$row['imageURL']}")}
            heredoc;
        }
        ?>
    </style>

    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Creepster&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&amp;family=Inter:wght@300;400&amp;display=swap" rel="stylesheet"/>

</head>

<body>

<!-- Sfere decorative animate -->
<div class="orb-container">
    <?php
    for ($i=1; $i<=8; ++$i) {
        echo "<div class=\"orb orb$i\"></div>";
    }
    ?>
</div>

<!-- TOP BAR -->
<nav id="top-bar">
    <ul>
        <li><a href="home.php">Home</a></li>
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
</nav>

<h1 class="page-title">Equipment</h1>
<h2 class="page-title">- list -</h2>

<table>
    <caption class="tab-title">Starter equipment</caption>

    <tr>
        <th>Equipment</th>
        <th>Price</th>
        <th>Max amount</th>
        <th>Description</th>
    </tr>

    <?php
    $stmt = $db->query("SELECT * FROM items WHERE type = 'Starter Equipment'");
    while ($row = $stmt->fetch()) {
        echo <<<heredoc
            <tr>
                <td class="item item{$row['cssID']}">{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['maxAmount']}</td>
                <td>{$row['description']}</td>
            </tr>
            heredoc;
    }
    ?>
</table>

<table>
    <caption class="tab-title">Optional equipment</caption>

    <tr>
        <th>Equipment</th>
        <th>Price</th>
        <th>Max amount</th>
        <th>Description</th>
    </tr>

    <?php
    $stmt = $db->query("SELECT * FROM items WHERE type = 'Optional Equipment'");
    while ($row = $stmt->fetch()) {
        echo <<<heredoc
            <tr>
                <td class="item item{$row['cssID']}">{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['maxAmount']}</td>
                <td>{$row['description']}</td>
            </tr>
            heredoc;
    }
    ?>
</table>

<table>
    <caption class="tab-title">Truck equipment</caption>

    <tr>
        <th>Equipment</th>
        <th>Price</th>
        <th>Max amount</th>
        <th>Description</th>
    </tr>

    <?php
    $stmt = $db->query("SELECT * FROM items WHERE type = 'Truck Equipment'");
    while ($row = $stmt->fetch()) {
        echo <<<heredoc
            <tr>
                <td class="item item{$row['cssID']}">{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['maxAmount']}</td>
                <td>{$row['description']}</td>
            </tr>
            heredoc;
    }
    ?>
</table>

<!-- Pie' di pagina per crediti e copyright-->
<footer>

    <small id="original-site">
        More on
        <a href="https://kineticgames.co.uk/phasmophobia">
            Phasmophobia Official
        </a>
    </small>

    <p>
        <small id="copyright">
            &copy; 2026 Phasmophobia Wiki.
            Phasmophobia &trade; and all associated logos
            are Kinetic Games Limited's property.
            This is not an official site.
        </small>
    </p>

    <small id="project-leaders">
        Authors: Emilio, Lucia
    </small>

</footer>

</body>
</html>