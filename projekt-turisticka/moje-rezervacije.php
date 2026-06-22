<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT d.naziv, r.polazak, r.povratak, r.kolicina, r.ukupna_cijena, r.datum_rezervacije
FROM rezervacije r
JOIN destinacije d ON r.destinacija_id = d.id
WHERE r.korisnik_id = ?
ORDER BY r.datum_rezervacije DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$rezultat = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Moje rezervacije</title>
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
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="auth/logout.php">Odjava</a></li>
        </ul>
    </nav>
</header>

<main class="php-page">
    <h1>Moje rezervacije</h1>

    <div class="table-wrapper">
        <table class="php-table">
            <thead>
                <tr>
                    <th>Destinacija</th>
                    <th>Polazak</th>
                    <th>Povratak</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Datum rezervacije</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = $rezultat->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['naziv'] ?></td>
                        <td><?= $row['polazak'] ?></td>
                        <td><?= $row['povratak'] ?></td>
                        <td><?= $row['kolicina'] ?></td>
                        <td><?= $row['ukupna_cijena'] ?> €</td>
                        <td><?= $row['datum_rezervacije'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<footer class="php-footer">
    <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

</body>
</html>