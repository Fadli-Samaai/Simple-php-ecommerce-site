<?php
try {
    $hostname = getenv('DB_HOST'); 
    $database = getenv('MYSQL_DATABASE'); 
    $username = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');

    $conn = new mysqli($hostname, $username, $password, $database);

    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    die("<h3>Database connection failed. Please contact support.</h3>");
}