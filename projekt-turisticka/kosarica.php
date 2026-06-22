<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Košarica - TravelWithUs</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="slike/favicon-32x32.png">
</head>

<body>

<header>
  <nav>
    <ul class="nav-menu">
      <li><a href="index.php">Početna</a></li>
      <li><a href="destinacije.php">Destinacije</a></li>
      <li><a href="html/o-nama.php">O nama</a></li>
      <li><a href="html/kontakt.php">Kontakt</a></li>
    </ul>
    <img src="slike/TravelWithUs.png" class="logo" alt="Logo">
  </nav>
</header>

<main class="kosarica-stranica">

  <section class="kosarica-naslov">
    <h1> 🛒 Košarica</h1>

    <button onclick="obrisiKosaricu()" class="btn">Obriši košaricu</button>
    <p class="kosarica-opis">Provjerite detalje rezervacije prije plaćanja.</p>
  </section>

  <section class="kosarica-raspored">

    <div class="kosarica-kartica">
      <h2 class="kosarica-podnaslov">Vaša rezervacija</h2>

      <div id="kosaricaBox" class="kosarica-stavka"></div>

      <div class="kosarica-akcije">
        <a class="kosarica-link" href="destinacije.php">← Nastavi pregled destinacija</a>
      </div>
    </div>

    <aside class="kosarica-sazetak">
      <h2 class="kosarica-podnaslov">Ukupno</h2>

      <div id="kosarica-prikaz"></div>

      <div class="sazetak-red">
        <span>Ukupno</span>
        <strong id="ukupnoIznos">0 €</strong>
      </div>

      <button class="btn" id="checkoutBtn">Kreni na plaćanje</button>

      <p class="kosarica-napomena">
        * Ovo je demo košarica za faks (nema stvarne naplate).
      </p>
    </aside>

  </section>
</main>

<footer>
  <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

<script>
const proizvod = JSON.parse(localStorage.getItem("kosarica"));
const box = document.getElementById("kosaricaBox");
const btn = document.getElementById("checkoutBtn");
const ukupno = document.getElementById("ukupnoIznos");

const cijeneDestinacija = {
  "Pariz": { cijena: 1200, dani: 5 },
  "Rim": { cijena: 950, dani: 4 },
  "Istanbul": { cijena: 1800, dani: 7 }
};

if (proizvod && cijeneDestinacija[proizvod.naziv]) {

  const destinacija = proizvod.naziv;
  const osnovnaCijena = cijeneDestinacija[destinacija].cijena;
  const osnovniDani = cijeneDestinacija[destinacija].dani;
  const cijenaPoDanu = osnovnaCijena / osnovniDani;

  box.innerHTML = `
    <div class="stavka-naziv"><b>${proizvod.naziv}</b></div>

    <div class="stavka-datum">
      Polazak: <input type="date" id="polazakInput"><br>
      Povratak: <input type="date" id="povratakInput"><br><br>

      <button id="potvrdiDatume" type="button">Potvrdi</button>
    </div>

    <div class="stavka-kolicina">
      Količina: <input type="number" id="kolicina" value="${proizvod.kolicina || 1}" min="1">
      <button type="button" onclick="azurirajKolicinu()">Ažuriraj količinu</button>
    </div>

    <div class="stavka-rezultat">
      <p>Odabrani datumi:</p>
      <p id="datumIspis">${proizvod.polazak && proizvod.povratak ? proizvod.polazak + " – " + proizvod.povratak : "Nisu odabrani"}</p>
    </div>
  `;

  ukupno.textContent = `${Number(proizvod.cijena || osnovnaCijena).toFixed(2)} €`;

  const polazakInput = document.getElementById("polazakInput");
  const povratakInput = document.getElementById("povratakInput");

  const danas = new Date().toISOString().split("T")[0];

  polazakInput.min = danas;
  povratakInput.min = danas;

  if (proizvod.polazak) {
    polazakInput.value = proizvod.polazak;
  }

  if (proizvod.povratak) {
    povratakInput.value = proizvod.povratak;
  }

  polazakInput.addEventListener("change", () => {
    povratakInput.min = polazakInput.value;
  });

  const potvrdiBtn = document.getElementById("potvrdiDatume");
  const datumIspis = document.getElementById("datumIspis");

  potvrdiBtn.addEventListener("click", function() {
    const polazak = new Date(polazakInput.value);
    const povratak = new Date(povratakInput.value);

    const danasDatum = new Date();
    danasDatum.setHours(0, 0, 0, 0);

    if (!polazakInput.value || !povratakInput.value) {
      alert("Molimo odaberite datume!");
      return;
    }

    if (polazak < danasDatum || povratak < danasDatum) {
      alert("Ne možeš odabrati datum u prošlosti!");
      return;
    }

    if (povratak <= polazak) {
      alert("Povratak mora biti nakon polaska!");
      return;
    }

    const razlika = povratak - polazak;
    const brojDana = razlika / (1000 * 60 * 60 * 24);
    const kolicina = parseInt(document.getElementById("kolicina").value) || 1;

    const novaCijena = brojDana * cijenaPoDanu * kolicina;

    proizvod.polazak = polazakInput.value;
    proizvod.povratak = povratakInput.value;
    proizvod.kolicina = kolicina;
    proizvod.cijena = novaCijena;

    localStorage.setItem("kosarica", JSON.stringify(proizvod));

    ukupno.textContent = novaCijena.toFixed(2) + " €";
    datumIspis.textContent = polazakInput.value + " – " + povratakInput.value;

    prikaziKosaricu();
  });

  btn.addEventListener("click", () => {
    const trenutnaKosarica = JSON.parse(localStorage.getItem("kosarica"));

    if (!trenutnaKosarica.polazak || !trenutnaKosarica.povratak) {
      alert("Prvo odaberite i potvrdite datume.");
      return;
    }

    window.location.href = "checkout.php";
  });

} else {
  box.innerHTML = `<p class="prazno">Košarica je prazna.</p>`;
  ukupno.textContent = `0 €`;
  btn.disabled = true;
}

function azurirajKolicinu() {
  const proizvod = JSON.parse(localStorage.getItem("kosarica"));
  const kolicina = parseInt(document.getElementById("kolicina").value);

  if (!proizvod) {
    alert("Košarica je prazna.");
    return;
  }

  if (isNaN(kolicina) || kolicina < 1) {
    alert("Količina mora biti najmanje 1!");
    return;
  }

  proizvod.kolicina = kolicina;

  if (proizvod.polazak && proizvod.povratak) {
    const destinacija = proizvod.naziv;
    const osnovnaCijena = cijeneDestinacija[destinacija].cijena;
    const osnovniDani = cijeneDestinacija[destinacija].dani;
    const cijenaPoDanu = osnovnaCijena / osnovniDani;

    const polazak = new Date(proizvod.polazak);
    const povratak = new Date(proizvod.povratak);
    const brojDana = (povratak - polazak) / (1000 * 60 * 60 * 24);

    proizvod.cijena = brojDana * cijenaPoDanu * kolicina;
  } else {
    const osnovnaCijena = cijeneDestinacija[proizvod.naziv].cijena;
    proizvod.cijena = osnovnaCijena * kolicina;
  }

  localStorage.setItem("kosarica", JSON.stringify(proizvod));

  document.getElementById("ukupnoIznos").textContent =
    Number(proizvod.cijena).toFixed(2) + " €";

  prikaziKosaricu();
}

function prikaziKosaricu() {
  const kosarica = JSON.parse(localStorage.getItem("kosarica"));
  const container = document.getElementById("kosarica-prikaz");

  if (!kosarica) {
    container.innerHTML = "<p>Košarica je prazna.</p>";
    return;
  }

  container.innerHTML = `
    <div class="kosarica-summary">
      <h3>Detalji rezervacije</h3>
      <p><span>Destinacija:</span> ${kosarica.naziv}</p>
      <p><span>Polazak:</span> ${kosarica.polazak || "-"}</p>
      <p><span>Povratak:</span> ${kosarica.povratak || "-"}</p>
      <p><span>Količina:</span> ${kosarica.kolicina || 1}</p>
      <p class="cijena"><span>Ukupno:</span> €${Number(kosarica.cijena || 0).toFixed(2)}</p>
    </div>
  `;
}

function obrisiKosaricu() {
  localStorage.removeItem("kosarica");
  prikaziKosaricu();

  document.getElementById("kosaricaBox").innerHTML =
    `<p class="prazno">Košarica je prazna.</p>`;

  document.getElementById("ukupnoIznos").textContent = `0 €`;
  btn.disabled = true;
}

prikaziKosaricu();
</script>

</body>
</html>
