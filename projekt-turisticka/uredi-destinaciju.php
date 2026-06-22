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

$stmt = $conn->prepare("SELECT * FROM destinacije WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$destinacija = $result->fetch_assoc();

if (isset($_POST['spremi'])) {
    $naziv = trim($_POST['naziv']);
    $cijena = $_POST['cijena'];
    $trajanje = $_POST['trajanje'];
    $popust = $_POST['popust'];

    $stmt = $conn->prepare("UPDATE destinacije SET naziv = ?, cijena = ?, trajanje = ?, popust = ? WHERE id = ?");
    $stmt->bind_param("sdiii", $naziv, $cijena, $trajanje, $popust, $id);

    if ($stmt->execute()) {
        header("Location: admin-destinacije.php");
        exit;
    } else {
        echo "Greška pri uređivanju.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi destinaciju</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Uredi destinaciju</h1>

<form method="POST">
    <label>Naziv</label><br>
    <input type="text" name="naziv" value="<?= $destinacija['naziv'] ?>" required><br><br>

    <label>Cijena</label><br>
    <input type="number" step="0.01" name="cijena" value="<?= $destinacija['cijena'] ?>" required><br><br>

    <label>Trajanje</label><br>
    <input type="number" name="trajanje" value="<?= $destinacija['trajanje'] ?>" required><br><br>

    <label>Popust</label><br>
    <input type="number" name="popust" value="<?= $destinacija['popust'] ?>" required><br><br>

    <button type="submit" name="spremi">Spremi promjene</button>
</form>

<br>
<a href="admin-destinacije.php">← Nazad</a>

</body>
</html>