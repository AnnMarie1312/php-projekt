<?php
session_start();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>TravelWithUs</title>

  <link rel="icon" type="image/png" href="slike/favicon-32x32">
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

<header>
  <nav class="main-nav">

    <a href="index.php">
      <img src="slike/TravelWithUs.png" class="logo" alt="Logo">
    </a>

    <ul class="nav-menu">
      <li><a href="index.php">Početna</a></li>
      <li><a href="destinacije.php">Destinacije</a></li>
      <li><a href="o-nama.php">O nama</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
      <li><a href="#popularno">Popularno</a></li>
    </ul>

    <ul class="auth-menu">
      <?php if(isset($_SESSION['user_id'])): ?>
        <li><a href="dashboard.php">👤 Dashboard</a></li>
        <li><a href="auth/logout.php">🚪 Odjava</a></li>
      <?php else: ?>
        <li><a href="auth/login.php">👤 Prijava</a></li>
        <li><a href="auth/register.php">📝 Registracija</a></li>
      <?php endif; ?>
    </ul>

  </nav>
</header>

<main id="container">
  <div id="target"></div>
  <h1 class="hero-title">Dobrodošli u <span>TravelWithUs</span></h1>
</main>

<section id="popularno" class="popular">
  <h2>Popularne destinacije</h2>

  <div class="dest-grid">
    <a class="dest-card" href="pariz.php">
      <span class="dest-name">Pariz</span>
    </a>

    <a class="dest-card" href="rim.php">
      <span class="dest-name">Rim</span>
    </a>

    <a class="dest-card" href="istanbul.php">
      <span class="dest-name">Istanbul</span>
    </a>
  </div>
</section>

<footer>
  &copy; 2026 TravelWithUs. Sva prava pridržana.
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>










