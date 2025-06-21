<?php
require 'db.php';

$sql = "SELECT l.naam, l.klas, AVG(t.cijfer) as gemiddeld 
        FROM leerling l 
        LEFT JOIN toets t ON l.id = t.leerling_id 
        GROUP BY l.id";

$stmt = $conn->query($sql);

echo "<h2>Gemiddelden</h2><table border='1'>";
echo "<tr><th>Naam</th><th>Klas</th><th>Gemiddelde</th></tr>";
foreach ($stmt as $row) {
    $gem = $row['gemiddeld'] ? round($row['gemiddeld'], 2) : "N.v.t.";
    echo "<tr><td>{$row['naam']}</td><td>{$row['klas']}</td><td>{$gem}</td></tr>";
}
echo "</table><br><a href='index.php'>← Terug</a>";
