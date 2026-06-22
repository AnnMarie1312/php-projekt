<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rim - TravelWithUs</title>
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

  <!-- HERO: RIM-->
  <div class="hero-rim">
    <h1>Rim</h1>
  </div>

  <!-- UVOD / OPIS-->
  <section class="destinacija-blok">
    <h2>O Rimu</h2>
    <p class="destinacija-tekst">
      Rim je vječni grad u kojem se povijest vidi na svakom koraku – od antičkih ruševina do renesansnih trgova.
      Idealan je za ljubitelje kulture, hrane i šetnji uz gelato u ruci.
    </p>

    <div class="destinacija-info">
      <div class="info-kartica">
        <h3>Najbolje vrijeme</h3>
        <p>Proljeće i rana jesen (ugodnije i manje gužve).</p>
        <p id="vrijeme">Učitavanje...</p>
      </div>
      <div class="info-kartica">
        <h3>Vibe</h3>
        <p>Povijest, umjetnost, pasta, piazze.</p>
      </div>
      <div class="info-kartica">
        <h3>Preporuka</h3>
        <p>Trevi navečer + Trastevere za večeru.</p>
      </div>
    </div>

    <!-- GUMB REZERVIRAJ -->
    <button class="btn" id="rezervirajBtn">Rezerviraj</button>
  </section>

  <!-- MINI PROGRAM -->
  <section class="destinacija-blok">
    <h2>Mini program (3 dana)</h2>

    <div class="program">
      <div class="program-dan">
        <h3>Dan 1</h3>
        <p>Koloseum, Forum Romanum, šetnja do Kapitola.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 2</h3>
        <p>Vatikan, Bazilika sv. Petra, šetnja uz Tiber.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 3</h3>
        <p>Fontana di Trevi, Španjolske stube, Trastevere.</p>
      </div>
    </div>
  </section>

  <!-- ZNAMENITOSTI -->
  <section class="destinacija-blok">
    <h2>Znamenitosti</h2>
    <ul class="lista-znamenitosti">
      <li>Koloseum</li>
      <li>Forum Romanum</li>
      <li>Vatikan</li>
      <li>Fontana di Trevi</li>
      <li>Piazza Navona</li>
    </ul>
  </section>

</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

<!-- SCRIPT: REZERVACIJA-->
<script>
  document.getElementById("rezervirajBtn").addEventListener("click", function () {
    const proizvod = {
      naziv: "Rim",
      polazak: "19.5.2026.",
      povratak: "24.5.2026.",
      cijena: 950,
      kolicina: 1
    };

    localStorage.setItem("kosarica", JSON.stringify(proizvod));
    window.location.href = "kosarica.php";
  });
</script>
<script>
    fetch("https://api.open-meteo.com/v1/forecast?latitude=41.90&longitude=12.49&current_weather=true")
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

