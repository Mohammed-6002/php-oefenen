<?php
// Include the database connection to perform queries
require 'db.php';

// Query to count the total number of students in the database
$aantal_leerlingen = $conn->query("SELECT COUNT(*) FROM leerling")->fetchColumn();
// Display the total number of students above the table
echo "<h2>Leerlingen ($aantal_leerlingen)</h2>";

// Query to select all students
$stmt = $conn->query("SELECT * FROM leerling");

// Start the HTML table to display student data
echo "<table border='1'>";
// Table headers for student name, class, and action links
echo "<tr><th>Naam</th><th>Klas</th><th>Detail</th><th>Wijzig</th><th>Verwijder</th></tr>";

// Loop through each student and create a table row with their data and action links
foreach ($stmt as $row) {
    echo "<tr>
        <td>{$row['naam']}</td>
        <td>{$row['klas']}</td>
        <td><a href='detail.php?id={$row['id']}'>Detail</a></td>
        <td><a href='edit.php?id={$row['id']}'>Wijzig</a></td>
        <td><a href='delete.php?id={$row['id']}'>Verwijder</a></td>
    </tr>";
}

// Close the table and add a link back to the index page
echo "</table><br><a href='index.php'>← Terug</a>";
?>
