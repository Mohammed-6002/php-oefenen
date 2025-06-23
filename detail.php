<?php
// Include the database connection to perform queries
require 'db.php';

// Get the student ID from the query parameter
$id = $_GET['id'];

// Fetch student details from the database for the given ID
$leerling = $conn->prepare("SELECT * FROM leerling WHERE id = ?");
$leerling->execute([$id]);
$data = $leerling->fetch();

// Display the student's name and class as a heading
echo "<h2>{$data['naam']} ({$data['klas']})</h2>";

// Fetch all test scores for the student
$toetsen = $conn->prepare("SELECT * FROM toets WHERE leerling_id = ?");
$toetsen->execute([$id]);

// Initialize variables to calculate the average score
$totaal = 0; 
$aantal = 0;

// Start the HTML table to display test scores
echo "<table border='1'><tr><th>Vak</th><th>Cijfer</th></tr>";

// Loop through each test score and display it with an edit link
foreach ($toetsen as $toets) {
    $rounded_grade = round($toets['cijfer'], 1);
    echo "<tr><td>{$toets['vak']}</td><td>{$rounded_grade}</td></tr>";
    // Add the score to the total and increment the count
    $totaal += $toets['cijfer'];
    $aantal++;
}
// Calculate the average score, or show "N.v.t." if no scores exist
$gemiddelde = $aantal ? round($totaal / $aantal, 1) : "N.v.t.";
// Close the table and display the average score
echo "</table><p><strong>Gemiddeld cijfer:</strong> $gemiddelde</p>";
?>

<h3>Toets toevoegen</h3>
<form method="post" action="insert.php">
    <!-- Hidden field to associate the new test score with the student -->
    <input type="hidden" name="leerling_id" value="<?= $id ?>">
    Vak: <input type="text" name="vak" required><br>
    Cijfer: <input type="number" step="0.1" name="cijfer" required><br>
    <input type="submit" value="Opslaan">
</form>
<br><a href="overzicht.php">← Terug</a>
