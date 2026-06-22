<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pariz - TravelWithUs</title>
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

  <!--HERO: PARIZ-->
       
  
  <div class="hero-pariz">
    <h1>Pariz</h1>
  </div>

  <!--  UVOD / OPIS -->
  <section class="destinacija-blok">
    <h2>O Parizu</h2>
    <p class="destinacija-tekst">
      Pariz je grad ljubavi, umjetnosti i elegantnih šetnji uz Seinu. U njemu se miješaju povijest i moda,
      muzeji i kafići, miris kroasana i večernja svjetla koja grad čine posebnim.
    </p>

    <div class="destinacija-info">
      <div class="info-kartica">
        <h3>Najbolje vrijeme</h3>
        <p>Proljeće i jesen (ugodnije i manje gužve).</p>
        <p id="vrijeme">Učitavanje...</p>
      </div>
      <div class="info-kartica">
        <h3>Vibe</h3>
        <p>Romantika, kultura, šetnje, muzeji.</p>
      </div>
      <div class="info-kartica">
        <h3>Preporuka</h3>
        <p>Uvečer Montmartre + pogled na grad.</p>
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
        <p>Eiffelov toranj, šetnja Champ de Mars, večernja plovidba Seinomm.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 2</h3>
        <p>Luvr, Tuileries vrtovi, shopping u galerijama.</p>
      </div>
      <div class="program-dan">
        <h3>Dan 3</h3>
        <p>Montmartre, Sacré-Cœur, kava u malim pariškim ulicama.</p>
      </div>
    </div>
  </section>

  <!-- ZNAMENITOSTI-->
  <section class="destinacija-blok">
    <h2>Znamenitosti</h2>
    <ul class="lista-znamenitosti">
      <li>Eiffelov toranj</li>
      <li>Luvr</li>
      <li>Notre-Dame (izvana) + Île de la Cité</li>
      <li>Montmartre i Sacré-Cœur</li>
      <li>Champs-Élysées i Arc de Triomphe</li>
    </ul>
  </section>

</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

<!-- SCRIPT: REZERVACIJA -->
<script>
  document.getElementById("rezervirajBtn").addEventListener("click", function () {
    const proizvod = {
      naziv: "Pariz",
      polazak: "19.5.2026.",
      povratak: "24.5.2026.",
      cijena: 1200 ,
      kolicina: 1
    };

    localStorage.setItem("kosarica", JSON.stringify(proizvod));
    window.location.href = "kosarica.php";
  });
</script>

 <script>
    fetch("https://api.open-meteo.com/v1/forecast?latitude=48.85&longitude=2.35&current_weather=true")
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


