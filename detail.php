<?php
// Include database connection
require 'db.php';

// Get the student ID from the query parameter
$id = $_GET['id'];

// Fetch student details from the database
$leerling = $conn->prepare("SELECT * FROM leerling WHERE id = ?");
$leerling->execute([$id]);
$data = $leerling->fetch();

// Display student name and class
echo "<h2>{$data['naam']} ({$data['klas']})</h2>";

// Fetch all test scores for the student
$toetsen = $conn->prepare("SELECT * FROM toets WHERE leerling_id = ?");
$toetsen->execute([$id]);

// Initialize total and count for average calculation
$totaal = 0; $aantal = 0;

// Display test scores in a table
echo "<table border='1'><tr><th>Vak</th><th>Cijfer</th></tr>";
foreach ($toetsen as $toets) {
    $rounded_grade = round($toets['cijfer'], 1);
    echo "<tr><td>{$toets['vak']}</td><td>{$rounded_grade}</td></tr>";
    $totaal += $toets['cijfer'];
    $aantal++;
}
// Calculate and display average score
$gemiddelde = $aantal ? round($totaal / $aantal, 1) : "N.v.t.";
echo "</table><p><strong>Gemiddeld cijfer:</strong> $gemiddelde</p>";
?>

<h3>Toets toevoegen</h3>
<form method="post" action="insert.php">
    <input type="hidden" name="leerling_id" value="<?= $id ?>">
    Vak: <input type="text" name="vak" required><br>
    Cijfer: <input type="number" step="0.1" name="cijfer" required><br>
    <input type="submit" value="Opslaan">
</form>
<br><a href="overzicht.php">← Terug</a>
