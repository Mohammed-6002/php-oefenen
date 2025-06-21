<?php
require 'db.php';

$naam = $_POST['naam'];
$klas = $_POST['klas'];

$stmt = $conn->prepare("SELECT COUNT(*) FROM leerling WHERE naam = ? AND klas = ?");
$stmt->execute([$naam, $klas]);

if ($stmt->fetchColumn() == 0) {
    $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
    $insert->execute([$naam, $klas]);
    echo "Leerling toegevoegd.";
} else {
    echo "Leerling bestaat al!";
}
?>
<br><a href="index.php">Terug</a>
