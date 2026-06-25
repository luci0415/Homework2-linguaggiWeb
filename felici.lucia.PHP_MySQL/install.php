<?php
//Creazione del connection locale

//Variabili per l'accesso come admin
$host = "localhost";
$user = "root";
$pass = "";
$chrs = "utf8mb4";

try {
    //Utente, password e connection da creare
    $new_db = "emilio.russo.PHP-MySQL";
    $new_user = "user";
    $new_pass = "password";

    $attr = "mysql:host=$host;charset=$chrs";
    $opts =
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

    $pdo = new PDO($attr, $user, $pass, $opts);
    echo "Connesso come amministratore.<br>";

    $query = "CREATE DATABASE IF NOT EXISTS $new_db
              DEFAULT CHARACTER SET utf8mb4
              COLLATE utf8mb4_unicode_ci;";
    $pdo->exec($query);
    echo "Database '$new_db' creato con successo.<br>";

    $query = "CREATE USER IF NOT EXISTS '$new_user'@'localhost' 
                 IDENTIFIED BY '$new_pass';";
    $pdo->exec($query);
    echo "User '$new_user' creato con successo.<br>";

    $query = "GRANT ALL PRIVILEGES ON $new_db.* to $new_user@'localhost'";
    $pdo->exec($query);
    $pdo->exec("FLUSH PRIVILEGES;");
    echo "Privilegi assegnati correttamente all'utente.<br>";

    $query = "USE $new_db";
    $pdo->exec($query);

} catch (PDOException $e) {
    die("Errore durante la configurazione: " . $e->getMessage());
}


//Popolamento del connection
try {

    //Table dei fantasmi
    $query = "CREATE TABLE ghosts (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(32) NOT NULL,
        description TEXT NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB;";
    $pdo->exec($query);
    //Popolamento ghosts
    $query = "INSERT INTO ghosts (name, description) VALUES
        ('Aswang', 'Rumored to gorge itself on blood and corpses, the Aswang is feral yet capable of blending into urban environments.<br><br>STRENGTH: When they spot their target, Aswangs become faster in pursuit.<br><br>WEAKNESSES: Aswang prefer chasing over searching.'),
        ('Banshee', 'The singing siren, known for attracting its victims through song.<br>It has been known to single out its prey before making a killing blow.<br><br>STRENGTH: A Banshee will weaken their target before striking.<br><br>WEAKNESSES: Banshees can sometimes be heard screaming with a parabolic microphone.'),
        ('Dayan', 'The Dayan is born from the soul of someone who suffered immense cruelty in life.<br>Now, in death, she is hyper-vigilant of anyone who \'dances\' too close.<br><br>STRENGTH: The Dayan gains strength to protect herself if people \'dance\' too close to her.<br><br>WEAKNESSES: The Dayan loses strength if people close to her stand still.'),
        ('Deogen', 'Sometimes surrounded by an endless fog, Deogen have been eluding ghost hunters for years.<br>These ghosts have been reported to find even the most hidden prey, before stalking them into exhaustion.<br><br>STRENGTH: Deogen constantly sense the living. You can run but you can\'t hide.<br><br>WEAKNESSES: Deogen require a lot of energy to form and will move very slowly when approaching its victim.'),
        ('Demon', 'Demons are the most aggressive ghosts we\'ve ever encountered.<br>Known to attack without reason, they seem to enjoy the thrill of the hunt.<br><br>STRENGTH: Demons will initiate hunts more often than other ghosts.<br><br>WEAKNESSES: Demons fear the crucifix and will be less aggressive near one.'),
        ('Gallu', 'Another form of demon, the Gallu is a reminder that death comes for us all.<br>Using protective equipment provokes the ghost until it\'s no longer effective.<br><br>STRENGTH: Using protective equipment pushes the ghost to become enraged, weakening equipment effects.<br><br>WEAKNESSES: Being enraged exhausts the Gallu, making protective equipment more effective.'),
        ('Goryo', 'When a Goryo passes through a DOTS projector, using a video camera is the only way to see it.<br><br>STRENGTH: A Goryo will usually only show itself on camera if there are no people nearby.<br><br>WEAKNESSES: They are rarely seen far from their place of death.'),
        ('Hantu', 'A Hantu is a rare ghost that thrives in the coldest climates.<br>The cold seems to make them more aggressive and empowered.<br><br>STRENGTH: Lower temperatures allow the Hantu to move at faster speeds.<br><br>WEAKNESSES: Hantus move slower in warmer areas.'),
        ('Jinn', 'A Jinn is a territorial ghost that will attack when threatened.<br>It has also been known to be able to travel at significant speed.<br><br>STRENGTH: A Jinn will travel at a faster speed if its victim is far away.<br><br>WEAKNESSES: Turning off the location\'s power source will prevent the Jinn from using its ability.'),
        ('Kormos', 'Translating to the one who \'does not see\', the Kormos is blind, but uses its heightened hearing to hunt down victims.<br><br>STRENGTH: Kormos have incredibly strong hearing.<br><br>WEAKNESSES: Kormos are nearly blind.'),
        ('Mare', 'A Mare is the source of all nightmares, making it more powerful in the dark.<br><br>STRENGTH: A Mare will have an increased chance to attack in the dark.<br><br>WEAKNESSES: Turning the lights on around the Mare will lower its chance to attack.'),
        ('Moroi', 'Moroi have risen from the grave to drain energy from the living.<br>They have been known to place curses on their victims, curable only by antidotes or moving very far away.<br><br>STRENGTH: The weaker their victims, the stronger the Moroi becomes.<br><br>WEAKNESSES: Moroi suffer from hyperosmia, weakening them for longer periods.'),
        ('Myling', 'A Myling is a very vocal and active ghost.<br>They are rumoured to be quiet when hunting their prey.<br><br>STRENGTH: A Myling is known to be quieter when hunting.<br><br>WEAKNESSES: Mylings more frequently make paranormal sounds.'),
        ('Obake', 'Obake are terrifying shape-shifters, capable of taking on many forms.<br>They have been seen taking on humanoid shapes to attract their prey.<br><br>STRENGTH: When interacting with the environment, an Obake will rarely leave a trace.<br><br>WEAKNESSES: Sometimes this ghost will shapeshift, leaving behind unique evidence.'),
        ('Obambo', 'The Obambo is the ghost of someone never properly laid to rest.<br>Fickle and defensive, it flickers between states of calm and aggression.<br><br>STRENGTH: While aggressive, the Obambo is quicker to start hunting.<br><br>WEAKNESSES: While calm, the Obambo is slower to start hunting and easier to track.'),
        ('Oni', 'Oni love to scare their victims as much as possible before attacking.<br>They are often seen in their physical form, guarding their place of death.<br><br>STRENGTH: Oni are much more active whilst people are nearby and will drain their sanity faster when manifesting.<br><br>WEAKNESSES: Oni disappear less often while hunting their prey.'),
        ('Onryo', 'The Onryo is often referred to as \"The Wrathful Spirit\".<br>It steals souls from dying victims\' bodies to seek revenge.<br>This ghost has been known to fear any form of fire, and will do anything to be far from it.<br><br>STRENGTH: Extinguishing a flame can cause an Onryo to attack.<br><br>WEAKNESSES: When threatened, this ghost will be less likely to hunt.'),
        ('Phantom', 'A Phantom is a ghost that can possess the living, inducing fear into those around it.<br>They are most commonly summoned from Ouija Boards.<br><br>STRENGTH: Looking at a Phantom will drop your sanity considerably faster.<br><br>WEAKNESSES: Taking a photo of the Phantom will make it temporarily disappear.'),
        ('Poltergeist', 'One of the most famous ghosts, the Poltergeist.<br>Known to manipulate objects around it to spread fear into its victims.<br><br>STRENGTH: Poltergeists can throw multiple objects at once, and with great force.<br><br>WEAKNESSES: With nothing to throw, Poltergeists become powerless.'),
        ('Raiju', 'A Raiju is a demon that thrives on electrical current.<br>While generally calm, they can become agitated when overwhelmed with power.<br><br>STRENGTH: A Raiju can siphon power from nearby electrical devices, making it move faster.<br><br>WEAKNESSES: Raiju are constantly disrupting electronic equipment when attacking, making it easier to track.'),
        ('Revenant', 'A Revenant is a violent ghost that will attack indiscriminately.<br>Their speed can be deceiving, as they are slow while dormant; however, as soon as they hunt they can move incredibly fast.<br><br>STRENGTH: A Revenant will travel at a significantly faster speed when hunting their prey.<br><br>WEAKNESSES: Hiding from the Revenant will cause it to move very slowly.'),
        ('Shade', 'A Shade is known to be very shy.<br>There is evidence to suggest that a Shade will stop all paranormal activity if there are people nearby.<br><br>STRENGTH: Shades are much harder to find.<br><br>WEAKNESSES: The ghost will not enter a hunt if there are people nearby.'),
        ('Spirit', 'Spirits are very common ghosts. They are highly powerful, but passive, only attacking when they need to.<br>They defend their place of death to the utmost degree, killing anyone who is caught overstaying their welcome.<br><br>WEAKNESSES: A Spirit can be temporarily stopped by burning incense near them.'),
        ('Thaye', 'Thaye have been known to rapidly age over time, even in afterlife.<br>From what we\'ve learned, they seem to deteriorate faster while within presence of the living.<br><br>STRENGTH: Upon entering the location, Thaye will become active, defensive and agile.<br><br>WEAKNESSES: Thaye will weaken over time, making them weaker, slower and less aggressive.'),
        ('The Mimic', 'The Mimic is an elusive, mysterious, copycat ghost that mirrors traits and behaviours from others, including other ghost types.<br><br>STRENGTH: We\'re unsure what this ghost is capable of. Be careful.<br><br>WEAKNESSES: Several reports have noted ghost orb sightings near Mimics.'),
        ('The Twins', 'These ghosts have been reported to mimic each other\'s actions.<br>They alternate their attacks to confuse their prey.<br><br>STRENGTH: Either Twin can be angered and initiate an attack on their prey.<br><br>WEAKNESSES: The Twins will often interact with the environment at the same time.'),
        ('Wraith', 'Wraiths are one of the most dangerous ghosts you will find.<br>It is also the only known ghost that has the ability of flight and has sometimes been known to travel through walls.<br><br>STRENGTH: Wraiths almost never touch the ground, meaning it can\'t be tracked by footprints.<br><br>WEAKNESSES: Wraiths are afraid of salt and will actively avoid it.'),
        ('Yokai', 'Yokai are common ghosts that are attracted to human voices.<br>They can usually be found haunting family homes.<br><br>STRENGTH: Talking near a Yokai will anger it, increasing the chance of an attack.<br><br>WEAKNESSES: When hunting, a Yokai can only hear voices close to it.'),
        ('Yurei', 'A Yurei is a ghost that has returned to the physical world, usually for the purpose of revenge or hatred.<br><br>STRENGTH: Yureis have been known to have a stronger effect on people\'s sanity.<br><br>WEAKNESSES: Smudging the Yurei\'s place of death will trap it temporarily, reducing how much it wanders.');
        ";
    $pdo->exec($query);


    //Tabella delle evidence
    $query = "CREATE TABLE evidences (
        name VARCHAR(64) NOT NULL,
        id SMALLINT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(id)
    ) ENGINE InnoDB;";
    $pdo->exec($query);
    //Popolamento evidences
    $query = "INSERT INTO evidences(name) VALUES
        ('D.O.T.S. Projector'),
        ('EMF Level 5'),
        ('Freezing Temperatures'),
        ('Ghost Writing'),
        ('Fingerprints'),
        ('Ghost Orbs'),
        ('Spirit Box');";
    $pdo->exec($query);


    //Tabella che lega i fantasmi alle evidence, secondo una relazione many-to-many
    $query = "CREATE TABLE ghostsEvidences (
        ghostID SMALLINT NOT NULL,
        evidenceID SMALLINT NOT NULL,
        PRIMARY KEY(ghostID, evidenceID)
    ) ENGINE InnoDB;";
    $pdo->exec($query);
    //Popolamento
    $query = "INSERT INTO ghostsEvidences (ghostID, evidenceID) VALUES
        ((SELECT id FROM ghosts WHERE name = 'Aswang'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Aswang'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Aswang'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Banshee'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Banshee'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Banshee'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        
        ((SELECT id FROM ghosts WHERE name = 'Dayan'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Dayan'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Dayan'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Demon'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Demon'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Demon'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Deogen'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Deogen'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Deogen'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Gallu'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Gallu'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Gallu'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        
        ((SELECT id FROM ghosts WHERE name = 'Goryo'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Goryo'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Goryo'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        
        ((SELECT id FROM ghosts WHERE name = 'Hantu'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Hantu'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Hantu'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        
        ((SELECT id FROM ghosts WHERE name = 'Jinn'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Jinn'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Jinn'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        
        ((SELECT id FROM ghosts WHERE name = 'Kormos'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Kormos'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Kormos'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Mare'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Mare'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Mare'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Moroi'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Moroi'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Moroi'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Myling'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Myling'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Myling'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Obake'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Obake'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Obake'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        
        ((SELECT id FROM ghosts WHERE name = 'Obambo'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Obambo'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Obambo'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Oni'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Oni'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Oni'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        
        ((SELECT id FROM ghosts WHERE name = 'Onryo'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Onryo'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Onryo'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Phantom'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Phantom'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Phantom'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Poltergeist'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'Poltergeist'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Poltergeist'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Raiju'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Raiju'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Raiju'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        
        ((SELECT id FROM ghosts WHERE name = 'Revenant'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Revenant'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Revenant'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Shade'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Shade'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Shade'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'Spirit'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Spirit'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Spirit'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Thaye'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Thaye'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Thaye'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        
        ((SELECT id FROM ghosts WHERE name = 'The Mimic'), (SELECT id FROM evidences WHERE name = 'Fingerprints')),
        ((SELECT id FROM ghosts WHERE name = 'The Mimic'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'The Mimic'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'The Twins'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'The Twins'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'The Twins'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Wraith'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Wraith'), (SELECT id FROM evidences WHERE name = 'EMF Level 5')),
        ((SELECT id FROM ghosts WHERE name = 'Wraith'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Yokai'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs')),
        ((SELECT id FROM ghosts WHERE name = 'Yokai'), (SELECT id FROM evidences WHERE name = 'Ghost Writing')),
        ((SELECT id FROM ghosts WHERE name = 'Yokai'), (SELECT id FROM evidences WHERE name = 'Spirit Box')),
        
        ((SELECT id FROM ghosts WHERE name = 'Yurei'), (SELECT id FROM evidences WHERE name = 'D.O.T.S. Projector')),
        ((SELECT id FROM ghosts WHERE name = 'Yurei'), (SELECT id FROM evidences WHERE name = 'Freezing Temperatures')),
        ((SELECT id FROM ghosts WHERE name = 'Yurei'), (SELECT id FROM evidences WHERE name = 'Ghost Orbs'));";
    $pdo->exec($query);


    //Table degli oggetti
    $query = "CREATE TABLE items (
        cssID smallint unsigned NOT NULL AUTO_INCREMENT,
        name VARCHAR(64) NOT NULL,
        price VARCHAR(32),
        maxAmount smallint,
        description TEXT NOT NULL,
        type VARCHAR(32) NOT NULL,
        imageURL VARCHAR(64) NOT NULL,
        KEY (cssID)
    ) ENGINE InnoDB;";
    $pdo->exec($query);
    //popolamento items
    $query = "INSERT INTO items (name, price, maxAmount, description, type, imageURL) VALUES                                     
        ('D.O.T.S. Projector', '$65', 2, 'Creates a field of green lights when placed. Used to detect D.O.T.S Projector evidence.', 'Starter Equipment', 'imgs/items-pics/DOTS.jpg'),
        ('EMF Reader', '$45', 2, 'Can detect EMF presence in the area. Used to obtain EMF Level 5 evidence.', 'Starter Equipment', 'imgs/items-pics/EMF.webp'),
        ('Flashlight', '$30', 2, 'Provides a basic source of light.', 'Starter Equipment', 'imgs/items-pics/FLASHLIGHT.jpg'),
        ('Ghost Writing Book', '$40', 2, '	Used to obtain Ghost Writing from a ghost.', 'Starter Equipment', 'imgs/items-pics/BOOK.jpg'),
        ('Spirit Box', '$50', 2, 'Used to communicate with a ghost through questions.', 'Starter Equipment', 'imgs/items-pics/SPIRITBOX.jpg'),
        ('Thermometer', '$30', 2, 'Displays the local temperature of a room. Can be used to detect Freezing Temperatures.', 'Starter Equipment', 'imgs/items-pics/THERMO.jpg'),
        ('UV Light', '$35', 2, 'Used to reveal fingerprints and footprints created by ghosts.', 'Starter Equipment', 'imgs/items-pics/UV.jpg'),
        ('Video Camera', '$50', 2, 'Creates a video feed, which is relayed to the truck''s computer. Used to detect Ghost Orbs and recordings.', 'Starter Equipment', 'imgs/items-pics/CAMERA.jpg'),
        ('Crucifix', '$30', 2, 'Prevents ghosts from hunting in a certain radius.', 'Optional Equipment', 'imgs/items-pics/CRUCIFIX.png'),
        ('Firelight', '$15', 4, 'Used for optional objectives and to provide light.', 'Optional Equipment', 'imgs/items-pics/FIRELIGHT.jpg'),
        ('Head Gear', '$60', 4, 'Can be equipped on a player''s head. Functionality depends on upgrade tier.', 'Optional Equipment', 'imgs/items-pics/HEADGEAR.png'),
        ('Igniter', '$10', 4, 'Used to light firelights and incense.', 'Optional Equipment', 'imgs/items-pics/IGNITER.png'),
        ('Incense', '$15', 4, 'Prevents ghosts from hunting for a short time.', 'Optional Equipment', 'imgs/items-pics/INCENSE.jpg'),
        ('Motion Sensor', '$100', 4, 'Triggers when something passes nearby.', 'Optional Equipment', 'imgs/items-pics/MOTION.png'),
        ('Parabolic Microphone', '$50', 2, '	Used to listen to paranormal sounds.', 'Optional Equipment', 'imgs/items-pics/PARABOLIC.png'),
        ('Photo Camera', '$40', 3, 'Used to take photos for rewards.', 'Optional Equipment', 'imgs/items-pics/PHOTOCAM.png'),
        ('Salt', '$15', 3, 'Creates piles that ghosts can interact with.', 'Optional Equipment', 'imgs/items-pics/SALT.png'),
        ('Sanity Medication', '$20', 4, 'Restores sanity.', 'Optional Equipment', 'imgs/items-pics/SANITY.png'),
        ('Sound Recorder', '$30', 2, 'Records paranormal sounds.', 'Optional Equipment', 'imgs/items-pics/RECPRDER.png'),
        ('Sound Sensor', '$80', 2, 'Detects sound in an area.', 'Optional Equipment', 'imgs/items-pics/SENSOR.png'),
        ('Tripod', '$25', 4, 'Mount for video cameras.', 'Optional Equipment', 'imgs/items-pics/TRIPOD.png'),
        ('Clipboards', NULL, NULL, 'Shows the current Daily and Weekly Tasks.', 'Truck Equipment', 'imgs/items-pics/CLIPBOARD.png'),
        ('Computer', NULL, NULL, 'Used to view onsite cameras, including active video cameras.', 'Truck Equipment', 'imgs/items-pics/COMPUTER.png'),
        ('Objective Board', NULL, NULL, 'Displays all mandatory and optional objectives.', 'Truck Equipment', 'imgs/items-pics/OBJECTIVE.png'),
        ('Sanity Monitor', NULL, NULL, 'Provides a real-time summary of all players'' sanity levels.', 'Truck Equipment', 'imgs/items-pics/SANITY.jpg'),
        ('Site Activity Monitor', NULL, NULL, 'Displays ghost activity. High levels indicate events or hunts.', 'Truck Equipment', 'imgs/items-pics/ACTIVITY.png'),
        ('Site Map', NULL, NULL, 'Provides a detailed map of the location.', 'Truck Equipment', 'imgs/items-pics/MAP.png'),
        ('Sound Monitor', NULL, NULL, 'Displays sound detected by sensors.', 'Truck Equipment', 'imgs/items-pics/SOUND.png');";
    $pdo->exec($query);


    //table dei tarocchi negli oggetti maledetti
    $query = ("CREATE TABLE tarots (
        id smallint NOT NULL AUTO_INCREMENT,
        image VARCHAR(64) NOT NULL,
        name VARCHAR(30) NOT NULL,
        effect VARCHAR(256) NOT NULL,
        colourHTML VARCHAR(64),
        chance VARCHAR(32) NOT NULL,
        INDEX (id)
    )");
    $pdo->exec($query);
    $query = ("INSERT INTO tarots (image, name, effect, colourHTML, chance) VALUES
        ('imgs/cursed-possessions/tarots/tower-pic.webp', 'The Tower', 'Doubles all potential ghost activity for 20 seconds.', '<div class=\"colour blue\">Blue</div>', '20%'),
        ('imgs/cursed-possessions/tarots/wheel-of-fortune-pic.webp', 'The Wheel of Fortune', '<div class=\"colour green\">green</div> (sanity gain) or <div class=\"colour red\">red</div> (sanity loss)', 'green (sanity gain) or red (sanity loss)', '20%'),
        ('imgs/cursed-possessions/tarots/fool-pic.webp', 'The Fool', 'Selects another random card to mimic with the same chance for each, before turning into The Fool as it burns. No effect is applied when drawing this card.', '<div class=\"colour light-purple\">Light Purple</div>', '17%, 100% during hunts'),
        ('imgs/cursed-possessions/tarots/devil-pic.webp', 'The Devil', 'Triggers a ghost event towards the nearest player to the ghost.', '<div class=\"colour pink\">Pink</div>', '10%'),
        ('imgs/cursed-possessions/tarots/death-pic.webp', 'The Death', 'Triggers a cursed hunt.', '<div class=\"colour purple\">Purple</div>', '10%'),
        ('imgs/cursed-possessions/tarots/hermit-pic.webp', 'The Hermit', 'Forces the ghost to walk to the ghost room. Does not prevent events or hunts from happening.', '<div class=\"colour cyan\">Cyan</div>', '10%'),
        ('imgs/cursed-possessions/tarots/sun-pic.webp', 'The Sun', 'Sets the player\'s sanity to 100%.', '<div class=\"colour yellow\">Yellow</div>', '5%'),
        ('imgs/cursed-possessions/tarots/moon-pic.webp', 'The Moon', 'Sets the player\'s sanity to 0%.', '<div class=\"colour white\">White</div>', '5%'),
        ('imgs/cursed-possessions/tarots/high-priestess-pic.webp', 'The High Priestess', 'Revives a random dead player where they died. If no one is currently dead, it will revive the next player who dies.', '<div class=\"colour light-yellow\">Light Yellow</div>', '2%'),
        ('imgs/cursed-possessions/tarots/hanged-man-pic.webp', 'The Hanged Man', 'Instantly kills the player. Unlike the other cards, The Hanged Man does not burn up afterwards.', '', '1%');
    ");
    $pdo->exec($query);


    //Table delle mappe
    $pdo->exec("
            CREATE TABLE mappe (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(150) NOT NULL UNIQUE,
                size VARCHAR(20) NOT NULL,
                floors INT NOT NULL,
                rooms VARCHAR(100) NOT NULL,
                exit_count INT NOT NULL
            )
        ");
    //Array contenuti da inserire nella tabella
    $maps = [
        ["6 Tanglewood Drive","Small",2,"11(1F), 1(B)",1],
        ["42 Edgefield Road","Small",3,"7(1F), 8(2F), 1(B)",1],
        ["10 Ridgeview Court","Small",3,"6(2F), 9(1F), 1(B)",1],
        ["13 Willow Street","Small",2,"7(1F), 3(B)",1],
        ["Grafton Farmhouse","Small",3,"8(1F), 5(2F), 1(A)",1],
        ["Bleasdale Farmhouse","Medium",3,"2(A), 8(2F), 11(1F)",2],
        ["Brownstone High School","Large",2,"34(1F), 30(2F)",5],
        ["Maple Lodge Campsite","Medium",3,"28",1],
        ["Sunny Meadows","Large",2,"44(1F), 22(B), 3(Staircases)",1],
        ["Nell's Diner","Small",1,"14",2],
        ["Point Hope","Medium",10,"16",1],
        ["Prison","Medium",2,"12(2F), 19(1F)",3],
        ["Camp Woodwind","Small",1,"11",1]
    ];
    //Preparazione istruzione con placeholder
    $stmtMap = $pdo->prepare("
            INSERT IGNORE INTO mappe
            (nome, size, floors, rooms, exit_count)
            VALUES (?, ?, ?, ?, ?)
        ");


    //Table immagine delle mappe
    $pdo->exec("
        CREATE TABLE imag_case (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_mappa INT NOT NULL,
            tipo ENUM('cover','plan','gallery') NOT NULL,
            percorso_file VARCHAR(255) NOT NULL,
            FOREIGN KEY (id_mappa) REFERENCES mappe(id) ON DELETE CASCADE
        )
        ");
    //Array contenuti da inserire nella tabella
    $imgData = [
        1 => ["tanglewood/tanglewood.webp", "tanglewood/tanglewood-plan.svg","tanglewood/pic1.webp","tanglewood/pic2.webp", "tanglewood/pic3.webp", "tanglewood/pic4.webp", "tanglewood/pic5.webp"],
        2 => ["edgefield/edgefield.png", "edgefield/edgefield-plan.svg","edgefield/pic1.png","edgefield/pic2.png", "edgefield/pic3.png", "edgefield/pic4.png", "edgefield/pic5.png", "edgefield/pic6.png"],
        3 => ["ridgeview/ridgeview.png", "ridgeview/ridgeview-plan.svg","ridgeview/pic1.png","ridgeview/pic2.png", "ridgeview/pic3.png", "ridgeview/pic4.png", "ridgeview/pic5.png"],
        4 => ["willow/willow.png", "willow/willow-plan.svg","willow/pic1.png","willow/pic2.png", "willow/pic3.png", "willow/pic4.png", "willow/pic5.png"],
        5 => ["grafton/grafton.webp", "grafton/grafton-plan.svg","grafton/pic1.webp","grafton/pic2.webp", "grafton/pic3.webp", "grafton/pic4.webp", "grafton/pic5.webp"],
        6 => ["bleasdale/bleasdale.jpg", "bleasdale/bleasdale-plan.svg","bleasdale/pic1.webp","bleasdale/pic2.webp","bleasdale/pic3.webp", "bleasdale/pic4.webp", "bleasdale/pic5.webp"],
        7 => ["brownstone/brownstone.png", "brownstone/brownstone-plan.svg","brownstone/pic1.png", "brownstone/pic2.png", "brownstone/pic3.png", "brownstone/pic4.png", "brownstone/pic5.png", "brownstone/pic6.png"],
        8 => ["maple-lodge/maple-lodge.png", "maple-lodge/maple-lodge-plan.svg","maple-lodge/pic1.png", "maple-lodge/pic2.png", "maple-lodge/pic3.png", "maple-lodge/pic4.png", "maple-lodge/pic5.png"],
        9 => ["meadows/meadows.png", "meadows/meadows.png","meadows/pic1.png", "meadows/pic2.png", "meadows/pic3.png", "meadows/pic4.png", "meadows/pic5.png", "meadows/pic6.png"],
        10 => ["nells-diner/nells-diner.webp", "nells-diner/nells-diner-plan.webp","nells-diner/pic1.webp", "nells-diner/pic2.webp", "nells-diner/pic3.webp", "nells-diner/pic4.webp"],
        11 => ["point-hope/point-hope.png", "point-hope/point-hope-plan.svg","point-hope/pic1.png", "point-hope/pic2.png", "point-hope/pic3.png", "point-hope/pic4.png", "point-hope/pic5.png", "point-hope/pic6.png"],
        12 => ["prison/prison.png", "prison/prison-plan.svg","prison/pic1.png", "prison/pic2.png", "prison/pic3.png", "prison/pic4.png", "prison/pic5.png"],
        13 => ["woodwind/woodwind.png", "woodwind/woodwind-plan.svg","woodwind/pic1.png", "woodwind/pic2.png", "woodwind/pic3.png", "woodwind/pic4.png", "woodwind/pic5.png"]
    ];
    //Preparazione istruzione con placeholder
    $stmtImg = $pdo->prepare("
        INSERT INTO imag_case
        (id_mappa, tipo, percorso_file)
        VALUES (?, ?, ?)
        ");


    //Esecuzione delle preparazioni precedenti per popolare le tabelle "mappe" e "imag_case"
    foreach ($maps as $i => $m) {

        $stmtMap->execute($m);

        $stmtId = $pdo->prepare("SELECT id FROM mappe WHERE nome = ?");
        $stmtId->execute([$m[0]]);
        $id = $stmtId->fetchColumn();

        foreach ($imgData[$i + 1] as $index => $img) {

            $path = "imgs/maps-pics/" . $img;

            if ($index === 0) {
                $tipo = "cover";
            } elseif ($index === 1) {
                $tipo = "plan";
            } else {
                $tipo = "gallery";
            }

            $check = $pdo->prepare("
                SELECT COUNT(*)
                FROM imag_case
                WHERE id_mappa = ?
                AND percorso_file = ?
            ");

            $check->execute([$id, $path]);

            if (!$check->fetchColumn()) {
                $stmtImg->execute([$id, $tipo, $path]);
            }
        }
    }


    //Table degli users per registrazione e login, non popolata: lo si fa tramite registrazione
    $query = "CREATE TABLE users (
        nome VARCHAR(64) NOT NULL,
        cognome VARCHAR(64) NOT NULL,
        email VARCHAR(64) NOT NULL,
        password VARCHAR(64) NOT NULL,
        username VARCHAR(64) NOT NULL
    ) ENGINE InnoDB;";
    $pdo->exec($query);


} catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}