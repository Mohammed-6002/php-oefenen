<?php
require 'db.php';

$leerling_id = $_POST['leerling_id'];
$vak = $_POST['vak'];
$cijfer = $_POST['cijfer'];

$stmt = $conn->prepare("INSERT INTO toets (leerling_id, vak, cijfer) VALUES (?, ?, ?)");
$stmt->execute([$leerling_id, $vak, $cijfer]);

header("Location: detail.php?id=$leerling_id");
exit;
