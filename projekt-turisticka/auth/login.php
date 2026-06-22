<?php

include "../config/db.php";
session_start();

$greska = "";

if(isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM korisnici WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['ime'] = $user['ime'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../dashboard.php");
        exit;

    } else {

        $greska = "Krivi email ili lozinka ❌";

    }
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>

<meta charset="UTF-8">

<title>Prijava</title>

<link rel="stylesheet" href="../css/style-php.css">

<link rel="icon" type="image/png" href="../slike/favicon-32x32.png">

</head>

<body>

<header class="php-header">

<nav class="php-nav">

<a href="../index.php">

<img src="../slike/TravelWithUs.png" class="php-logo" alt="Logo">

</a>

<ul class="php-menu">

<li><a href="../index.php">Početna</a></li>

<li><a href="../destinacije.php">Destinacije</a></li>

<li><a href="../html/o-nama.html">O nama</a></li>

<li><a href="../html/kontakt.html">Kontakt</a></li>

</ul>

</nav>

</header>

<main class="auth-page">

<div class="auth-card">

<h1>Prijava</h1>

<?php if($greska != ""): ?>

<p class="error"><?= $greska ?></p>

<?php endif; ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Lozinka" required>

<button type="submit" name="login" class="php-btn">

Prijavi se

</button>

</form>

<p>

Nemaš račun?

<a href="register.php">

Registriraj se

</a>

</p>

</div>

</main>

</body>

</html>