<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

?>

<html lang="en">

<head>

    <!-- Collegamento al file CSS -->
    <link rel="stylesheet" href="cursed-possessions.css"/>

    <!-- Icona user -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"

    <!-- Font horror da Google Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Creepster&amp;display=swap"/>

    <!-- Titolo della pagina -->
    <title>Cursed Possessions</title>

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

<!-- Titolo principale -->
<section id="page-title">

    <h1>
        Cursed Possessions
    </h1>

    <!-- Sottotitolo -->
    <h2 class="subtitle">
        - Phasmophobia - <br/>
    </h2>

</section>

<main>

    <br/>

    <!-- Introduzione -->
    <article class="intro">

        <p>Cursed possessions are a group of seven powerful, supernatural items that are used to directly
            interface with the ghost. They can make the ghost appear or provide
            information, <b>generally</b> at the cost of sanity.</p>

        <p>On all default difficulties, except Insanity, one cursed possession is selected at random for every contract.
            Each item has one dedicated spawn location on a given map.</p>

        <p>The use of cursed possessions is <b>not mandatory</b>. All objectives can be completed without them, and
            only a handful of Daily and Weekly Tasks require them outright. Cursed possessions grant players a
            level of control over the investigative process and the overall flow of a mission, but come with the
            risk of causing a hunt.</p>

    </article>

    <!-- Elenco collegamenti interni -->
    <nav id="index">
        <ul>
            <li><a href="#music-box">Music Box</a></li>
            <li><a href="#haunted-mirror">Haunted Mirror</a></li>
            <li><a href="#ouija-board">Ouija Board</a></li>
            <li><a href="#summoning-circle">Summoning Circle</a></li>
            <li><a href="#tarot-cards">Tarot Cards</a></li>
            <li><a href="#voodoo-doll">Voodoo Doll</a></li>
            <li><a href="#monkey-paw">Monkey Paw</a></li>
        </ul>
    </nav>

    <!-- MUSIC BOX -->
    <article title="music-box">

        <h2 id="music-box">Music Box</h2>

        <!-- Link rapido all'indice -->
        <small>
            <a href="#index">Back to index</a>
        </small>

        <!-- Citazione -->
        <p class="quote">
            <q>"A music box, the song is nice, but creepy."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine -->
        <img alt="Music Box image should be here"
             src="imgs/cursed-possessions/music-box-pic.webp"/>

        <p>The music box is a cursed possession that can be used to pinpoint the location of the ghost,
            though one is at considerable risk if one is careless with it.</p>

        <p>Once activated, if the ghost is within 20 metres of the music box, it will sing along,
            broadcasting its current location while remaining invisible.</p>

        <p>If the music box is within 5 metres of the ghost, it will trigger a <cite>ghost event</cite> where the
            ghost manifests and begins to walk towards the box. The music box can be handheld or placed on
            the floor, the latter being the only safe way to discard the box without triggering a
            <cite>cursed</cite> hunt before the ghost event.
            In all cases, the box will close once it stops playing.</p>

    </article>

    <!-- HAUNTED MIRROR -->
    <article title="haunted-mirror">

        <h2 id="haunted-mirror">Haunted Mirror</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"This mirror made me feel...weird."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine specchio -->
        <img alt="Haunted Mirror image should be here"
             src="imgs/cursed-possessions/haunted-mirror-pic.webp"/>

        <p>The Haunted Mirror is a cursed possession that can be used to locate the <cite>ghost room</cite>.</p>

        <p>When activated, the haunted mirror will show a view of the favorite room as a sweeping panorama from
            the center of the room, allowing players to locate the room by cross-reference.
            This view is a live feed of the room, so any lights turned on, items moved, and equipment or players
            present in the room will be visible. The only exception is the player's own model.</p>

        <p>Each usage of the haunted mirror will decrease <cite>sanity</cite>.
            Using the mirror for less than ~2.67 seconds will still drain at least 20% sanity.</p>

        <!-- Immagine specchio rotto -->
        <img alt="Cracked Haunted Mirror image should be here"
             src="imgs/cursed-possessions/cracked-haunted-mirror-pic.webp"/>

        <p>The mirror will crack visually and audibly, triggering a <cite>cursed hunt</cite> if:</p>

        <!-- Lista effetti -->
        <ul>
            <li>The user's sanity reaches 0% while looking into the mirror</li>
            <li>A player activates the mirror while below 20% sanity</li>
        </ul>

        <p>Once broken, the mirror automatically lowers and cannot be used for the rest of the investigation.</p>

    </article>

    <!-- OUIJA BOARD -->
    <article title="ouija-board">

        <h2 id="ouija-board">Ouija Board</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"This Ouija Board allows us to talk with the ghost."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine tavola -->
        <img alt="Oujia Board image should be here"
             src="imgs/cursed-possessions/ouija-board-pic.webp"/>

        <p>The Ouija Board can be used to communicate with the ghost at the cost of <cite>sanity</cite>.</p>

        <p>It can be activated by interacting with it (while not holding it directly). When activated, the
            <cite>planchette</cite> will drop down onto the center of the board, ready to move around to isolate
            letters and numbers.</p>

        <p>Players can choose to either use voice chat or a text-based UI to ask questions.
            If the question is recognized, the planchette will move to answer the question.</p>

        <!-- Immagine tavola rotta -->
        <img alt="Broken Oujia Board image should be here"
             src="imgs/cursed-possessions/broken-ouija-board-pic.webp"/>

        <p>The Ouija board will burn and break apart, initiating a <cite>cursed hunt</cite>, if:</p>

        <ul>
            <li>There is no player within 5 meters of a still-active board (leaving this range applies)</li>
            <li>The player currently asking questions has less sanity than required
                to "pay" for the question</li>
            <li>The phrase "hide and seek" (or similar) is said</li>
        </ul>

        <p>If there are no players inside when the board breaks, it will not trigger a hunt, but will still
            extend the duration of later hunts.</p>

    </article>

    <!-- SUMMONING CIRCLE -->
    <article title="summoning-circle">

        <h2 id="summoning-circle">Summoning Circle</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"This summoning circle looks dangerous."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine cerchio evocazione -->
        <img alt="Summoning Circle image should be here"
             src="imgs/cursed-possessions/summoning-circle-pic.webp"/>

        <p>The summoning circle is used to summon the ghost.
            This can be used to get a ghost photo, as well as facilitate the completion of several Objectives.</p>

        <p>The summoning circle can be used by lighting all five red candles with a lit igniter or a lit firelight.
            Each lit candle deducts 16% <cite>sanity</cite> from nearby players.</p>

        <p>Once all five candles are lit, the ghost is summoned in its full form and facing the closest player.
            The summoned ghost stays motionless for 5 seconds, unable to kill players.
            However, the front door will lock immediately after lighting the last candle.
            After this event, the lights in the ghost's current room will turn off
            and the ghost will immediately initiate a <cite>cursed hunt</cite> on the spot.</p>

        <p>If the last candle is lit while a hunt is ongoing, the ghost will instead be teleported
            to the centre of the circle, possibly killing players on the spot.</p>

        <p>Once the summoning circle is activated, it cannot be used again.</p>

    </article>

    <!-- TAROT CARDS -->
    <article title="tarot-cards">

        <h2 id="tarot-cards">Tarot Cards</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"Some cards we found, they do crazy stuff."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine carte -->
        <img alt="Tarot Cards image should be here"
             src="imgs/cursed-possessions/tarot-cards-pic.webp"/>

        <p>Tarot cards can be picked up with an empty hand and one card can be drawn at a time.
            Tarot cards can only be drawn while inside the investigation area.</p>

        <p>Each Tarot cards deck contains 10 randomly generated cards. There are 10 possible card types
            the player can draw, each having a unique effect on either the player or the ghost. After being used,
            each card will burn up and vanish in a uniquely-colored flame. Each card type has a different,
            independent chance of being drawn, so some card types can be drawn multiple
            times or not at all in a single deck.</p>

        <p>When the deck is used up, all future hunts will also be extended by 20 seconds.</p>

        <table>
            <tr>
                <th scope="col" class="card-img">Card</th>
                <th scope="col">Title</th>
                <th scope="col">Effect</th>
                <th scope="col">Burn color</th>
                <th scope="col">Draw chance</th>
            </tr>

            <?php
            $query = ("SELECT * FROM tarots;");
            $stmt = $db->query($query);
            while ($row = $stmt->fetch()) {
                echo <<<heredoc
                <tr>
                    <td><img class="card-img" src="{$row['image']}" alt="card image should be here"/></td>
                    <td><h3>{$row['name']}</h3></td>
                    <td><p>{$row['effect']}</p></td>
                    <td>{$row['colourHTML']}</td>
                    <td><p>{$row['chance']}</p></td>
                </tr>
                heredoc;
            }
            ?>
        </table>

    </article>

    <!-- VOODOO DOLL -->
    <article title="voodoo-doll">

        <h2 id="voodoo-doll">Voodoo Doll</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"We found this doll, it made the ghost angry."</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine bambola -->
        <img alt="Voodoo Doll image should be here"
             src="imgs/cursed-possessions/voodoo-doll-pic.webp"/>

        <p>Interacting with the voodoo doll will cause one of the 10 pins stuck in the doll to be
            pushed into it at random. This will cause the ghost to perform an interaction,
            and will drop the user's <cite>sanity</cite> by 5%.</p>

        <p>If the heart pin is pushed in, the user's sanity will drain by 10%, and the
            ghost will initiate a cursed hunt.</p>

        <p>If the user interacts with the voodoo doll while at 0% sanity, all remaining pins will be pushed
            in and a cursed hunt will also occur.</p>

    </article>

    <!-- MONKEY PAW -->
    <article title="monkey-paw">

        <h2 id="monkey-paw">Monkey Paw</h2>

        <small>
            <a href="#index">Back to index</a>
        </small>

        <p class="quote">
            <q>"My wish came true, but at what cost?"</q>
            <cite>-Objective Board</cite>
        </p>

        <!-- Immagine zampa -->
        <img alt="Monkey Paw image should be here"
             src="imgs/cursed-possessions/monkey-paw-pic.webp"/>

        <p>The Monkey Paw grants up to a certain number of wishes.</p>

        <p>Every wish will come with a negative side effect, with the severity depending on the wish.</p>

        <p>If the Monkey Paw recognizes a valid phrase, regardless if it is a valid wish or not,
            or when entering/exiting the investigation area, its fingers will twitch. When a wish is being granted,
            one of its fingers will bend. When all fingers are bent, the Monkey Paw cannot be used anymore.</p>

    </article>

</main>

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