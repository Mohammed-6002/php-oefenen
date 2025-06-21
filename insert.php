<?php
require 'db.php';

$vak = $_POST['vak'] ?? null;
$cijfer = $_POST['cijfer'] ?? null;

if (isset($_POST['leerling_id']) && !empty($_POST['leerling_id'])) {
    // Bestaande code voor toets toevoegen
    $leerling_id = $_POST['leerling_id'];
} else {
    // NIEUW: Bewaar naam/klas voor tonen
    $naam = $_POST['naam'] ?? null;
    $klas = $_POST['klas'] ?? null;

    if (!$naam || !$klas) {
        die("Naam en klas zijn verplicht voor een nieuwe leerling.");
    }

    $stmt = $conn->prepare("SELECT id FROM leerling WHERE naam = ? AND klas = ?");
    $stmt->execute([$naam, $klas]);
    $leerling_id = $stmt->fetchColumn();

    if (!$leerling_id) {
        $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
        $insert->execute([$naam, $klas]);
        $leerling_id = $conn->lastInsertId();
        
        // Redirect to overzicht.php after adding new leerling
        header("Location: overzicht.php");
        exit;
    } else {
        echo "<p>Leerling '$naam' uit klas '$klas' bestaat al.</p>";
    }
}

// Rest van de code blijft hetzelfde
if (!$vak || !$cijfer) {
    die("Vak en cijfer zijn verplicht.");
}

$insert_toets = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$insert_toets->execute([$leerling_id, $vak, $cijfer]);

// Redirect to overzicht.php after adding toets
header("Location: overzicht.php");
exit;
?>