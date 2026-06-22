<?php
include "config/db.php";
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWithUs - Destinacije</title>

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

<main>
    <section>
        <h1>Naše destinacije</h1>

        <table>
            <thead>
                <tr>
                    <th>Destinacija</th>
                    <th>Cijena</th>
                    <th>Trajanje</th>
                    <th>Popust</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM destinacije");

                while ($row = $result->fetch_assoc()) {
                    $link = "#";

                    if ($row['naziv'] == "Pariz") {
                        $link = "pariz.php";
                    } elseif ($row['naziv'] == "Rim") {
                        $link = "rim.php";
                    } elseif ($row['naziv'] == "Istanbul") {
                        $link = "istanbul.php";
                    }

                    echo "
                    <tr>
                        <td><a href='$link'>{$row['naziv']}</a></td>
                        <td>€{$row['cijena']}</td>
                        <td>{$row['trajanje']} dana</td>
                        <td>{$row['popust']}%</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>

        <div class="slike-destinacija">
            <a href="html/pariz.php">
                <img src="slike/pariz.jpg" alt="Pariz">
            </a>

            <a href="html/pariz.php">
                <img src="slike/pariz1.jpg" alt="Pariz">
            </a>

            <a href="html/rim.php">
                <img src="slike/rome.jpg" alt="Rim">
            </a>

            <a href="html/istanbul.php">
                <img src="slike/istanbul3.jpg" alt="Istanbul">
            </a>

            <a href="html/istanbul.php">
                <img src="slike/istanbul1.jpg" alt="Istanbul">
            </a>

            <a href="html/istanbul.php">
                <img src="slike/istanbul2.jpg" alt="Istanbul">
            </a>
        </div>
    </section>

    <section class="recenzije">
        <h2>Iskustva naših putnika</h2>

        <div class="recenzije-grid">
            <div class="recenzija">
                <p>"Putovanje u Rim bilo je savršeno organizirano. Definitivno preporučujem!"</p>
                <span>- Ana, Zagreb</span>
            </div>

            <div class="recenzija">
                <p>"Istanbul me oduševio. Hrana, kultura i vodič su bili odlični."</p>
                <span>- Marko, Split</span>
            </div>

            <div class="recenzija">
                <p>"Pariz je bio san. TravelWithUs je sve organizirao bez problema."</p>
                <span>- Petra, Osijek</span>
            </div>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2026 TravelWithUs. Sva prava pridržana.</p>
</footer>

</body>
</html>