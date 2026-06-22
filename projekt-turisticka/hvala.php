<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hvala - TravelWithUs</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="slike/favicon-32x32.png">
</head>
<body>

<header>
  <nav>
    <ul class="nav-menu">
      <li><a href="index.php">Početna</a></li>
      <li><a href="destinacije.php">Destinacije</a></li>
      <li><a href="o-nama.php">O nama</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
    <img src="slike/TravelWithUs.png" class="logo" alt="Logo">
  </nav>
</header>

<main class="hvala-stranica">
  <section class="hvala-kartica">
    <h1 id="poruka">Hvala na rezervaciji! ✅</h1>
    <p>Vaša narudžba je uspješno zaprimljena.</p>

    <a class="btn" href="index.php">Povratak na početnu</a>
    <a class="hvala-link" href="destinacije.php">Pogledaj još destinacija →</a>
  </section>
</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

</body>
  <script>
    const ime = localStorage.getItem("imeKorisnika");

      if (ime) {
        document.getElementById("poruka").innerText =
          "Hvala " + ime + " na rezervaciji! ✅";
}
</script>

</html>


