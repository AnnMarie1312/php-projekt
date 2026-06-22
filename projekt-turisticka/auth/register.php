<?php

include "../config/db.php";

$poruka = "";

if(isset($_POST['register'])) {

    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $email = trim($_POST['email']);
    $telefon = trim($_POST['telefon']);
    $password = $_POST['password'];

    // Validacija

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $poruka = "Neispravna email adresa.";

    }

    elseif(strlen($password) < 6) {

        $poruka = "Lozinka mora imati najmanje 6 znakova.";

    }

    elseif(!preg_match('/^[0-9+\s]+$/', $telefon)) {

        $poruka = "Neispravan telefonski broj.";

    }

    else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            INSERT INTO korisnici
            (ime, prezime, email, telefon, password)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssss",
            $ime,
            $prezime,
            $email,
            $telefon,
            $hashedPassword
        );

        if($stmt->execute()) {

            $poruka = "Registracija uspješna 🎉";

        } else {

            $poruka = "Greška: " . $conn->error;

        }
    }
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registracija</title>

<link rel="stylesheet" href="../css/style-php.css">

<link rel="icon" type="image/png" href="../slike/favicon-32x32.png">

</head>

<body>

<header class="php-header">

<nav class="php-nav">

<a href="../index.php">

<img src="../slike/TravelWithUs.png"
     class="php-logo"
     alt="Logo">

</a>

<ul class="php-menu">

<li><a href="index.php">Početna</a></li>

<li><a href="destinacije.php">Destinacije</a></li>

<li><a href="o-nama.php">O nama</a></li>

<li><a href="kontakt.php">Kontakt</a></li>

</ul>

</nav>

</header>

<main class="auth-page">

<div class="auth-card">

<h1>Registracija</h1>

<?php
if(isset($poruka)){
    echo "<p>$poruka</p>";
}
?>

<form method="POST">

<input type="text" name="ime" placeholder="Ime" required>

<input type="text" name="prezime" placeholder="Prezime" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="telefon" placeholder="Telefon" required>

<input type="password" name="password" placeholder="Lozinka" required>

<button type="submit" name="register">

Registriraj se

</button>

</form>

</div>

</main>

</body>

</html>