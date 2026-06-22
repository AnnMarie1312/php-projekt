<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWithUs - Kontakt</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="slike/favicon-32x32.png">

</head>
<body>
    <header>
        <nav class="main-nav">

            <img src="slike/TravelWithUs.png" class="logo" alt="Logo">

            <ul class="nav-menu">
                <li><a href="index.php">Naslovna</a></li>
                <li><a href="destinacije.php">Destinacije</a></li>
                <li><a href="o-nama.php">O nama</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
            </ul>

        </nav>
    </header>

    <main class="page">
  <section class="contact-card">
    <h1 class="contact-title">Kontaktirajte nas</h1>
    <p class="contact-subtitle">Pošaljite upit i javimo vam se u najkraćem roku.</p>

    <form id="kontaktForm" class="contact-form">
      <div class="form-grid">
        <div class="field">
          <label for="ime">Ime</label>
          <input type="text" id="ime" name="ime" placeholder="Vaše ime" required>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="ime@email.com" required>
        </div>

        <div class="field">
          <label for="destinacija">Destinacija</label>
          <input type="text" id="destinacija" name="destinacija" placeholder="Npr. Rim" required>
        </div>

        <div class="field">
          <label for="datum">Datum putovanja</label>
          <input type="date" id="datum" name="datum" required>
        </div>

        <div class="field field-full">
          <label for="poruka">Poruka</label>
          <textarea id="poruka" name="poruka" placeholder="Napišite poruku..." required></textarea>
        </div>
      </div>

      <button class="btn" type="submit">Pošalji</button>
    </form>
  </section>
</main>

    <footer>
        <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>

