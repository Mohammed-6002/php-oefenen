<?php
require 'db.php';

$stmt = $conn->query("SELECT * FROM leerling");
echo "<h2>Leerlingen</h2><table border='1'>";
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
