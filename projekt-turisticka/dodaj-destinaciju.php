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

$poruka = "";

if (isset($_POST['dodaj'])) {
    $naziv = trim($_POST['naziv']);
    $cijena = $_POST['cijena'];
    $trajanje = $_POST['trajanje'];
    $popust = $_POST['popust'];

    if ($naziv == "" || $cijena <= 0 || $trajanje <= 0) {
        $poruka = "Molimo unesite ispravne podatke.";
    } else {
        $stmt = $conn->prepare("INSERT INTO destinacije (naziv, cijena, trajanje, popust) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdii", $naziv, $cijena, $trajanje, $popust);

        if ($stmt->execute()) {
            $poruka = "Destinacija uspješno dodana.";
        } else {
            $poruka = "Greška pri dodavanju.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj destinaciju</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Dodaj novu destinaciju</h1>

<p><?= $poruka ?></p>

<form method="POST">
    <label>Naziv destinacije</label><br>
    <input type="text" name="naziv" required><br><br>

    <label>Cijena</label><br>
    <input type="number" step="0.01" name="cijena" required><br><br>

    <label>Trajanje u danima</label><br>
    <input type="number" name="trajanje" required><br><br>

    <label>Popust (%)</label><br>
    <input type="number" name="popust" value="0"><br><br>

    <button type="submit" name="dodaj">Dodaj destinaciju</button>
</form>

<br>
<a href="dashboard.php">← Nazad na dashboard</a>

</body>
</html>