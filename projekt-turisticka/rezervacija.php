<?php
include "config/db.php";
?>

<h1>Rezervacija</h1>

<form method="POST">
  <input type="text" name="ime" placeholder="Ime" required><br>
  <input type="text" name="prezime" placeholder="Prezime" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="text" name="telefon" placeholder="Telefon" required><br>

  <input type="date" name="polazak" required><br>
  <input type="date" name="povratak" required><br>

  <input type="number" name="kolicina" value="1" min="1"><br>

  <!-- privremeno ćemo staviti destinaciju 1 -->
  <input type="hidden" name="destinacija_id" value="1">

  <button type="submit" name="submit">Rezerviraj</button>
</form>

<?php

if(isset($_POST['submit'])) {

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $polazak = $_POST['polazak'];
    $povratak = $_POST['povratak'];
    $kolicina = $_POST['kolicina'];
    $destinacija_id = $_POST['destinacija_id'];

    // 1. spremi korisnika
    $conn->query("INSERT INTO korisnici (ime, prezime, email, telefon)
    VALUES ('$ime', '$prezime', '$email', '$telefon')");

    $korisnik_id = $conn->insert_id;

    // 2. uzmi cijenu destinacije
    $result = $conn->query("SELECT cijena FROM destinacije WHERE id=$destinacija_id");
    $dest = $result->fetch_assoc();
    $cijena = $dest['cijena'];

    // 3. ukupna cijena
    $ukupno = $cijena * $kolicina;

    // 4. spremi rezervaciju
    $conn->query("INSERT INTO rezervacije 
    (korisnik_id, destinacija_id, polazak, povratak, kolicina, ukupna_cijena)
    VALUES 
    ($korisnik_id, $destinacija_id, '$polazak', '$povratak', $kolicina, $ukupno)");

    echo "Rezervacija uspješna 🎉";
}
?>