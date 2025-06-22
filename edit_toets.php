<?php
// Include the database connection to perform queries
require 'db.php';

// Get the test ID from the query parameter, or null if not provided
$id = $_GET['id'] ?? null;
// If no test ID is provided, stop execution with an error message
if (!$id) {
    die("Geen toets ID opgegeven.");
}

// Fetch the test data from the database for the given ID
$stmt = $conn->prepare("SELECT * FROM toets WHERE id = ?");
$stmt->execute([$id]);
$toets = $stmt->fetch();

// If the test is not found, stop execution with an error message
if (!$toets) {
    die("Toets niet gevonden.");
}

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new grade from the POST data
    $cijfer = $_POST['cijfer'] ?? null;
    // Validate that the grade is provided
    if ($cijfer === null || $cijfer === '') {
        echo "Cijfer is verplicht.";
    } else {
        // Update the test grade in the database
        $update = $conn->prepare("UPDATE toets SET cijfer = ? WHERE id = ?");
        $update->execute([$cijfer, $id]);
        // Redirect back to the student's detail page after update
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
