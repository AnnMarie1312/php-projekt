# TravelWithUs – PHP web aplikacija za turističku agenciju

## Opis projekta

TravelWithUs je web aplikacija razvijena u PHP-u koja simulira rad turističke agencije. Korisnicima omogućuje pregled turističkih destinacija, registraciju i prijavu u sustav, upravljanje rezervacijama te korištenje funkcionalnosti prilagođenih njihovoj ulozi.

Projekt je izrađen kao projektni zadatak za kolegij Osnove PHP-a.

## Korištene tehnologije

* PHP
* MySQL
* HTML5
* CSS3
* JavaScript
* XAMPP
* phpMyAdmin

## Glavne funkcionalnosti

### Autentikacija korisnika

* Registracija korisnika
* Prijava korisnika
* Odjava korisnika
* Hashiranje lozinki pomoću `password_hash()`
* Provjera lozinki pomoću `password_verify()`
* Korištenje prepared statements radi sigurnosti

### Kontrola pristupa po ulogama

Implementirane su dvije korisničke uloge:

* Administrator
* Korisnik

Administrator ima dodatne mogućnosti upravljanja destinacijama i pregled koliki je ukupan broj destinacija.

### Upravljanje destinacijama (CRUD)

Administrator može:

* Dodavati destinacije
* Pregledavati destinacije
* Uređivati destinacije
* Brisati destinacije

### Dashboard

Dashboard prikazuje različite informacije ovisno o prijavljenoj ulozi.

Administrator vidi:

* Broj korisnika
* Broj destinacija
* Ukupan broj rezervacija

Korisnik vidi:

* Broj vlastitih rezervacija
* Pregled dostupnih funkcionalnosti

### Rezervacije

Korisnicima je omogućeno:

* Pregled destinacija
* Izrada rezervacija
* Pregled vlastitih rezervacija

## Relacije baze podataka

Projekt koristi relaciju jedan-prema-više.

Primjer:

Jedan korisnik može imati više rezervacija.

## Struktura projekta

projekt-turisticka/

├── auth/

│   ├── login.php

│   ├── logout.php

│   └── register.php

│

├── config/

│   └── db.php

│

├── css/

│   ├── style.css

│   └── style-php.css

│

├── database/

│   └── travelwithus.sql

│

├── js/

│   └── script.js

│

├── slike/

│

├── admin-destinacije.php

├── checkout.php

├── dashboard.php

├── destinacije.php

├── dodaj-destinaciju.php

├── hvala.php

├── index.php

├── istanbul.php

├── kontakt.php

├── kosarica.php

├── moje-rezervacije.php

├── o-nama.php

├── obrisi-destinaciju.php

├── pariz.php

├── rezervacija.php

├── rim.php

├── test.php

└── uredi-destinaciju.php


## Pokretanje projekta

### Preduvjeti

Potrebno je imati instaliran:

* XAMPP
* Apache
* MySQL

### Koraci pokretanja

1. Pokrenuti Apache i MySQL u XAMPP Control Panelu.

2. Projekt kopirati u folder:

C:\xampp\htdocs\projekt-turisticka

3. Otvoriti phpMyAdmin.

4. Kreirati bazu podataka.

5. Uvesti SQL datoteku projekta.

6. Provjeriti podatke za povezivanje u datoteci `config/db.php`.

7. U pregledniku otvoriti:

http://localhost/projekt-turisticka/index.php

## Autor

Anamarija Katinić

