<?php
require 'db.php';

$id = $_GET['id'];

$leerling = $conn->prepare("SELECT * FROM leerling WHERE id = ?");
$leerling->execute([$id]);
$data = $leerling->fetch();

echo "<h2>{$data['naam']} ({$data['klas']})</h2>";

$toetsen = $conn->prepare("SELECT * FROM toets WHERE leerling_id = ?");
$toetsen->execute([$id]);

$totaal = 0; 
$aantal = 0;

echo "<table border='1'><tr><th>Vak</th><th>Cijfer</th></tr>";

foreach ($toetsen as $toets) {
    $formatted_grade = number_format($toets['cijfer'], 1, ',', '.');
    echo "<tr><td>{$toets['vak']}</td><td>{$formatted_grade}</td></tr>";
    $totaal += $toets['cijfer'];
    $aantal++;
}
$gemiddelde = $aantal ? number_format($totaal / $aantal, 1, ',', '.') : "N.v.t.";
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

<!--
Include the database connection to perform queries
Get the student ID from the query parameter
Fetch student details from the database for the given ID
Display the student's name and class as a heading
Fetch all test scores for the student
Initialize variables to calculate the average score
Start the HTML table to display test scores
Loop through each test score and display it
Add the score to the total and increment the count
Calculate the average score, or show "N.v.t." if no scores exist
Close the table and display the average score
Hidden field to associate the new test score with the student
Form to add a new test score
Link to go back to the overview page
-->
