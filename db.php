<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=leerlingen_beoordeling", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>

/*
Establish a connection to the MySQL database using PDO
This connection is used throughout the application to interact with the database
Set error mode to exception for better error handling
This ensures that any database errors throw exceptions for easier debugging
If connection fails, output error message and stop execution
This prevents the application from continuing without a valid database connection
*/
