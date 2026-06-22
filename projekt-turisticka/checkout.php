<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$poruka = "";

if (isset($_POST['naruci'])) {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $email = trim($_POST['email']);
    $telefon = trim($_POST['telefon']);

    $destinacija = $_POST['destinacija'];
    $polazak = $_POST['polazak'];
    $povratak = $_POST['povratak'];
    $kolicina = $_POST['kolicina'];
    $ukupna_cijena = $_POST['ukupna_cijena'];

    if ($ime == "" || $prezime == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $telefon == "") {
        $poruka = "Molimo unesite ispravne podatke.";
    } else {
        $stmt = $conn->prepare("UPDATE korisnici SET ime=?, prezime=?, email=?, telefon=? WHERE id=?");
        $stmt->bind_param("ssssi", $ime, $prezime, $email, $telefon, $_SESSION['user_id']);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT id FROM destinacije WHERE naziv = ?");
        $stmt->bind_param("s", $destinacija);
        $stmt->execute();
        $result = $stmt->get_result();
        $dest = $result->fetch_assoc();

        if ($dest) {
            $destinacija_id = $dest['id'];
            $korisnik_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("
                INSERT INTO rezervacije 
                (korisnik_id, destinacija_id, polazak, povratak, kolicina, ukupna_cijena)
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "iissid",
                $korisnik_id,
                $destinacija_id,
                $polazak,
                $povratak,
                $kolicina,
                $ukupna_cijena
            );

            if ($stmt->execute()) {
                echo "<script>
                    localStorage.removeItem('kosarica');
                    window.location.href = 'moje-rezervacije.php';
                </script>";
                exit;
            } else {
                $poruka = "Greška pri spremanju rezervacije.";
            }
        } else {
            $poruka = "Destinacija nije pronađena.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plaćanje - TravelWithUs</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="slike/favicon-32x32.png">
</head>

<body>

<header>
  <nav>
    <ul class="nav-menu">
      <li><a href="index.php">Početna</a></li>
      <li><a href="destinacije.php">Destinacije</a></li>
      <li><a href="html/o-nama.html">O nama</a></li>
      <li><a href="html/kontakt.html">Kontakt</a></li>
    </ul>
    <img src="slike/TravelWithUs.png" class="logo" alt="Logo">
  </nav>
</header>

<main class="checkout-wrap">
  <h1>Podaci za plaćanje</h1>

  <?php if ($poruka != ""): ?>
    <p><?= $poruka ?></p>
  <?php endif; ?>

  <div id="rezimeRezervacije"></div>

  <form id="forma" class="checkout-form" method="POST">
    <div class="field">
      <label>Ime *</label>
      <input type="text" name="ime" placeholder="Ime" required>
    </div>

    <div class="field">
      <label>Prezime *</label>
      <input type="text" name="prezime" placeholder="Prezime" required>
    </div>

    <div class="field">
      <label>Email *</label>
      <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="field">
      <label>Broj telefona *</label>
      <input type="tel" name="telefon" placeholder="Broj telefona" required>
    </div>

    <input type="hidden" name="destinacija" id="destinacija">
    <input type="hidden" name="polazak" id="polazak">
    <input type="hidden" name="povratak" id="povratak">
    <input type="hidden" name="kolicina" id="kolicina">
    <input type="hidden" name="ukupna_cijena" id="ukupna_cijena">

    <button class="btn" type="submit" name="naruci">Naručite</button>
  </form>
</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

<script>
const kosarica = JSON.parse(localStorage.getItem("kosarica"));

if (!kosarica) {
    document.getElementById("rezimeRezervacije").innerHTML = "<p>Košarica je prazna.</p>";
    document.getElementById("forma").style.display = "none";
} else {
    document.getElementById("rezimeRezervacije").innerHTML = `
        <div class="kosarica-summary">
            <h3>Rezime rezervacije</h3>
            <p><span>Destinacija:</span> ${kosarica.naziv}</p>
            <p><span>Polazak:</span> ${kosarica.polazak || "-"}</p>
            <p><span>Povratak:</span> ${kosarica.povratak || "-"}</p>
            <p><span>Količina:</span> ${kosarica.kolicina || 1}</p>
            <p class="cijena"><span>Ukupno:</span> €${(kosarica.cijena || 0).toFixed(2)}</p>
        </div>
    `;

    document.getElementById("destinacija").value = kosarica.naziv;
    document.getElementById("polazak").value = kosarica.polazak || "";
    document.getElementById("povratak").value = kosarica.povratak || "";
    document.getElementById("kolicina").value = kosarica.kolicina || 1;
    document.getElementById("ukupna_cijena").value = kosarica.cijena || 0;
}
</script>

</body>
</html>