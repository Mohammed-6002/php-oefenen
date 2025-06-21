<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=leerlingen_beoordeling", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>
