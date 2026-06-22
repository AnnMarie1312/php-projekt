// ===== KONTAKT FORMA (radi samo ako forma postoji na toj stranici) =====
const form = document.getElementById('kontaktForm');
const datumInput = document.getElementById("datum");

if (datumInput) {
  const danas = new Date().toISOString().split("T")[0];
  datumInput.min = danas;
}

if (form) {
   //  BLOKIRA stare datume u kalendaru
  const datumInput = document.getElementById("datum");
  const danas = new Date().toISOString().split("T")[0];
  datumInput.min = danas;
  
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const ime = document.getElementById('ime').value.trim();
    const email = document.getElementById('email').value.trim();
    const destinacija = document.getElementById('destinacija').value.trim();
    const datum = document.getElementById('datum').value;
    const poruka = document.getElementById('poruka').value.trim();

    if (!ime || !email || !destinacija || !datum || !poruka) {
      alert('Molimo popunite sva polja.');
      return;
    }

   const emailRegex = /^[^\s@]{2,}@[^\s@]{2,}\.[^\s@]{2,}$/;

    if (!emailRegex.test(email)) {
      alert("Neispravan email!");
      return;
    }

    const rezervacija = { ime, email, destinacija, datum, poruka };

    let rezervacije = JSON.parse(localStorage.getItem('rezervacije')) || [];
    rezervacije.push(rezervacija);
    localStorage.setItem('rezervacije', JSON.stringify(rezervacije));
    // reset forme
    form.reset();
    localStorage.setItem("imeKorisnika", ime);

    // preusmjeri na hvala stranicu
    window.location.href = "hvala.html";
  });
}

//  HERO DIJAGONALNI WIPE (GSAP ScrollTrigger) 
if (document.querySelector("#container") && document.querySelector("#target")) {
  gsap.config({ trialWarn: false });
  gsap.registerPlugin(ScrollTrigger);

  // (Opcionalno) markers: true za debug; kad radi, prebaci na false
  gsap.timeline({
    scrollTrigger: {
      trigger: "#container",
      start: "top top",
      end: "+=900",
      pin: true,
      scrub: 1,
      markers: false
    }
  })
    // 1) otkrij dijagonalni trokut
    .to("#target", {
      clipPath: "polygon(0 0, 100% 0, 0 100%, 0 100%)",
      ease: "none"
    })
    // 2) pa do kraja otkrij cijelu sliku
    .to("#target", {
      clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)",
      ease: "none"
    });
}




