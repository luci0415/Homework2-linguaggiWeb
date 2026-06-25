<?php
//accesso al connection
require_once 'connection.php';

if (!$db = connection::connect()) {
    echo ("Unable to connect to connection.");
}

//Per il form che permette di mostrare all'utente la descrizione desiderata sul fantasma selezionato
$g = null;  //Se è !=null allora l'utente ha selezionato la descrizione di un fantasma...
$descQuery = null;  //...e allora qui è presente la descrizione associata
if (ISSET($_POST['ghost'])) {
    $g = $_POST['ghost'];   //g == nome del fantasma selezionato
    $descQuery = "SELECT * FROM ghosts WHERE name = '$g';";
}

//Per il form che permette all'utente di mettere in risalto i soli fantasmi che hanno come "evidence" quelle scelte dall'utente stesso

$isTooMany = false; //Diventerà vero se l'utente seleziona più di 3 evidence
$evidences = [];    //Inizialmente vuoto, si riempe se l'utente seleziona delle prove e preme su "find your ghost!"
if (ISSET($_POST['evidence'])) {
    $evidences = $_POST['evidence'];    //$POST['evidence'] è un array, perchè nella sezione sotto, nelle checkbox, è scritto "name="evidence[]" " con le quadre

    if (count($evidences) > 3) {    //Se che l'utente ha inserito troppe evidence...
        $evidences = [];
        $isTooMany = true;
    }
}

//Funzione che formula la query che permette di ottenere le tre evidence associate a un fantasma dal connection
function ghostEvidences ($ghost, $db) {
    //SELECT tutte le evidence FROM la tabella evidences UNENDO gli id delle evidence DELLE TABELLE ghostsEvidences e Evidences
    // E UNENDO gli id dei fantasmi DELLE TABELLE ghosts e ghostsEvidences WHERE il nome del fantasma è $ghost
    $query = "
        SELECT e.*
        FROM evidences e
        JOIN ghostsEvidences ge ON e.id = ge.evidenceID
        JOIN ghosts g ON g.id = ge.ghostID
        WHERE g.name = '$ghost';";
    return $db->query($query);  //restituisce la stringa contenente la query
}

//Funzione che formula la query che permette di escludere i fantasmi che non hanno le evidence selezionate dall'utente
function hasEvidences($ghost, array $evidences, PDO $db) {
    if (empty($evidences)) {    //Se vuoto, tutti i fantasmi risultano idonei
        return true;
    }

    //Conversione dell'array $evidences[] in una stringa $evidenceString di formato "e1, e2, e3"
    $evidenceString = "'$evidences[0]'";
    for ($i = 1; $i < count($evidences); $i++) {
        $evidenceString .= ", '$evidences[$i]'";
    }

    //SELECT la QUANTITà DI DISTINTI nomi delle evidence  FROM la tabella ghostsEvidences (contenente le corrispondenze ghostID<-->evidenceID)
    // UNENDO gli id delle evidence DELLE TABELLE ghostsEvidences e Evidences
    // E UNENDO gli id dei fantasmi DELLE TABELLE ghosts e ghostsEvidences
    // WHERE il nome del fantasma è $ghost AND il nome della evidence è contenuto IN la stringa evidenceString
    $query = "
        SELECT COUNT(DISTINCT e.name)
        FROM ghostsEvidences ge
        JOIN evidences e ON e.id = ge.evidenceID
        JOIN ghosts g ON g.id = ge.ghostID
        WHERE g.name = '$ghost'
        AND e.name IN ($evidenceString);
    ";

    $stmt = $db->query($query);
    //Restituisce un booleano: se il count della query è uguale al numero di evidence selezionate dall'utente, allora il fantasma in questione "è idoneo"
    return $stmt->fetchColumn() === count($evidences);  //Si usa "fetchColumn" perchè "fetch" restituisce un array (e non un intero)
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Titolo della pagina -->
    <title>Book of Ghosts</title>

    <!-- Foglio di stile principale -->
    <link rel="stylesheet" href="book-of-ghosts.css" />

    <!-- Icona user -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"

    <!-- Font Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Creepster&amp;display=swap" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nosifer&amp;family=Special+Elite&amp;display=swap" />

    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&amp;display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&amp;display=swap" rel="stylesheet" />

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
        BOOK OF GHOST
    </h1>

    <!-- Sottotitolo -->
    <h2 class="subtitle">
        - Phasmophobia -
    </h2>
</section>

<br/>

<main>
    <!-- Tabella con la lista dei fantasmi -->
    <table>

        <tr>
            <th colspan="2">
                <!-- Titolo tabella -->
                <h3 class="tab-header">
                    Ghost Types
                </h3>

                <p>Select a ghost type below
                    to view more information</p>
            </th>
        </tr>

<?php
        $stmt = $db->query("SELECT * FROM ghosts"); //Seleziona tutti i fantasmi dal connection
        do  {
            if ($row = $stmt->fetch()) {    //Se dallo statemente stmt viene estratta una nuova riga della tabella dei fantasmi...
                $name = htmlspecialchars($row['name']); //Allora assegnamo il nome del fantasma dalla colonna 'name' a $name
                echo ("
                        <td><form method=\"post\" action=\"\">  <!--Elemento dato della tabella, è un form che permette interazione con l'utente-->
                            <button name=\"ghost\" value=\"$name\"  
                    ");                                     //In particolare usiamo il tag button che esegue il submit e invia il POST (desiderato
                                                                //dall'utente) al programma, il nome di questo POST sarà proprio il nome del fantasma

                //Prima di chiudere il tag button, si verifica se l'utente abbia chiesto di filtrare i fantasmi in base all'evidence
                if (!empty($evidences) && !hasEvidences($row['name'], $evidences, $db)) {   //E se il fantasma non ha le evidence selezionate...
                    echo ("
                            style=\"text-decoration: line-through\"
                    ");    //...allora questo fantasma si esclude, sbarrandone il nome nella tabella
                }

                echo <<<heredoc
                            >$name</button> <!--Chiudiamo i tag button e form-->
                            </form></td>
                    heredoc;
            } else break;
            //Poi, prima di chiudere la attuale riga della tabella (<tr>) si ripete l'if, così se c'è un altro fantasma,
            // questo viene inserito nella stessa riga, in questo modo si ottengono due colonne
            if ($row = $stmt->fetch()) {
                $name = htmlspecialchars($row['name']);
                echo <<<heredoc
                        <td><form method="post" action="">
                            <button name="ghost" value="$name" 
                    heredoc;

                if (!empty($evidences) && !hasEvidences($row['name'], $evidences, $db)) {
                    echo <<<heredoc
                    style="text-decoration: line-through;"
                    heredoc;
                }

                echo <<<heredoc
                            >$name</button>
                            </form></td>
                    heredoc;

            }
            echo ("</tr>"); //Infine si chiude il tag della attuale riga e si ripete il ciclo
        } while($row);  //Esegue il ciclo finchè $row non è null, ovvero finchè non finiscono i fantasmi

        echo ("
    </table>"); //Chiusura del tag table

    //Se $descQuery è !=null, allora è attualmente selezionato un fantasma, e se ne mostra quindi la descrizione al lato
    if ($descQuery) {
        $row = $db->query($descQuery)->fetch(); //Esegue la query ottenuta dalla funzione sopra, ottiene la descrizione
        $desc = $row['description'];
        echo <<<heredoc
            <article class="description">
                <h3 class="tab-header">$g</h3>
                <p>$desc</p>
                <br><br>
            heredoc;
        $stmt = ghostEvidences($g, $db);    //Si fa uso di questa funzione per ricavare le evidence del fantasma dalla tabella evidences
        while ($row = $stmt->fetch()) {
            $evidence = htmlspecialchars($row['name']);
            echo ("<p>$evidence</p>");
        }
        echo ("
            </article>");   //Chiusura del tag article
    }

echo("</main>");    //Chiusura del main, la funzione del filtraggio è secondaria allo scopo informativo della pagina

echo <<<heredoc
    <section class="filter">   <!--Section per distinguerla dal main-->
    <h3>Which ghost is it?</h3>
    <form method="post" action="">  <!--Altro form per comunicare con l'utente-->
    heredoc;
        $stmt = $db->query("SELECT * FROM evidences");  //Si selezionano tutte le evidence al fine di stamparle su schermo
        while ($row = $stmt->fetch()) {
            $name = htmlspecialchars($row['name']);
            echo <<<heredoc
                <input type="checkbox" name="evidence[]" value="$name">$name</input>
                heredoc;    //Stavolta un tag input, di tipo checkbox: l'utente può spuntarne più di una contemporaneamente...
        }
    echo ("
                <button type='submit' name='filter'>Find your ghost!</button>   <!--...poi, scelte le evidence, comunica al programma, 
                                                                                tramite submit del tag button, di filtrare di conseguenza i fantasmi-->
    </form>");  //Chiusura del tag form

    if ($isTooMany) {   //Controllo che non siano state selezionate troppe evidence, altrimenti -->messaggio d'errore
        echo ("<p>Too many evidences selected, max is 3.</p>");
    }
    echo("
    </section>");   //Chiusura tag section


?>


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