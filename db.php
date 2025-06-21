<?php
// Establish a connection to the MySQL database using PDO
try {
    $conn = new PDO("mysql:host=localhost;dbname=leerlingen_beoordeling", "root", "");
    // Set error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, output error message and stop execution
    die("Verbinding mislukt: " . $e->getMessage());
}
?>
