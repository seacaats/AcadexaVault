<?php

$host = "localhost";
$user = "root";
$password = "acadexaniphea";
$database = "acadexa_vault";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $database, $user, $password);
} catch (PDOException $error) {
    die("Connection failed!" . $error->getMessage());
    exit();
}

?>