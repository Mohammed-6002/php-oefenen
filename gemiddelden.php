<?php
// Include the database connection file to enable database operations
require 'db.php';

// SQL query to select student name, class, and their average test score
// LEFT JOIN is used to include students even if they have no test scores
$sql = "SELECT l.naam, l.klas, AVG(t.cijfer) as gemiddeld 
        FROM leerling l 
        LEFT JOIN toets t ON l.id = t.leerling_id 
        GROUP BY l.id";

// Execute the query and get the result set
$stmt = $conn->query($sql);

// Output the heading and start of the HTML table to display results
echo "<h2>Gemiddelden</h2><table border='1'>";
echo "<tr><th>Naam</th><th>Klas</th><th>Gemiddelde</th></tr>";

// Loop through each row in the result set
foreach ($stmt as $row) {
    // Round the average score to 2 decimals if it exists, otherwise show "N.v.t." (not applicable)
    $gem = $row['gemiddeld'] ? round($row['gemiddeld'], 2) : "N.v.t.";
    // Output a table row with the student's name, class, and average score
    echo "<tr><td>{$row['naam']}</td><td>{$row['klas']}</td><td>{$gem}</td></tr>";
}
// Close the table and add a link back to the index page
echo "</table><br><a href='index.php'>← Terug</a>";
