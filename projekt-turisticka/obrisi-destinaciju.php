<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    die("Nemate pristup ovoj stranici.");
}

?>

<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "Nemaš pristup ovoj stranici.";
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM destinacije WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin-destinacije.php");
    exit;
} else {
    echo "Greška: destinacija se ne može obrisati ako ima rezervacije.";
}
?>