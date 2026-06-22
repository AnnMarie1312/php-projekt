<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$brojDestinacija = $conn->query("SELECT COUNT(*) AS ukupno FROM destinacije")->fetch_assoc()['ukupno'];

if($role == 'admin'){
    $brojKorisnika = $conn->query("SELECT COUNT(*) AS ukupno FROM korisnici")->fetch_assoc()['ukupno'];
    $brojRezervacija = $conn->query("SELECT COUNT(*) AS ukupno FROM rezervacije")->fetch_assoc()['ukupno'];
} else {
    $stmt = $conn->prepare("SELECT COUNT(*) AS ukupno FROM rezervacije WHERE korisnik_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $brojMojihRezervacija = $stmt->get_result()->fetch_assoc()['ukupno'];
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TravelWithUs</title>
    <link rel="stylesheet" href="css/style-php.css">
    <link rel="icon" type="image/png" href="slike/favicon-32x32.png">
</head>

<body>

<header class="php-header">
    <nav class="php-nav">
        <a href="index.php">
            <img src="slike/TravelWithUs.png" class="php-logo" alt="Logo">
        </a>

        <ul class="php-menu">
            <li><a href="index.php">Početna</a></li>
            <li><a href="destinacije.php">Destinacije</a></li>
            <li><a href="moje-rezervacije.php">Moje rezervacije</a></li>

            <?php if($role == 'admin'): ?>
                <li><a href="admin-destinacije.php">Admin</a></li>
            <?php endif; ?>

            <li><a href="auth/logout.php">Odjava</a></li>
        </ul>
    </nav>
</header>

<main class="dashboard-page">

    <section class="dashboard-hero">
        <h1>Pozdrav, <?= $_SESSION['ime'] ?> 👋</h1>

        <?php if($role == 'admin'): ?>
            <p>Dobrodošli u administratorsku nadzornu ploču.</p>
        <?php else: ?>
            <p>Dobrodošli u korisničku nadzornu ploču.</p>
        <?php endif; ?>
    </section>

    <section class="dashboard-cards">

        <div class="dashboard-card">
            <h3>Destinacije</h3>
            <p><?= $brojDestinacija ?></p>
        </div>

        <?php if($role == 'admin'): ?>

            <div class="dashboard-card">
                <h3>Korisnici</h3>
                <p><?= $brojKorisnika ?></p>
            </div>

            <div class="dashboard-card">
                <h3>Sve rezervacije</h3>
                <p><?= $brojRezervacija ?></p>
            </div>

        <?php else: ?>

            <div class="dashboard-card">
                <h3>Moje rezervacije</h3>
                <p><?= $brojMojihRezervacija ?></p>
            </div>

        <?php endif; ?>

    </section>

    <section class="dashboard-actions">

        <a class="php-btn" href="destinacije.php">Pregled destinacija</a>
        <a class="php-btn" href="moje-rezervacije.php">Moje rezervacije</a>

        <?php if($role == 'admin'): ?>
            <a class="php-btn admin-btn" href="dodaj-destinaciju.php">Dodaj destinaciju</a>
            <a class="php-btn admin-btn" href="admin-destinacije.php">Uredi / obriši destinacije</a>
        <?php endif; ?>

    </section>

</main>

<footer class="php-footer">
    <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

</body>
</html>