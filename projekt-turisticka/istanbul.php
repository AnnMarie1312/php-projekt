<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Istanbul - TravelWithUs</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" type="image/png" href="slike/favicon-32x32.png">

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
  </nav>
</header>

<main>

  <!-- 
       HERO: ISTANBUL
 -->
  <div class="hero-istanbul">
    <h1>Istanbul</h1>
  </div>

  <!-- UVOD / OPIS -->
  <section class="destinacija-blok">
    <h2>O Istanbulu</h2>
    <p class="destinacija-tekst">
      Istanbul spaja Europu i Aziju – grad mirisa začina, zvukova ezana i ulica punih života.
      Ovdje se povijest Bizanta i Osmanskog carstva miješa s modernim ritmom velikog grada.
    </p>

    <div class="destinacija-info">
      <div class="info-kartica">
        <h3>Najbolje vrijeme</h3>
        <p>Proljeće i jesen (ugodnije temperature).</p>
        <p id="vrijeme">Učitavanje...</p>
      </div>
      <div class="info-kartica">
        <h3>Vibe</h3>
        <p>Orijentalno, živo, povijesno, ukusno.</p>
      </div>
      <div class="info-kartica">
        <h3>Preporuka</h3>
        <p>Zalazak sunca uz Bospor + çay.</p>
      </div>
    </div>

    <!-- GUMB REZERVIRAJ -->
    <button class="btn" id="rezervirajBtn">Rezerviraj</button>
  </section>

  <!-- MINI PROGRAM-->
  <section class="destinacija-blok">
    <h2>Mini program (3 dana)</h2>

    <div class="program">
      <div class="program-dan">
        <h3>Dan 1</h3>
        <p>Plava džamija, Aja Sofija, šetnja Sultanahmetom.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 2</h3>
        <p>Topkapi palača, Grand Bazaar, večera u starom dijelu grada.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 3</h3>
        <p>Krstarenje Bosporom, Galata toranj, Istiklal ulica.</p>
      </div>
    </div>
  </section>

  <!-- ZNAMENITOSTI-->
  <section class="destinacija-blok">
    <h2>Znamenitosti</h2>
    <ul class="lista-znamenitosti">
      <li>Plava džamija</li>
      <li>Aja Sofija</li>
      <li>Topkapi palača</li>
      <li>Grand Bazaar</li>
      <li>Galata toranj</li>
    </ul>
  </section>

</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

<!--SCRIPT: REZERVACIJA-->
<script>
  document.getElementById("rezervirajBtn").addEventListener("click", function () {
    const proizvod = {
      naziv: "Istanbul",
      polazak: "19.5.2026.",
      povratak: "24.5.2026.",
      cijena: 1800,
      kolicina: 1
    };

    localStorage.setItem("kosarica", JSON.stringify(proizvod));
    window.location.href = "kosarica.php";
  });
</script>

 <script>
    fetch("https://api.open-meteo.com/v1/forecast?latitude=41.01&longitude=28.97&current_weather=true")
      .then(response => response.json())
      .then(data => {
        const temp = data.current_weather.temperature;
        const code = data.current_weather.weathercode;
    
        let ikona = "";
    
        // Mapiranje weather code → ikona
        if (code === 0) {
          ikona = "☀️"; // sunčano
        } else if (code >= 1 && code <= 3) {
          ikona = "⛅"; // djelomično oblačno
        } else if (code >= 45 && code <= 48) {
          ikona = "🌫️"; // magla
        } else if (code >= 51 && code <= 67) {
          ikona = "🌧️"; // kiša
        } else if (code >= 71 && code <= 77) {
          ikona = "❄️"; // snijeg
        } else if (code >= 80 && code <= 99) {
          ikona = "⛈️"; // pljuskovi/oluja
        } else {
          ikona = "🌡️";
        }
    
        document.getElementById("vrijeme").innerText =
          ikona + " " + temp + "°C";
      })
      .catch(error => {
        document.getElementById("vrijeme").innerText = "Greška pri dohvaćanju vremena.";
      });
</script>
</body>

</html>
