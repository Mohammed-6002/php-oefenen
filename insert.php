<?php
require 'db.php';

$naam = $_POST['naam'];
$klas = $_POST['klas'];
$vak = $_POST['vak'];
$cijfer = $_POST['cijfer'];

$stmt = $conn->prepare("SELECT id FROM leerling WHERE naam = ? AND klas = ?");
$stmt->execute([$naam, $klas]);
$leerling_id = $stmt->fetchColumn();

if (!$leerling_id) {
    $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
    $insert->execute([$naam, $klas]);
    $leerling_id = $conn->lastInsertId();
    echo "Leerling toegevoegd.<br>";
} else {
    echo "Leerling bestaat al.<br>";
}

$insert_toets = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$insert_toets->execute([$leerling_id, $vak, $cijfer]);
echo "Toets toegevoegd.<br>";

echo '<a href="detail.php?id=' . $leerling_id . '">Bekijk leerling details</a><br>';
echo '<a href="index.php">Terug naar overzicht</a>';
?>
