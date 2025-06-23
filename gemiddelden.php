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
    $gem = $row['gemiddeld'] ? number_format($row['gemiddeld'], 1, ',', '.') : "N.v.t.";
    echo "<tr><td>{$row['naam']}</td><td>{$row['klas']}</td><td>{$gem}</td></tr>";
}
echo "</table><br><a href='index.php'>← Terug</a>";

/*
Include the database connection file to enable database operations
SQL query to select student name, class, and their average test score
LEFT JOIN is used to include students even if they have no test scores
Execute the query and get the result set
Output the heading and start of the HTML table to display results
Loop through each row in the result set
Round the average score to 2 decimals if it exists, otherwise show "N.v.t." (not applicable)
Output a table row with the student's name, class, and average score
Close the table and add a link back to the index page
*/
