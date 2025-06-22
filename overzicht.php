<?php
require 'db.php';

$aantal_leerlingen = $conn->query("SELECT COUNT(*) FROM leerling")->fetchColumn();
echo "<h2>Leerlingen ($aantal_leerlingen)</h2>";

$stmt = $conn->query("SELECT * FROM leerling");

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

/*
Include the database connection to perform queries
Query to count the total number of students in the database
Display the total number of students above the table
Query to select all students
Start the HTML table to display student data
Table headers for student name, class, and action links
Loop through each student and create a table row with their data and action links
Close the table and add a link back to the index page
*/
