<?php
require 'db.php';

$vak = $_POST['vak'] ?? null;
$cijfer = $_POST['cijfer'] ?? null;

if (isset($_POST['leerling_id']) && !empty($_POST['leerling_id'])) {
    $leerling_id = $_POST['leerling_id'];
} else {
    $naam = $_POST['naam'] ?? null;
    $klas = $_POST['klas'] ?? null;

    if (!$naam || !$klas) {
        die("Naam en klas zijn verplicht voor een nieuwe leerling.");
    }

    $stmt = $conn->prepare("SELECT id FROM leerling WHERE naam = ? AND klas = ?");
    $stmt->execute([$naam, $klas]);
    $leerling_id = $stmt->fetchColumn();

    if (!$leerling_id) {
        $insert = $conn->prepare("INSERT INTO leerling (naam, klas) VALUES (?, ?)");
        $insert->execute([$naam, $klas]);
        $leerling_id = $conn->lastInsertId();
        
        header("Location: overzicht.php");
        exit;
    } else {
        echo "<p>Leerling '$naam' uit klas '$klas' bestaat al.</p>";
    }
}

if (!$vak || !$cijfer) {
    die("Vak en cijfer zijn verplicht.");
}

$insert_toets = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$insert_toets->execute([$leerling_id, $vak, $cijfer]);

header("Location: overzicht.php");
exit;
?>

/*
Include the database connection to perform queries
Retrieve the subject and grade from POST data, or set to null if not provided
Check if leerling_id is provided (existing student)
Use the provided leerling_id for the test score
If no leerling_id, get the name and class for a new student
Validate that name and class are provided
Check if the student already exists in the database
If student does not exist, insert new student record
Redirect to overzicht.php after adding new student
Inform user that the student already exists
Validate that subject and grade are provided
Insert the test score for the student into the toets table
Redirect to overzicht.php after adding the test score
*/
