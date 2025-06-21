<?php
require 'db.php';

// AANTAL LEERLINGEN TONEN (nieuw toegevoegd)
$aantal_leerlingen = $conn->query("SELECT COUNT(*) FROM leerling")->fetchColumn();
echo "<h2>Leerlingen ($aantal_leerlingen)</h2>";  // Toont het aantal boven de tabel

$stmt = $conn->query("SELECT * FROM leerling");

// Bestaande code blijft hetzelfde
echo "<table border='1'>";
echo "<tr><th>Naam</th><th>Klas</th><th>Detail</th><th>Wijzig</th><th>Verwijder</th></tr>";

foreach ($stmt as $row) {
    echo "<tr>
        <td>{$row['naam']}</td>
        <td>{$row['klas']}</td>
        <td><a href='detail.php?id={$row['id']}'>Detail</a></td>
        <td><a href='edit.php?id={$row['id']}'>Wijzig</a></td>
        <td><a href='delete.php?id={$row['id']}'>Verwijder</a></td>
    </tr>";
}

echo "</table><br><a href='index.php'>← Terug</a>";
?>