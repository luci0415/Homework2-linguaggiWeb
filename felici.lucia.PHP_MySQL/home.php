<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <link rel="stylesheet" href="home.css?v=999">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
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
<div id="top-bar">
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
</div>

<!-- TITLE -->
<div id="page-title">

    <h1 class="h1">Phasmophobia</h1>

    <h2 class="h2">
        - Horror Game -<br>
    </h2>

</div>

<!-- MAIN CONTENT -->
<div class="main">

    <h1 class="subtitle">ABOUT THE GAME</h1>

    <div class="intro">

        <p>
            Phasmophobia is a paranormal horror game developed and published
            by British indie game studio Kinetic Games (based in Southampton).
            The game became available in early access for Microsoft Windows
            with virtual reality support in September 2020.
        </p>

        <p>
            In the game, one to four players take on the role of ghost hunters
            who work to complete a contract where they must identify the type
            of ghost haunting a designated site and complete other optional
            objectives.
        </p>

        <p>
            Phasmophobia rose in popularity after many Twitch streamers and
            YouTubers played it during October 2020, becoming the sixth-most
            popular game on Twitch of that month and the best-selling game
            on Steam globally for several weeks from October to November 2020.
        </p>

        <p>
            It earned positive reviews from critics, who praised its
            innovativeness. Phasmophobia is the 50th best-selling video game
            because of its recent popularity.
        </p>

    </div>
</div>

<br><br><br>

<!-- FOOTER -->
<div class="footer">

    <small id="original-site">
        More on
        <a href="https://kineticgames.co.uk/phasmophobia">
            Phasmophobia Official
        </a>
    </small>

    <p>
        <small id="copyright">
            &copy; 2026 Phasmophobia Wiki.
            Phasmophobia ™ and all associated logos
            are Kinetic Games Limited's property.
            This is not an official site.
        </small>
    </p>

    <small id="project-leaders">
        Authors: Emilio, Lucia
    </small>

</div>

</body>

</html>