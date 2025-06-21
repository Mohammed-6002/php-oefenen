<?php
require 'db.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $klas = $_POST['klas'];
    $stmt = $conn->prepare("UPDATE leerling SET naam = ?, klas = ? WHERE id = ?");
    $stmt->execute([$naam, $klas, $id]);
    header("Location: overzicht.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM leerling WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();
?>

<h2>Leerling wijzigen</h2>
<form method="post">
    Naam: <input type="text" name="naam" value="<?= $data['naam'] ?>" required><br>
    Klas: <input type="text" name="klas" value="<?= $data['klas'] ?>" required><br>
    <input type="submit" value="Opslaan">
</form>
