<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

// =========================
// LETTURA DATI
// =========================
$id = $_GET["id"] ?? null;

if ($id) {

    $stmt = $db->prepare("SELECT * FROM mappe WHERE id = ?");
    $stmt->execute([$id]);
    $mappa = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmtCover = $db->prepare("
    SELECT percorso_file
    FROM imag_case
    WHERE id_mappa = ?
    AND tipo = 'cover'
    LIMIT 1
    ");
    $stmtCover->execute([$id]);
    $cover = $stmtCover->fetchColumn();

    $stmtPlan = $db->prepare("
    SELECT percorso_file
    FROM imag_case
    WHERE id_mappa = ?
    AND tipo = 'plan'
    LIMIT 1
    ");
    $stmtPlan->execute([$id]);
    $plan = $stmtPlan->fetchColumn();

    $stmtGallery = $db->prepare("
    SELECT percorso_file
    FROM imag_case
    WHERE id_mappa = ?
    AND tipo = 'gallery'
    ");
    $stmtGallery->execute([$id]);
    $gallery = $stmtGallery->fetchAll(PDO::FETCH_COLUMN);

} else {

    $stmt = $db->query("SELECT * FROM mappe");
    $mappe = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!-- Inizio documento HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="maps-main-page.css"/>
    <title>Maps</title>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

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

<!--Mini mappe-->
<!-- Verifica che sia presente un id e che la mappa esista -->
<?php if ($id && isset($mappa)): ?>

    <div class="main_mappe">

        <!-- Scheda informazioni -->
        <div class="specs">

            <h1><?= $mappa["nome"] ?></h1>
        <table>
            <tbody>
                <tr>
                    <th><strong>Size:</strong></th> 
                    <td><?= $mappa["size"] ?></td>
                </tr>
                <tr>    
                    <th><strong>Floors:</strong></th>  
                    <td><?= $mappa["floors"] ?></td>
                </tr>    
                <tr>    
                    <th><strong>Rooms:</strong></th>  
                    <td><?= $mappa["rooms"] ?></td>
                </tr>    
                <tr>    
                    <th><strong>Exits:</strong></th>  
                    <td><?= $mappa["exit_count"] ?></td>
                </tr>    
            </tbody>
        </table>        
        </div>

        <!-- Planimetria -->
        <?php if ($plan): ?>
        <div class="planimetry">
            <img src="<?= $plan ?>" alt="Map plan" />
        </div>
        <?php endif; ?>

    </div>

    <!-- Galleria immagini -->
    <?php if (!empty($gallery)): ?>
    <div class="rooms">

        <?php foreach ($gallery as $img): ?>
            <img src="<?= $img ?>" alt="Gallery image" />
        <?php endforeach; ?>

    </div>
    <?php endif; ?>

<?php else: ?>

<!--maps home-->
<div class="main">

    <h1>Maps</h1>
    <div class="section div">

    <!-- Lista delle mappe -->
    <ul>

        <!-- Ciclo che scorre tutte le mappe -->
        <?php foreach ($mappe as $m): ?>

            <?php

            // Query per ottenere la cover della mappa corrente
            $stmtImg = $db->prepare("
                SELECT percorso_file
                FROM imag_case
                WHERE id_mappa = ?
                AND tipo = 'cover'
                LIMIT 1
            ");

            // Esegue la query usando l'id della mappa
            $stmtImg->execute([$m["id"]]);

            // Recupera il percorso della cover
            $img = $stmtImg->fetchColumn();

            ?>

            <!-- Elemento della lista -->
            <li>
                <!-- Immagine di copertina della mappa -->
                <img src="<?= $img ?>" alt="map img" />
                <!-- Link alla pagina dettagli della mappa -->
                <a href="?id=<?= $m["id"] ?>">

                    <!-- Nome della mappa -->
                    <?= $m["nome"] ?>

                </a>

            </li>

        <?php endforeach; ?>

    </ul>

    </div>

</div>

<?php endif; ?>

<!-- Piè di pagina, per le informazioni di copyright e sugli autori -->
<div class="footer">

    <!-- Link al sito ufficiale di Phasmophobia -->
    <small id="original-site">More on
        <a href="https://kineticgames.co.uk/phasmophobia">Phasmophobia Official</a>
    </small>

    <!-- Sezione copyright -->
    <p>
        <small id="copyright">

            <!-- Informazioni legali -->
            &copy; 2026 Phasmophobia Wiki. Phasmophobia &trade; and all associated logos
            are Kinetic Games Limited's property. This is not an official site.

        </small>
    </p>

    <!-- Ringraziamento alla fonte di ispirazione -->
    <small class="thanks-to">Text and pictures inspired by
        <a href="https://phasmophobia.fandom.com/wiki/Phasmophobia">
            Phasmophobia Wiki | Fandom
        </a>
    </small>

    <!-- Elenco autori del progetto -->
    <small id="project-leaders">Authors: Emilio, Lucia</small>

</div>

<!-- Chiusura del body -->
</body>

<!-- Chiusura del documento HTML -->
</html>