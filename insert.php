<?php
require 'db.php';

$vak = $_POST['vak'] ?? null;
$cijfer = $_POST['cijfer'] ?? null;

if (isset($_POST['leerling_id']) && !empty($_POST['leerling_id'])) {
    // Adding test score for existing student
    $leerling_id = $_POST['leerling_id'];
} else {
    // Adding new student
    $naam = $_POST['naam'] ?? null;
    $klas = $_POST['klas'] ?? null;

    if (!$naam || !$klas) {
        die("Naam en klas zijn verplicht voor een nieuwe leerling.");
    }

    // Check if student exists
    $stmt = $conn->prepare("SELECT id FROM leerling WHERE naam = ? AND klas = ?");
    $stmt->execute([$naam, $klas]);
    $leerling_id = $stmt->fetchColumn();

    if (!$leerling_id) {
        // Insert new student
        $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
        $insert->execute([$naam, $klas]);
        $leerling_id = $conn->lastInsertId();
        echo "Leerling toegevoegd.<br>";
    } else {
        echo "Leerling bestaat al.<br>";
    }
}

if (!$vak || !$cijfer) {
    die("Vak en cijfer zijn verplicht.");
}

// Insert test score
$insert_toets = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$insert_toets->execute([$leerling_id, $vak, $cijfer]);
echo "Toets toegevoegd.<br>";

echo '<a href="detail.php?id=' . $leerling_id . '">Bekijk leerling details</a><br>';
echo '<a href="index.php">Terug naar overzicht</a>';
?>
