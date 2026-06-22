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

$result = $conn->query("SELECT * FROM destinacije");
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Admin destinacije</title>
    <link rel="stylesheet" href="css/style-php.css">
</head>

<body>

<header class="admin-header">
    <h1>Uredi / obriši destinacije</h1>
</header>

<main class="admin-page">

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Cijena</th>
                    <th>Trajanje</th>
                    <th>Popust</th>
                    <th>Akcije</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['naziv'] ?></td>
                        <td>€<?= $row['cijena'] ?></td>
                        <td><?= $row['trajanje'] ?> dana</td>
                        <td><?= $row['popust'] ?>%</td>
                        <td>
                            <a class="admin-btn-edit" href="uredi-destinaciju.php?id=<?= $row['id'] ?>">Uredi</a>
                            <a class="admin-btn-delete" href="obrisi-destinaciju.php?id=<?= $row['id'] ?>" onclick="return confirm('Jesi sigurna da želiš obrisati?')">Obriši</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="admin-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="destinacije.php">Destinacije</a>
        <a href="dodaj-destinaciju.php">Dodaj destinaciju</a>
    </div>

</main>

</body>
</html>