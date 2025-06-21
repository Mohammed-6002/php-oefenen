<?php
require 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM leerling WHERE id = ?");
$stmt->execute([$id]);

header("Location: overzicht.php");
exit;
