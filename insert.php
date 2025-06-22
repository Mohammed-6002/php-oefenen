<?php
// Include the database connection to perform queries
require 'db.php';

// Retrieve the subject and grade from POST data, or set to null if not provided
$vak = $_POST['vak'] ?? null;
$cijfer = $_POST['cijfer'] ?? null;

// Check if leerling_id is provided (existing student)
if (isset($_POST['leerling_id']) && !empty($_POST['leerling_id'])) {
    // Use the provided leerling_id for the test score
    $leerling_id = $_POST['leerling_id'];
} else {
    // If no leerling_id, get the name and class for a new student
    $naam = $_POST['naam'] ?? null;
    $klas = $_POST['klas'] ?? null;

    // Validate that name and class are provided
    if (!$naam || !$klas) {
        die("Naam en klas zijn verplicht voor een nieuwe leerling.");
    }

    // Check if the student already exists in the database
    $stmt = $conn->prepare("SELECT id FROM leerling WHERE naam = ? AND klas = ?");
    $stmt->execute([$naam, $klas]);
    $leerling_id = $stmt->fetchColumn();

    // If student does not exist, insert new student record
    if (!$leerling_id) {
        $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
        $insert->execute([$naam, $klas]);
        $leerling_id = $conn->lastInsertId();
        
        // Redirect to overzicht.php after adding new student
        header("Location: overzicht.php");
        exit;
    } else {
        // Inform user that the student already exists
        echo "<p>Leerling '$naam' uit klas '$klas' bestaat al.</p>";
    }
}

// Validate that subject and grade are provided
if (!$vak || !$cijfer) {
    die("Vak en cijfer zijn verplicht.");
}

// Insert the test score for the student into the toets table
$insert_toets = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$insert_toets->execute([$leerling_id, $vak, $cijfer]);

// Redirect to overzicht.php after adding the test score
header("Location: overzicht.php");
exit;
?>
