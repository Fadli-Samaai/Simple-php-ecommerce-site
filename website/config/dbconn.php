<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = new mysqli(
    $_ENV['Host_Name'],     
    $_ENV['User_Name'], 
    $_ENV['Password'],
    $_ENV['Database_Name']   
);

if($conn->connect_errno) {
    echo "<strong>Failed to connect to MySQL:</strong> (" . $conn->connect_errno . ") " .
            $conn->connect_error;
}