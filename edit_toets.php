<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Geen toets ID opgegeven.");
}

$stmt = $conn->prepare("SELECT * FROM toets WHERE id = ?");
$stmt->execute([$id]);
$toets = $stmt->fetch();

if (!$toets) {
    die("Toets niet gevonden.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cijfer = $_POST['cijfer'] ?? null;
    if ($cijfer === null || $cijfer === '') {
        echo "Cijfer is verplicht.";
    } else {
        $update = $conn->prepare("UPDATE toets SET cijfer = ? WHERE id = ?");
        $update->execute([$cijfer, $id]);
        header("Location: detail.php?id=" . $toets['leerling_id']);
        exit;
    }
}
?>

<h2>Toets cijfer wijzigen</h2>
<form method="post">
    Vak: <?= htmlspecialchars($toets['vak']) ?><br>
    Cijfer: <input type="number" step="0.1" name="cijfer" value="<?= htmlspecialchars(number_format((float)$toets['cijfer'], 1)) ?>" required><br>
    <input type="submit" value="Opslaan">
</form>
<a href="detail.php?id=<?= $toets['leerling_id'] ?>">← Terug</a>

<!--
Include the database connection to perform queries
Get the test ID from the query parameter, or null if not provided
If no test ID is provided, stop execution with an error message
Fetch the test data from the database for the given ID
If the test is not found, stop execution with an error message
Check if the form was submitted via POST
Get the new grade from the POST data
Validate that the grade is provided
Update the test grade in the database
Redirect back to the student's detail page after update
-->
