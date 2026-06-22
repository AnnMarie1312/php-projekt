<?php
$host = "localhost";
$dbname = "travelwithus";
$user = "root";
$pass = "";

// konekcija
$conn = new mysqli($host, $user, $pass, $dbname);

// provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>