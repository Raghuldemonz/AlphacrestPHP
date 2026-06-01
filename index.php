<?php
// ✅ This MUST be the first thing in index.php — before ANY HTML, spaces, or blank lines
session_start();
include("dbconnect.php");

if(isset($_POST['send']))
{
    $name       = $_POST['name'];
    $country    = $_POST['country'];
    $code       = $_POST['countryCode'];
    $mobile     = $_POST['mobile'];
    $email      = $_POST['email'];
    $service    = $_POST['service'];
    $message    = $_POST['message'];
    $fullMobile = $code . $mobile;
    $date       = date("Y-m-d "); // ✅ MySQL-compatible format

    $stmt = mysqli_prepare($connect,
        "INSERT INTO messagedb (name, country, mobile, email, service, message, date)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param($stmt, "sssssss",
        $name, $country, $fullMobile, $email, $service, $message, $date
    );

    if(mysqli_stmt_execute($stmt))
    {
        $_SESSION['form_status'] = 'success';
    }
    else
    {
        $_SESSION['form_status'] = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>AlphaCrest Digital</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Caveat:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
<!-- =========================
        MODERN WEBSITE LOADER
========================= -->
<div id="siteLoader">

    <!-- BACKGROUND GLOW -->
    <div class="loader-bg-glow glow1"></div>
    <div class="loader-bg-glow glow2"></div>

    <div class="modern-loader">

        <!-- DARK MODE LOGO -->
        <img src="static/image/AC 1.png"
             alt="Logo"
             class="loader-logo dark-logo">

        <!-- LIGHT MODE LOGO -->
        <img src="static/image/AC.png"
             alt="Logo"
             class="loader-logo light-logo">

        <!-- LOADING BAR -->
        <div class="loading-bar">
            <span></span>
        </div>

        <!-- TEXT -->
        <h3 class="loading-text">
            Loading...
        </h3>

    </div>

</div>

<style>
/* =========================
   MODERN LOADER
========================= */
#siteLoader{
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;

    display: flex;
    justify-content: center;
    align-items: center;

    z-index: 999999;

    background:
    radial-gradient(circle at top left,
    rgba(13,110,253,0.15),
    transparent 30%),

    radial-gradient(circle at bottom right,
    rgba(56,189,248,0.12),
    transparent 30%),

    linear-gradient(135deg,#020617,#07152f,#0f172a);

    transition:
    opacity 0.8s ease,
    visibility 0.8s ease;
}

/* =========================
   LIGHT MODE
========================= */
body.light-mode #siteLoader{

    background:
    radial-gradient(circle at top left,
    rgba(13,110,253,0.10),
    transparent 30%),

    radial-gradient(circle at bottom right,
    rgba(56,189,248,0.08),
    transparent 30%),

    linear-gradient(180deg,#f8fafc,#eef4ff,#ffffff);
}

/* =========================
   GLOW EFFECT
========================= */
.loader-bg-glow{
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    opacity: 0.5;

    animation: floatGlow 8s infinite ease-in-out;
}

.glow1{
    width: 300px;
    height: 300px;
    background: #0d6efd;

    top: -100px;
    left: -100px;
}

.glow2{
    width: 280px;
    height: 280px;
    background: #38bdf8;

    bottom: -100px;
    right: -100px;

    animation-delay: 2s;
}

/* =========================
   CONTENT
========================= */
.modern-loader{
    position: relative;
    z-index: 2;
    text-align: center;
}

/* =========================
   LOGO
========================= */
.loader-logo{
    width: 110px;
    max-width: 80%;

    animation:
    logoFloat 3s infinite ease-in-out;

    margin-bottom: 30px;
}

/* DARK LOGO DEFAULT */
.dark-logo{
    display: block;
}

.light-logo{
    display: none;
}

/* LIGHT MODE LOGO */
body.light-mode .dark-logo{
    display: none;
}

body.light-mode .light-logo{
    display: block;
}

/* =========================
   LOADING BAR
========================= */
.loading-bar{
    width: 260px;
    height: 6px;

    margin: auto;

    border-radius: 50px;
    overflow: hidden;

    background:
    rgba(255,255,255,0.08);

    position: relative;
}

/* LIGHT MODE */
body.light-mode .loading-bar{
    background:
    rgba(0,0,0,0.08);
}

.loading-bar span{
    position: absolute;
    left: -40%;
    top: 0;

    width: 40%;
    height: 100%;

    border-radius: 50px;

    background:
    linear-gradient(90deg,#0d6efd,#38bdf8);

    animation: loadingMove 1.6s infinite ease;
}

/* =========================
   TEXT
========================= */
.loading-text{
    margin-top: 22px;

    color: #ffffff;

    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;

    animation: fadeText 2s infinite;
}

/* LIGHT MODE TEXT */
body.light-mode .loading-text{
    color: #0f172a;
}

/* =========================
   ANIMATIONS
========================= */
@keyframes loadingMove{

    0%{
        left: -40%;
    }

    100%{
        left: 100%;
    }
}

@keyframes logoFloat{

    0%{
        transform: translateY(0px);
    }

    50%{
        transform: translateY(-8px);
    }

    100%{
        transform: translateY(0px);
    }
}

@keyframes fadeText{

    0%{
        opacity: 0.5;
    }

    50%{
        opacity: 1;
    }

    100%{
        opacity: 0.5;
    }
}

@keyframes floatGlow{

    0%{
        transform: translateY(0px) scale(1);
    }

    50%{
        transform: translateY(-25px) scale(1.08);
    }

    100%{
        transform: translateY(0px) scale(1);
    }
}

/* =========================
   HIDE LOADER
========================= */
.loader-hide{
    opacity: 0;
    visibility: hidden;
}

/* =========================
   MOBILE
========================= */
@media(max-width:576px){

    .loader-logo{
        width: 80px;
    }

    .loading-bar{
        width: 210px;
    }

    .loading-text{
        font-size: 15px;
    }
}
</style>

<script>
/* =========================
   HIDE LOADER
========================= */
window.addEventListener("load", () => {

    const loader = document.getElementById("siteLoader");

    setTimeout(() => {

        loader.classList.add("loader-hide");

    }, 1800);

});
</script>
<!------------------------------------------------------------------------------>
<nav class="navbar navbar-expand-lg fixed-top custom-navbar">
    <div class="container">

        <a class="navbar-brand" href="#home">
            <div class="logo-box">
                <img src="static/image/AC 1.png" alt="Logo" class="logo-img dark-logo">
                <img src="static/image/AC.png" alt="Logo" class="logo-img light-logo">
            </div>
        </a>

        <div class="d-flex align-items-center gap-2 ms-auto me-2 me-lg-0 navbar-actions">
            
           

         

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link " href="#home">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        <i class="fa-solid fa-user-group"></i> About
                    </a>
                </li>

               
<li class="nav-item dropdown custom-dropdown-hover">
    <a class="nav-link dropdown-toggle"
       href="#services"
       role="button"
       id="servicesDropdownLink"
       onclick="handleServicesClick(event)"
       aria-expanded="false">
        <i class="fa-solid fa-layer-group"></i> Services
        <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
    </a>
    
    <ul class="dropdown-menu custom-dropdown" id="servicesDropdownMenu">
        <li><a class="dropdown-item" href="#social-media-marketing">Social Media Marketing</a></li>
        <li><a class="dropdown-item" href="#branding">Branding</a></li>
        <li><a class="dropdown-item" href="#content-creation">Content Creation</a></li>
        <li><a class="dropdown-item" href="#meta-ads">Meta Ads</a></li>
        <li><a class="dropdown-item" href="#video-production">Video Production</a></li>
        <li><a class="dropdown-item" href="#website-development">Website Development</a></li>
        <li><a class="dropdown-item" href="#ai-storytelling-videos">AI Storytelling Videos</a></li>
    </ul>
</li>
<script>
    function handleServicesClick(event) {
    // 1. Default-a Bootstrap click-a block panradha napa niruthrom
    event.preventDefault();
    
    // 2. Orey nerathula unga #services section-ku smooth scroll aagum
    const targetSection = document.querySelector('#services');
    if (targetSection) {
        targetSection.scrollIntoView({ behavior: 'smooth' });
    }
    
    // 3. Andha sec-ku scroll aaguraye orey click-la dropdown-ayum force open panrom
    const linkEl = document.getElementById('servicesDropdownLink');
    const menuEl = document.getElementById('servicesDropdownMenu');
    
    if (linkEl && menuEl) {
        const isExpanded = linkEl.getAttribute('aria-expanded') === 'true';
        
        if (!isExpanded) {
            linkEl.setAttribute('aria-expanded', 'true');
            linkEl.classList.add('show');
            menuEl.classList.add('show');
            menuEl.setAttribute('data-bs-popper', 'static');
        } else {
            // Marubadi click panna close aaga
            linkEl.setAttribute('aria-expanded', 'false');
            linkEl.classList.remove('show');
            menuEl.classList.remove('show');
            menuEl.removeAttribute('data-bs-popper');
        }
    }
}

// Side-gap click panna menu close aaga intha chinnadhaium sethukoga
document.addEventListener('click', function(e) {
    const linkEl = document.getElementById('servicesDropdownLink');
    const menuEl = document.getElementById('servicesDropdownMenu');
    if (linkEl && !linkEl.contains(e.target) && menuEl && !menuEl.contains(e.target)) {
        linkEl.setAttribute('aria-expanded', 'false');
        linkEl.classList.remove('show');
        menuEl.classList.remove('show');
    }
});
</script>

                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">
                       <i class="fa-solid fa-briefcase"></i> Portfolio
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="#clients">
                        <i class="fa-solid fa-handshake"></i> Clients
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">
                        <i class="fa-solid fa-envelope"></i> Contact
                    </a>
                </li>

            </ul>
             <button class="theme-toggle d-lg-none" id="themeToggleMobile" type="button" onclick="globalToggleTheme(event)" aria-label="Toggle Theme">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>

    </div>
</nav>

<style>
html { scroll-behavior: smooth; }
body { overflow-x: hidden; }

/* ================= NAVBAR CORE ================= */
.custom-navbar {
    padding: 18px 0;
    background: rgba(2, 6, 23, 0.75);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    transition: background 0.4s ease, border-color 0.4s ease, padding 0.4s ease;
    z-index: 9999;
}

.logo-img { width: 190px; height: auto; }

/* ================= DARK / LIGHT LOGO CONTROL ================= */
.light-logo { display: none; }
.dark-logo { display: block; }

body.light-mode .light-logo { display: block !important; }
body.light-mode .dark-logo { display: none !important; }

/* ================= NAV LINKS ================= */
.navbar-nav { gap: 10px; }
.nav-link {
    color: #e2e8f0 !important;
    font-size: 15px;
    font-weight: 500;
    padding: 12px 22px !important;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s ease;
    white-space: nowrap;
    text-decoration: none;
}

.nav-link i, .nav-link svg { font-size: 15px; color: #38bdf8; }
.nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
    color: white !important;
    transform: translateY(-2px);
}

.nav-link.active { background: linear-gradient(45deg, #0d6efd, #38bdf8); color: white !important; }
.nav-link.active i, .nav-link.active svg { color: white !important; }
.dropdown-toggle::after { display: none !important; }

/* ================= CUSTOM DROPDOWN ================= */
.custom-dropdown {
    margin-top: 14px;
    padding: 14px;
    border-radius: 24px;
    background: rgba(15, 23, 42, 0.98);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255, 255, 255, 0.06);
    min-width: 280px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.25);
}
.custom-dropdown .dropdown-item {
    color: #e2e8f0; font-size: 15px; font-weight: 500; padding: 14px 18px; border-radius: 16px; transition: 0.3s ease; margin-bottom: 6px; text-decoration: none;
}
.custom-dropdown .dropdown-item:hover { background: linear-gradient(45deg, #0d6efd, #38bdf8); color: white; }
.dropdown-arrow { font-size: 12px !important; margin-left: 4px; transition: 0.3s ease; }
.dropdown.show .dropdown-arrow { transform: rotate(180deg); }

/* ================= UNIVERSAL THEME TOGGLE DESIGN ================= */
.navbar-actions { position: relative; z-index: 10005 !important; }
.theme-toggle {
    width: 46px; height: 46px; border-radius: 50%; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.08);
    display: flex !important; align-items: center; justify-content: center; color: white !important; cursor: pointer !important; transition: 0.3s ease; flex-shrink: 0; padding: 0;
}
.theme-toggle * { pointer-events: none !important; }
.theme-toggle:hover { transform: scale(1.05); background: linear-gradient(45deg, #0d6efd, #38bdf8); color: white !important; }
.navbar-toggler { border: none !important; outline: none !important; box-shadow: none !important; width: 46px; height: 46px; border-radius: 50%; background: rgba(255, 255, 255, 0.08); color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; }

/* ================= MOBILE RESPONSIVE ENGINE (MAX 991px) ================= */
@media (max-width: 991px) {
    .custom-navbar { padding: 12px 0; }
    .logo-img { width: 140px; }
    .navbar-collapse { margin-top: 18px; padding: 20px; border-radius: 24px; background: rgba(15, 23, 42, 0.98); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); max-height: 75vh; overflow-y: auto; }
    .navbar-nav { gap: 10px; align-items: stretch !important; }
    .nav-link { width: 100%; justify-content: flex-start; padding: 14px 18px !important; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.04); border-radius: 50px; }
    .dropdown-menu { position: static !important; transform: none !important; width: 100%; box-shadow: none; float: none; }
    .custom-dropdown { background: rgba(255, 255, 255, 0.02) !important; border: 1px solid rgba(255, 255, 255, 0.05) !important; padding: 8px; margin-top: 8px; border-radius: 20px; min-width: 100%; }
    .custom-dropdown .dropdown-item { border-radius: 14px; padding: 12px 16px; background: transparent !important; color: #cbd5e1; }
    .custom-dropdown .dropdown-item:hover { background: linear-gradient(45deg, #0d6efd, #38bdf8) !important; color: white !important; }
}

@media (max-width: 576px) { .logo-img { width: 125px; } }

/* ================= LIGHT MODE OVERRIDES ================= */
body.light-mode .custom-navbar { background: rgba(255, 255, 255, 0.85); border-bottom: 1px solid #e2e8f0; }
body.light-mode .nav-link { color: #0f172a !important; }
body.light-mode .nav-link:hover { background: #eff6ff; }
body.light-mode .navbar-collapse { background: #ffffff; box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
body.light-mode .theme-toggle { background: #eff6ff !important; color: #0f172a !important; border: 1px solid #dbeafe; }
body.light-mode .navbar-toggler { background: #eff6ff; color: #0f172a; }
body.light-mode .nav-link i, body.light-mode .nav-link svg { color: #0d6efd; }
body.light-mode .custom-dropdown { background: #ffffff !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
body.light-mode .custom-dropdown .dropdown-item { color: #334155; }

@media (max-width: 991px) {
    body.light-mode .nav-link { background: #f8fafc; border: 1px solid #e2e8f0; }
    body.light-mode .custom-dropdown { background: #f8fafc !important; }
}
</style>
<!-- ================= HERO SECTION START ================= -->

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>

:root{
    --primary:#00b4ec;
}

/* HERO SECTION */

.hero-section{
    position:relative;
    min-height:100vh;
    display:flex;
    align-items:center;
    overflow:hidden;
    padding:100px 0;

    
    url("static/image/heroo.jpg");

    background-size:cover;
    background-position:center;
}

.hero-section::before{
    content:"";
    position:absolute;
    inset:0;

    background:url("static/image/heroo.jpg");
    background-size:cover;
    background-position:center;

  

    z-index:-1;
}



/* LIGHT MODE */



body.light-mode .hero-title{
    color:#14bbe0;
}

body.light-mode .hero-desc{
    color:#374151;
}

body.light-mode .hero-stat-card{
    background:rgba(255,255,255,.85);
    border:1px solid rgba(0,0,0,.08);
}

body.light-mode .btn-custom-outline{
    color:#111827;
    border-color:#111827;
}

body.light-mode .btn-custom-outline:hover{
    background:#111827;
    color:#fff;
}

/* CONTENT */

.hero-content{
    position:relative;
    z-index:10;
}

.hero-title{
    font-family:'Anton',sans-serif;
    font-size:5rem;
    line-height:0.9;
    letter-spacing:2px;
    text-transform:uppercase;
    font-weight:200;
}

@font-face{
    font-family:'Rockybilly';
    src:url('static/font/rockybilly.regular.ttf') format('truetype');
}

.script-text{
    font-family:'Rockybilly',cursive;
    color:#00b4ec;
    font-size:2rem;
    line-height:2;
    display:inline-block;
    transform:rotate(-4deg);
    text-transform:none;
}

.hero-desc{
    max-width:600px;
    font-size:1.05rem;
    color:#cbd5e1;
    line-height:1.8;
    margin-bottom:35px;
}

.hero-desc strong{
    color:var(--primary);
}

/* BUTTONS */

.btn-custom-blue{
    background:var(--primary);
    color:#000;
    border:2px solid var(--primary);
    padding:14px 35px;
    border-radius:50px;
    font-weight:600;
    transition:.4s;
    text-decoration:none;
}

.btn-custom-blue:hover{
    transform:translateY(-5px);
    color:#000;
    box-shadow:0 15px 35px rgba(0,180,236,.35);
}

.btn-custom-outline{
    background:transparent;
    color:#fff;
    border:2px solid #fff;
    padding:14px 35px;
    border-radius:50px;
    font-weight:600;
    transition:.4s;
    text-decoration:none;
}

.btn-custom-outline:hover{
    background:#fff;
    color:#000;
}

/* STATS */

.hero-stats{
    display:flex;
    gap:20px;
    margin-top:50px;
    flex-wrap:wrap;
}

.hero-stat-card{
    flex:1;
    min-width:180px;

    background:rgba(255,255,255,.08);
    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:20px;
    padding:25px;
    text-align:center;

    transition:.4s;
}

.hero-stat-card:hover{
    transform:translateY(-10px);
}

.stat-icon{
    width:60px;
    height:60px;

    margin:auto auto 15px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;
    background:rgba(0,180,236,.15);

    color:var(--primary);
    font-size:22px;
}

.hero-stat-card h2{
    color:var(--primary);
    font-size:2rem;
    margin-bottom:8px;
}

.hero-stat-card p{
    color:inherit;
    margin:0;
}

/* MOBILE */

@media(max-width:991px){

.hero-section{
    text-align:center;

    background:url("static/image/heroo.jpg");

    background-size:cover;
}

.hero-title{
    font-size:5rem;
}

.script-text{
    font-size:2rem;
}

.hero-desc{
    margin:auto auto 30px;
}

.hero-stats{
    justify-content:center;
}

}

@media(max-width:576px){

.hero-section{
    padding:80px 0;
}

.hero-title{
    font-size:2.8rem;
}

.script-text{
    font-size:1rem;
}

.hero-desc{
    font-size:.95rem;
}

.hero-stat-card{
    min-width:100%;
}

}
@media(max-width:991px){

.hero-section{
    text-align:center;

    background:url("static/image/heroo.jpg");

    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;
}

}

</style>

<section class="hero-section" id="home">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-7 hero-content">

<h1 class="hero-title"
data-aos="fade-up">

We Build
<span class="script-text">Brands</span><br>

That
<span class="script-text">Grow</span>

Digitally

</h1>

<p class="hero-desc"
data-aos="fade-up"
data-aos-delay="150">

At <strong>AlphaCrest Digital</strong>,
we help businesses grow through strategic branding,
social media marketing, high-converting content,
and performance-driven digital campaigns.

</p>

<div class="d-flex flex-wrap gap-3"
data-aos="fade-up"
data-aos-delay="250">

<a href="#contact" class="btn-custom-blue">
Get Started
</a>

<a href="#works" class="btn-custom-outline">
View Our Work
</a>

</div>

<div class="hero-stats"
data-aos="fade-up"
data-aos-delay="350">

<div class="hero-stat-card">

<div class="stat-icon">
<i class="fa-solid fa-rocket"></i>
</div>

<h2>
<span class="counter" data-target="150">0</span>+
</h2>

<p>Projects Completed</p>

</div>

<div class="hero-stat-card">

<div class="stat-icon">
<i class="fa-solid fa-users"></i>
</div>

<h2>
<span class="counter" data-target="98">0</span>%
</h2>

<p>Happy Clients</p>

</div>

<div class="hero-stat-card">

<div class="stat-icon">
<i class="fa-solid fa-award"></i>
</div>

<h2>
<span class="counter" data-target="4">0</span>+
</h2>

<p>Years Experience</p>

</div>

</div>

</div>

</div>

</div>

</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({
    duration:1000,
    once:true
});

const counters=document.querySelectorAll(".counter");

const observer=new IntersectionObserver(entries=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

const counter=entry.target;
const target=+counter.dataset.target;

let count=0;

const updateCounter=()=>{

count+=target/80;

if(count<target){

counter.innerText=Math.ceil(count);

requestAnimationFrame(updateCounter);

}else{

counter.innerText=target;

}

};

updateCounter();

observer.unobserve(counter);

}

});

},{threshold:0.5});

counters.forEach(counter=>{
observer.observe(counter);
});

</script>
<script>

document.addEventListener("DOMContentLoaded", () => {

    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {

        const target = +counter.getAttribute("data-target");

        function animateCounter(){

            let count = 0;

            const speed = target / 120;

            function updateCounter(){

                count += speed;

                if(count < target){

                    counter.innerText = Math.ceil(count);

                    requestAnimationFrame(updateCounter);

                }else{

                    counter.innerText = target;

                    /* RESET AGAIN */

                    setTimeout(() => {

                        count = 0;

                        updateCounter();

                    }, 1500);

                }

            }

            updateCounter();

        }

        animateCounter();

    });

});

</script>

<!-- ================= HERO SECTION END ================= -->
<script>
// Highly-isolated global execution loop completely bypasses other crashing code blocks
function globalToggleTheme(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Toggle class directly on body
    var bodyEl = document.body;
    bodyEl.classList.toggle('light-mode');
    var isLight = bodyEl.classList.contains('light-mode');
    
    // Update both toggle button icons instantly
    var targets = document.querySelectorAll('.theme-toggle');
    for (var i = 0; i < targets.length; i++) {
        if (isLight) {
            targets[i].innerHTML = '<i class="fa-solid fa-sun"></i>';
        } else {
            targets[i].innerHTML = '<i class="fa-solid fa-moon"></i>';
        }
    }
}

// Separate Bootstrap link close logic
document.addEventListener("DOMContentLoaded", function() {
    var menuCollapse = document.getElementById('navbarNav');
    if(menuCollapse) {
        var navItems = document.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item');
        navItems.forEach(function(item) {
            item.addEventListener('click', function() {
                if (menuCollapse.classList.contains('show') && typeof bootstrap !== 'undefined') {
                    var api = bootstrap.Collapse.getInstance(menuCollapse) || new bootstrap.Collapse(menuCollapse);
                    api.hide();
                }
            });
        });
    }
});
</script>

<style>
/* GOOGLE FONTS */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;600;700;800&display=swap');

/* BASE */
.about {
    background: #0f172a;
    padding: 100px 0;
    font-family: 'Inter', sans-serif;
    transition: 0.4s ease;
    overflow: hidden;
}

/* LIGHT MODE */
body.light-mode .about {
    background: #f8fafc;
}

/* TITLE */
.section-title h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 42px;
    font-weight: 800;
    color: #fff;
    letter-spacing: 1px;
}

.section-title h2 span {
    color: #38bdf8;
}

body.light-mode .section-title h2 {
    color: #111827;
}

/* ================= THE ULTIMATE SCROLL SLIDE ENGINE ================= */
.scroll-reveal-left {
    opacity: 0;
    transform: translateX(-80px); /* Left side la irundhu slide aaga */
    transition: all 0.8s cubic-bezier(0.25, 1, 0.5, 1);
    will-change: transform, opacity;
}

.scroll-reveal-right {
    opacity: 0;
    transform: translateX(80px); /* Right side la irundhu slide aaga */
    transition: all 0.8s cubic-bezier(0.25, 1, 0.5, 1);
    will-change: transform, opacity;
}

/* Trigger Active State when scrolled into view */
.scroll-reveal-left.active,
.scroll-reveal-right.active {
    opacity: 1;
    transform: translateX(0);
}

/* Step-by-Step Delays for Content Reading Flow */
.delay-1 { transition-delay: 0.1s; }
.delay-2 { transition-delay: 0.2s; }
.delay-3 { transition-delay: 0.3s; }
.delay-4 { transition-delay: 0.4s; }
.delay-5 { transition-delay: 0.5s; }


/* TEXT WITH HOVER ACTION */
.about-text {
    color: #cbd5e1;
    line-height: 1.9;
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 15px;
    display: block;
    transition: color 0.3s ease, transform 0.3s ease;
}

.about-text:hover {
    color: #fff;
    transform: translateX(10px) !important; /* Mouse vecha innum konjam move aagum */
    text-shadow: 0px 2px 10px rgba(56, 189, 248, 0.2);
}

body.light-mode .about-text {
    color: #475569;
}
body.light-mode .about-text:hover {
    color: #0f172a;
}

/* SUB HEADING */
.about-subtitle {
    font-family: 'Poppins', sans-serif;
    font-size: 22px;
    font-weight: 700;
    margin-top: 25px;
    color: #fff;
    letter-spacing: 0.5px;
    display: inline-block;
    transition: all 0.3s ease;
}

.about-subtitle:hover {
    color: #38bdf8;
    transform: scale(1.05);
}

body.light-mode .about-subtitle {
    color: #111827;
}

/* BOX INTERACTIONS */
.about-box {
    background: rgba(255, 255, 255, 0.05);
    padding: 18px 20px;
    border-radius: 16px;
    margin-top: 12px;
    border: 1px solid rgba(255, 255, 255, 0.06);
    transition: all 0.4s ease;
    color: #e2e8f0;
    font-weight: 400;
}

.about-box:hover {
    transform: translateY(-5px) scale(1.01);
    background: rgba(56, 189, 248, 0.12);
    border-color: rgba(56, 189, 248, 0.4);
    color: #fff;
    box-shadow: 0 10px 20px rgba(56, 189, 248, 0.1);
}

.about-box i {
    color: #22c55e;
    margin-right: 10px;
    transition: transform 0.4s ease;
}

.about-box:hover i {
    transform: scale(1.2) rotate(360deg);
}

/* LIGHT MODE BOX */
body.light-mode .about-box {
    background: #fff;
    border: 1px solid #e2e8f0;
    color: #111827;
}
body.light-mode .about-box:hover {
    background: rgba(56, 189, 248, 0.05);
    color: #111827;
}

/* VIDEO CARD CARD */
.about-media {
    position: relative;
    width: 100%;
    max-width: 420px;
    height: 620px;
    margin: auto;
    border-radius: 28px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
    cursor: pointer;
}

.about-media img,
.about-media video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.about-media video {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.about-media:hover video {
    opacity: 1;
}

.about-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
    pointer-events: none;
}

.about-play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.92);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #111827;
    transition: 0.4s ease;
    backdrop-filter: blur(8px);
    z-index: 2;
    pointer-events: none;
}

.about-media:hover .about-play {
    opacity: 0;
    transform: translate(-50%, -50%) scale(0.6);
}

/* RESPONSIVE */
@media (max-width: 991px) {
    .about-media {
        height: 480px;
        max-width: 300px;
    }
    .section-title h2 {
        font-size: 30px;
        text-align: center;
    }
    .about-text,
    .about-subtitle {
        text-align: center;
        display: block;
    }
    .about-text:hover {
        transform: none !important;
    }
    .about-box {
        text-align: left;
    }
}
</style>

<section class="about section-padding" id="about">
    <div class="container">

        <div class="section-title text-center mb-5 scroll-reveal-left">
            <h2>About <span>AlphaCrest Digital</span></h2>
        </div>

        <div class="row align-items-center g-5">

            <div class="col-lg-6 scroll-reveal-left delay-1">
                <div class="about-media">
                    <img src="static/image/Alpha Crest 1.jpg" alt="About">
                    
                    <video id="aboutVideo" loop playsinline preload="auto">
                        <source src="static/video/0504(3).mp4" type="video/mp4">
                    </video>

                    <div class="about-overlay"></div>
                    <div class="about-play">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                
                <p class="about-text scroll-reveal-right delay-1">
                    AlphaCrest Digital is a creative digital marketing agency based in Trichy,
                    focused on helping modern businesses build a powerful online presence.
                </p>

                <p class="about-text scroll-reveal-right delay-2">
                    From branding and content creation to social media management and Meta Ads,
                    we create strategies that attract attention, build trust, and generate real growth.
                </p>

                <p class="about-text scroll-reveal-right delay-3">
                    We believe digital marketing is not just about posting content — it’s about creating impact.
                </p>

                <div class="about-subtitle scroll-reveal-right delay-4">Our Mission</div>
                <div class="about-box scroll-reveal-right delay-4">
                    <i class="fa-solid fa-circle-check"></i>
                    To help businesses grow with creative strategy, strong branding, and consistent digital presence.
                </div>

                <div class="about-subtitle scroll-reveal-right delay-5">Our Vision</div>
                <div class="about-box scroll-reveal-right delay-5">
                    <i class="fa-solid fa-circle-check"></i>
                    To become one of the leading creative digital marketing agencies helping brands scale globally.
                </div>
                
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. SCROLL REVEAL OBSERVER ENGINE
    // Combine both left and right triggers to optimize viewport calculations
    const revealTargets = document.querySelectorAll(".scroll-reveal-left, .scroll-reveal-right");
    
    const scrollObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
                observer.unobserve(entry.target); // Element trigger aanathum tracking off to save memory
            }
        });
    }, {
        threshold: 0.1,  // Triggers as soon as 10% enters the screen
        rootMargin: "0px 0px -40px 0px"
    });

    revealTargets.forEach(target => {
        scrollObserver.observe(target);
    });


    // 2. STABLE VIDEO HOVER AUTOPLAY
    const mediaCard = document.querySelector(".about-media");
    const hoverVideo = document.getElementById("aboutVideo");

    if (mediaCard && hoverVideo) {
        mediaCard.addEventListener("mouseenter", () => {
            hoverVideo.muted = false;
            hoverVideo.volume = 1;
            
            const startPlayback = hoverVideo.play();
            if (startPlayback !== undefined) {
                startPlayback.catch(error => {
                    console.log("Browser policy handled safely:", error);
                });
            }
        });

        mediaCard.addEventListener("mouseleave", () => {
            hoverVideo.pause();
            hoverVideo.currentTime = 0;
        });
    }
});
</script>
<!------------------------------------------------------------------------------>
<!-- ====================================================== -->
<!-- ================= SERVICES SECTION =================== -->
<!-- ====================================================== -->

<section class="services-section section-padding" id="services">

    <!-- BACKGROUND EFFECTS -->

    <div class="service-bg service-bg-1"></div>
    <div class="service-bg service-bg-2"></div>

    <div class="container">

        <!-- ================================================= -->
        <!-- SECTION TITLE -->
        <!-- ================================================= -->

        <div class="services-title text-center"
             data-aos="fade-up">

            <span class="service-mini-title">
                Our Expertise
            </span>

            <h2 class="service-main-title">

                Explore Our
                <span>Services</span>

            </h2>

            <p class="service-description">

                We create premium digital experiences through creative
                marketing, cinematic visuals, branding strategies and
                modern development solutions for growing brands.

            </p>

        </div>

        <!-- ================================================= -->
        <!-- SERVICES GRID -->
        <!-- ================================================= -->

        <div class="row gy-4 justify-content-center mt-5">

            <!-- CARD 1 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1611162616305-c69b3fa7fbe0?q=80&w=1200&auto=format&fit=crop"
                             alt="Social Media Marketing">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Social Media
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Social Media Marketing
                            </h3>

                            <p>
                                We grow brands across Instagram,
                                Facebook and modern social platforms
                                with strategic content.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 2 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?q=80&w=1200&auto=format&fit=crop"
                             alt="Branding">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Branding
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Brand Identity
                            </h3>

                            <p>
                                We create memorable brand identities
                                that make businesses look premium
                                and professional.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 3 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?q=80&w=1200&auto=format&fit=crop"
                             alt="Content Creation">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Content Creation
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Creative Content
                            </h3>

                            <p>
                                Reels, posters, carousel designs and
                                storytelling content crafted for
                                engagement and growth.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 4 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop"
                             alt="Meta Ads">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Meta Ads
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Performance Marketing
                            </h3>

                            <p>
                                High-converting Facebook and Instagram
                                ad campaigns focused on leads,
                                reach and conversions.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 5 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1200&auto=format&fit=crop"
                             alt="Video Production">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Video Production
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Video Production
                            </h3>

                            <p>
                                Professional shoots, cinematic reels
                                and promotional videos that elevate
                                your brand presence.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 6 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <a href="#"
                   class="service-wrap">

                    <div class="service-thumb">

                        <img src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop"
                             alt="Website Development">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            Web Development
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                Website Development
                            </h3>

                            <p>
                                Modern, responsive and conversion-focused
                                websites designed for businesses
                                and growing brands.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- CARD 7 -->

            <div class="col-lg-4 col-md-6"
                 data-aos="zoom-in">

                <a href="#"
                   class="service-wrap ai-service-card">

                    <div class="service-thumb reel-thumb">

                        <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=1200&auto=format&fit=crop"
                             alt="AI Storytelling Videos">

                    </div>

                    <div class="service-details">

                        <span class="service-meta">
                            AI Storytelling
                        </span>

                        <div class="service-content">

                            <h3 class="service-title">
                                AI Storytelling Videos
                            </h3>

                            <p>
                                Creative AI-powered storytelling reels
                                designed to boost engagement, retention
                                and viral audience reach.
                            </p>

                            <div class="service-btn-wrap">

                                <button class="service-btn">
                                    Explore More
                                </button>

                                <div class="service-arrow">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>

</section>

<!-- ====================================================== -->
<!-- ======================= CSS ========================== -->
<!-- ====================================================== -->

<style>

/* ====================================================== */
/* ================= MAIN SECTION ======================== */
/* ====================================================== */

.services-section{

    position:relative;

    overflow:hidden;

    padding:120px 0;

    background:
    linear-gradient(135deg,
    #020617,
    #07152f,
    #0f172a);
}

/* ====================================================== */
/* ================= BACKGROUND EFFECT =================== */
/* ====================================================== */

.service-bg{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    opacity:0.25;

    z-index:0;
}

.service-bg-1{

    width:320px;
    height:320px;

    background:#0ea5e9;

    top:-100px;
    left:-80px;
}

.service-bg-2{

    width:350px;
    height:350px;

    background:#6366f1;

    bottom:-120px;
    right:-100px;
}

/* ====================================================== */
/* ================= CONTAINER =========================== */
/* ====================================================== */

.services-section .container{

    position:relative;

    z-index:2;
}

/* ====================================================== */
/* ================= SECTION TITLE ======================= */
/* ====================================================== */

.services-title{

    max-width:850px;

    margin:auto;
}

.service-mini-title{

    display:inline-block;

    padding:10px 24px;

    border-radius:50px;

    background:
    rgba(255,255,255,0.08);

    border:
    1px solid rgba(255,255,255,0.08);

    color:#38bdf8;

    font-size:14px;

    font-weight:600;

    margin-bottom:22px;
}

.service-main-title{

    font-size:64px;

    font-weight:800;

    color:#fff;

    margin-bottom:20px;

    letter-spacing:-2px;
}

.service-main-title span{

    background:
    linear-gradient(45deg,#38bdf8,#6366f1);

    -webkit-background-clip:text;
    background-clip:text;

    -webkit-text-fill-color:transparent;

    color:transparent;
}

.service-description{

    color:#94a3b8;

    font-size:17px;

    line-height:1.9;
}

/* ====================================================== */
/* ================= SERVICE CARD ======================== */
/* ====================================================== */

.service-wrap{

    position:relative;

    display:block;

    overflow:hidden;

    border-radius:32px;

    text-decoration:none;

    height:100%;

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    transition:0.5s ease;

    box-shadow:
    0 10px 35px rgba(0,0,0,0.25);
}

.service-wrap:hover{

    transform:
    translateY(-14px);

    border-color:
    rgba(56,189,248,0.35);

    box-shadow:
    0 30px 50px rgba(0,0,0,0.4);
}

/* ====================================================== */
/* ================= IMAGE =============================== */
/* ====================================================== */

.service-thumb{

    position:relative;

    overflow:hidden;
}

.service-thumb img{

    width:100%;

    height:480px;

    object-fit:cover;

    transition:0.7s ease;
}

/* AI REEL SIZE */

.reel-thumb img{

    height:560px;
}

.service-wrap:hover .service-thumb img{

    transform:scale(1.12);
}

/* DARK OVERLAY */

.service-thumb::before{

    content:'';

    position:absolute;

    inset:0;

    background:
    linear-gradient(to top,
    rgba(2,6,23,0.96),
    rgba(2,6,23,0.15));

    z-index:1;
}

/* SHINE EFFECT */

.service-wrap::after{

    content:'';

    position:absolute;

    top:-100%;

    left:-100%;

    width:200%;

    height:200%;

    background:
    linear-gradient(
    120deg,
    transparent,
    rgba(255,255,255,0.08),
    transparent);

    transform:rotate(25deg);

    transition:0.8s ease;
}

.service-wrap:hover::after{

    top:100%;
    left:100%;
}

/* ====================================================== */
/* ================= DETAILS ============================= */
/* ====================================================== */

.service-details{

    position:absolute;

    left:0;
    bottom:0;

    width:100%;

    padding:32px;

    z-index:2;
}

/* TAG */

.service-meta{

    display:inline-block;

    padding:8px 18px;

    border-radius:50px;

    background:
    rgba(255,255,255,0.12);

    border:
    1px solid rgba(255,255,255,0.1);

    backdrop-filter:blur(10px);

    color:#38bdf8;

    font-size:13px;

    font-weight:600;

    margin-bottom:18px;
}

/* TITLE */

.service-title{

    color:#fff;

    font-size:30px;

    font-weight:700;

    margin-bottom:14px;
}

/* DESCRIPTION */

.service-content p{

    color:#e2e8f0;

    line-height:1.8;

    font-size:14px;

    margin-bottom:22px;
}

/* BUTTON */

.service-btn-wrap{

    display:flex;

    align-items:center;

    gap:14px;
}

.service-btn{

    border:none;

    padding:12px 24px;

    border-radius:50px;

    background:
    linear-gradient(135deg,
    #38bdf8,
    #6366f1);

    color:#fff;

    font-size:14px;

    font-weight:600;

    transition:0.4s ease;
}

.service-arrow{

    width:46px;
    height:46px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    background:
    rgba(255,255,255,0.12);

    color:#fff;

    transition:0.4s ease;
}

.service-wrap:hover .service-arrow{

    transform:translateX(6px);

    background:#38bdf8;
}

/* SPECIAL AI CARD */

.ai-service-card{

    border:
    1px solid rgba(99,102,241,0.35);

    box-shadow:
    0 0 40px rgba(99,102,241,0.15);
}

/* ====================================================== */
/* ================= LIGHT MODE ========================== */
/* ====================================================== */

body.light-mode .services-section{

    background:
    linear-gradient(180deg,
    #f8fafc,
    #eef4ff,
    #ffffff);
}

body.light-mode .service-mini-title{

    background:#ffffff;

    border:1px solid #dbeafe;

    color:#2563eb;

    box-shadow:
    0 5px 15px rgba(0,0,0,0.05);
}

body.light-mode .service-main-title{
    color:#0f172a;
}

body.light-mode .service-description{
    color:#475569;
}

body.light-mode .service-wrap{

    background:#ffffff;

    border:1px solid #e2e8f0;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.08);
}

body.light-mode .service-thumb::before{

    background:
    linear-gradient(to top,
    rgba(15,23,42,0.88),
    rgba(15,23,42,0.08));
}

/* ====================================================== */
/* ================= RESPONSIVE ========================== */
/* ====================================================== */

@media(max-width:991px){

    .services-section{
        padding:100px 0;
    }

    .service-main-title{
        font-size:48px;
    }

    .service-thumb img{
        height:400px;
    }

    .reel-thumb img{
        height:480px;
    }

}

@media(max-width:576px){

    .services-section{
        padding:80px 0;
    }

    .service-main-title{

        font-size:34px;

        line-height:1.3;
    }

    .service-description{
        font-size:15px;
    }

    .service-details{
        padding:24px;
    }

    .service-title{
        font-size:24px;
    }

    .service-content p{
        font-size:13px;
    }

    .service-thumb img{
        height:330px;
    }

    .reel-thumb img{
        height:430px;
    }

    .service-btn{

        padding:10px 20px;

        font-size:13px;
    }

    .service-arrow{

        width:42px;
        height:42px;
    }

}

</style>

<!-- ====================================================== -->
<!-- ================= AOS ANIMATION ====================== -->
<!-- ====================================================== -->

<link rel="stylesheet"
href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({

    duration:1200,
    once:true

});

</script>
<!------------------------------------------------------------------------------>
<!-- ====================================================== -->
<!-- =============== WHY CHOOSE US PREMIUM ================ -->
<!-- ====================================================== -->

<section class="why-premium-section section-padding" id="why-choose">

    <!-- BACKGROUND GLOW -->

    <div class="why-gradient why-gradient-1"></div>
    <div class="why-gradient why-gradient-2"></div>

    <div class="container">

        <!-- ================================================= -->
        <!-- SECTION TITLE -->
        <!-- ================================================= -->

        <div class="why-section-title text-center"
             data-aos="fade-up">

            <span class="why-badge">
                Why Choose AlphaCrest
            </span>

            <h2 class="why-heading">

                Why Choose
                <span>AlphaCrest Digital?</span>

            </h2>

            <p class="why-text-main">

                We blend creativity, strategy, cinematic visuals
                and performance marketing to help brands stand out
                in the digital world with meaningful growth and
                premium brand impact.

            </p>

        </div>

        <!-- ================================================= -->
        <!-- CONTENT -->
        <!-- ================================================= -->

        <div class="row align-items-center g-5">

            <!-- ================================================= -->
            <!-- LEFT SIDE -->
            <!-- ================================================= -->

            <div class="col-lg-6">

                <div class="why-grid">

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-lightbulb"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                Creative & Strategic Approach
                            </h4>

                            <p>
                                Creative campaigns backed by
                                smart digital strategy.
                            </p>

                        </div>

                    </div>

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up"
                         data-aos-delay="100">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-wand-magic-sparkles"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                Modern Content Ideas
                            </h4>

                            <p>
                                Trend-based content concepts
                                that increase engagement.
                            </p>

                        </div>

                    </div>

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up"
                         data-aos-delay="200">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-camera-retro"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                Professional Visual Quality
                            </h4>

                            <p>
                                Premium visuals with cinematic
                                editing and branding quality.
                            </p>

                        </div>

                    </div>

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up"
                         data-aos-delay="300">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-chart-line"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                Consistent Brand Growth
                            </h4>

                            <p>
                                Long-term growth strategies
                                focused on audience retention.
                            </p>

                        </div>

                    </div>

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up"
                         data-aos-delay="400">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-layer-group"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                End-to-End Digital Support
                            </h4>

                            <p>
                                Branding, ads, content and
                                development under one team.
                            </p>

                        </div>

                    </div>

                    <!-- BOX -->

                    <div class="why-box"
                         data-aos="fade-up"
                         data-aos-delay="500">

                        <div class="why-box-icon">

                            <i class="fa-solid fa-bullseye"></i>

                        </div>

                        <div class="why-box-content">

                            <h4>
                                Performance Marketing
                            </h4>

                            <p>
                                Campaigns optimized for
                                conversions, reach and leads.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ================================================= -->
            <!-- RIGHT SIDE -->
            <!-- ================================================= -->

            <div class="col-lg-6">

                <div class="why-image-area"
                     data-aos="zoom-in">

                    <!-- MAIN IMAGE -->

                    <div class="main-image-card">

                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop"
                             alt="AlphaCrest Team">

                    </div>

                    <!-- FLOATING STATS -->

                    <div class="stats-card stats-card-1">

                        <h3>20+</h3>
                        <p>Trusted Brands</p>

                    </div>

                    <div class="stats-card stats-card-2">

                        <h3>99%</h3>
                        <p>Client Satisfaction</p>

                    </div>

                    <div class="stats-card stats-card-3">

                        <h3>24/7</h3>
                        <p>Digital Support</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ====================================================== -->
<!-- ======================= CSS ========================== -->
<!-- ====================================================== -->

<style>

/* ====================================================== */
/* ================= MAIN SECTION ======================== */
/* ====================================================== */

.why-premium-section{

    position:relative;

    overflow:hidden;

    padding:120px 0;

    background:
    linear-gradient(135deg,
    #020617 0%,
    #07152f 45%,
    #0f172a 100%);
}

/* ====================================================== */
/* ================= BACKGROUND GLOW ===================== */
/* ====================================================== */

.why-gradient{

    position:absolute;

    border-radius:50%;

    filter:blur(140px);

    opacity:0.22;

    z-index:0;
}

.why-gradient-1{

    width:350px;
    height:350px;

    background:#0ea5e9;

    top:-120px;
    left:-120px;
}

.why-gradient-2{

    width:400px;
    height:400px;

    background:#6366f1;

    bottom:-150px;
    right:-150px;
}

/* ====================================================== */
/* ================= CONTAINER =========================== */
/* ====================================================== */

.why-premium-section .container{

    position:relative;

    z-index:2;
}

/* ====================================================== */
/* ================= SECTION TITLE ======================= */
/* ====================================================== */

.why-section-title{

    max-width:850px;

    margin:0 auto 80px auto;
}

.why-badge{

    display:inline-block;

    padding:10px 24px;

    border-radius:50px;

    background:
    rgba(255,255,255,0.08);

    border:
    1px solid rgba(255,255,255,0.08);

    color:#38bdf8;

    font-size:14px;

    font-weight:600;

    margin-bottom:22px;
}

.why-heading{

    font-size:62px;

    font-weight:800;

    line-height:1.15;

    color:#fff;

    margin-bottom:22px;

    letter-spacing:-2px;
}

.why-heading span{

    background:
    linear-gradient(45deg,
    #38bdf8,
    #6366f1);

    -webkit-background-clip:text;
    background-clip:text;

    -webkit-text-fill-color:transparent;

    color:transparent;
}

.why-text-main{

    color:#94a3b8;

    font-size:17px;

    line-height:1.9;
}

/* ====================================================== */
/* ================= GRID =============================== */
/* ====================================================== */

.why-grid{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:24px;
}

/* ====================================================== */
/* ================= FEATURE BOX ========================= */
/* ====================================================== */

.why-box{

    position:relative;

    overflow:hidden;

    padding:28px;

    border-radius:28px;

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    transition:0.45s ease;

    box-shadow:
    0 10px 35px rgba(0,0,0,0.22);
}

.why-box:hover{

    transform:
    translateY(-10px);

    border-color:
    rgba(56,189,248,0.35);

    box-shadow:
    0 25px 45px rgba(0,0,0,0.35);
}

/* TOP BORDER */

.why-box::before{

    content:'';

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:4px;

    background:
    linear-gradient(90deg,
    #38bdf8,
    #6366f1);

    transform:scaleX(0);

    transform-origin:left;

    transition:0.45s ease;
}

.why-box:hover::before{

    transform:scaleX(1);
}

/* ====================================================== */
/* ================= ICON =============================== */
/* ====================================================== */

.why-box-icon{

    width:68px;
    height:68px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:20px;

    margin-bottom:20px;

    background:
    linear-gradient(135deg,
    #0ea5e9,
    #6366f1);

    box-shadow:
    0 12px 25px rgba(14,165,233,0.35);
}

.why-box-icon i{

    color:#fff;

    font-size:26px;
}

/* ====================================================== */
/* ================= CONTENT ============================ */
/* ====================================================== */

.why-box-content h4{

    color:#fff;

    font-size:22px;

    font-weight:700;

    margin-bottom:10px;
}

.why-box-content p{

    color:#cbd5e1;

    font-size:14px;

    line-height:1.8;

    margin-bottom:0;
}

/* ====================================================== */
/* ================= IMAGE SIDE ========================= */
/* ====================================================== */

.why-image-area{

    position:relative;
}

.main-image-card{

    overflow:hidden;

    border-radius:34px;

    box-shadow:
    0 25px 55px rgba(0,0,0,0.4);
}

.main-image-card img{

    width:100%;

    height:760px;

    object-fit:cover;

    transition:0.6s ease;
}

.main-image-card:hover img{

    transform:scale(1.08);
}

/* ====================================================== */
/* ================= FLOAT CARDS ======================== */
/* ====================================================== */

.stats-card{

    position:absolute;

    padding:18px 26px;

    border-radius:24px;

    background:
    rgba(255,255,255,0.08);

    border:
    1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    text-align:center;

    animation:floatCard 4s ease-in-out infinite;

    box-shadow:
    0 15px 30px rgba(0,0,0,0.25);
}

.stats-card h3{

    color:#fff;

    font-size:32px;

    font-weight:800;

    margin-bottom:4px;
}

.stats-card p{

    color:#cbd5e1;

    font-size:14px;

    margin-bottom:0;
}

/* POSITION */

.stats-card-1{

    top:40px;
    left:-35px;
}

.stats-card-2{

    top:50%;
    right:-35px;

    transform:translateY(-50%);
}

.stats-card-3{

    bottom:40px;
    left:40px;
}

/* FLOAT ANIMATION */

@keyframes floatCard{

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-12px);
    }

    100%{
        transform:translateY(0);
    }

}

/* ====================================================== */
/* ================= LIGHT MODE ========================= */
/* ====================================================== */

body.light-mode .why-premium-section{

    background:
    linear-gradient(180deg,
    #f8fafc,
    #eef4ff,
    #ffffff);
}

body.light-mode .why-badge{

    background:#ffffff;

    border:1px solid #dbeafe;

    color:#2563eb;

    box-shadow:
    0 5px 15px rgba(0,0,0,0.05);
}

body.light-mode .why-heading{
    color:#0f172a;
}

body.light-mode .why-text-main{
    color:#475569;
}

body.light-mode .why-box{

    background:#ffffff;

    border:1px solid #e2e8f0;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.06);
}

body.light-mode .why-box-content h4{
    color:#0f172a;
}

body.light-mode .why-box-content p{
    color:#64748b;
}

body.light-mode .stats-card{

    background:#ffffff;

    border:1px solid #e2e8f0;

    box-shadow:
    0 12px 25px rgba(0,0,0,0.08);
}

body.light-mode .stats-card h3{
    color:#0f172a;
}

body.light-mode .stats-card p{
    color:#64748b;
}

/* ====================================================== */
/* ================= RESPONSIVE ========================= */
/* ====================================================== */

@media(max-width:1200px){

    .why-heading{
        font-size:54px;
    }

}

@media(max-width:991px){

    .why-premium-section{
        padding:100px 0;
    }

    .why-heading{
        font-size:44px;
    }

    .why-grid{
        grid-template-columns:1fr;
    }

    .main-image-card img{
        height:550px;
    }

    .stats-card-1{
        left:20px;
    }

    .stats-card-2{
        right:20px;
    }

    .stats-card-3{
        left:20px;
    }

}

@media(max-width:576px){

    .why-premium-section{
        padding:80px 0;
    }

    .why-section-title{
        margin-bottom:50px;
    }

    .why-heading{

        font-size:34px;

        line-height:1.35;
    }

    .why-text-main{
        font-size:15px;
    }

    .why-box{
        padding:22px;
    }

    .why-box-icon{

        width:60px;
        height:60px;
    }

    .why-box-icon i{
        font-size:22px;
    }

    .why-box-content h4{
        font-size:18px;
    }

    .why-box-content p{
        font-size:13px;
    }

    .main-image-card img{
        height:420px;
    }

    .stats-card{

        padding:14px 18px;
    }

    .stats-card h3{
        font-size:22px;
    }

    .stats-card p{
        font-size:12px;
    }

}

</style>

<!-- ====================================================== -->
<!-- ================= AOS ANIMATION ====================== -->
<!-- ====================================================== -->

<link rel="stylesheet"
href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({

    duration:1200,
    once:true

});

</script>
<!------------------------------------------------------------------------------>
<?php
include("dbconnect.php");

$logos = mysqli_query($connect,"SELECT * FROM logodb ORDER BY id DESC");
?>
<!-- ================= CLIENT SECTION ================= -->
<style>
    /* ================= DARK MODE ================= */

.clients-section{
    position:relative;
    overflow:hidden;
    padding:110px 0;

    background:
    linear-gradient(135deg,#020617,#07152f,#0f172a);
}

/* ================= TITLE ================= */

.client-mini-title{

    display:inline-block;

    padding:10px 24px;

    border-radius:50px;

    background:rgba(255,255,255,0.08);

    border:1px solid rgba(255,255,255,0.08);

    color:#38bdf8;

    font-size:14px;

    font-weight:600;

    margin-bottom:20px;
}

.client-main-title{

    font-size:60px;

    font-weight:800;

    color:white;

    margin-bottom:15px;

    letter-spacing:-2px;
}

.client-main-title span{

    background:
    linear-gradient(45deg,#0d6efd,#38bdf8);

    -webkit-background-clip:text;
    background-clip:text;

    -webkit-text-fill-color:transparent;

    color:transparent;
}

.client-description{

    color:#94a3b8;

    max-width:650px;

    margin:auto;

    line-height:1.8;

    font-size:17px;
}

/* ================= LOGO SLIDER ================= */

.logo-slider{

    position:relative;

    overflow:hidden;

    width:100%;

    margin-top:70px;

    padding:15px 0;
}

/* SIDE FADE */

.logo-slider::before,
.logo-slider::after{

    content:'';

    position:absolute;

    top:0;

    width:120px;
    height:100%;

    z-index:2;
}

.logo-slider::before{

    left:0;

    background:
    linear-gradient(to right,
    #07152f,
    transparent);
}

.logo-slider::after{

    right:0;

    background:
    linear-gradient(to left,
    #07152f,
    transparent);
}

/* ================= TRACK ================= */

.logo-track{

    display:flex;
    align-items:center;

    gap:30px;

    width:max-content;

    animation:scrollLogo 28s linear infinite;
}

/* ================= CARD ================= */

.logo-card{

    width:200px;
    height:200px;

    flex-shrink:0;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:20px;

    border-radius:24px;

    background:#ffffff;

    transition:0.4s ease;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.18);
}

/* ================= IMAGE ================= */

.logo-card img{

    width:100%;
    height:100%;

    object-fit:contain;

    transition:0.4s ease;
}

/* ================= HOVER ================= */

.logo-card:hover{

    transform:
    translateY(-10px)
    scale(1.05);

    box-shadow:
    0 20px 40px rgba(13,110,253,0.25);
}

.logo-card:hover img{

    transform:scale(1.08);
}

/* ================= AUTO SCROLL ================= */

@keyframes scrollLogo{

    from{
        transform:translateX(0);
    }

    to{
        transform:translateX(-50%);
    }

}

/* ================= PAUSE ON HOVER ================= */

.logo-slider:hover .logo-track{
    animation-play-state:paused;
}

/* ================================================= */
/* ================= LIGHT MODE ==================== */
/* ================================================= */

body.light-mode .clients-section{

    background:
    linear-gradient(180deg,
    #f8fafc,
    #eef4ff,
    #ffffff);
}

body.light-mode .client-main-title{
    color:#0f172a;
}

body.light-mode .client-description{
    color:#475569;
}

body.light-mode .client-mini-title{

    background:#ffffff;

    border:1px solid #dbeafe;

    color:#0d6efd;

    box-shadow:
    0 5px 15px rgba(0,0,0,0.05);
}

body.light-mode .logo-slider::before{

    background:
    linear-gradient(to right,
    #ffffff,
    transparent);
}

body.light-mode .logo-slider::after{

    background:
    linear-gradient(to left,
    #ffffff,
    transparent);
}

body.light-mode .logo-card{

    background:#ffffff;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.08);
}

/* ================= TABLET ================= */

@media(max-width:991px){

    .clients-section{
        padding:90px 0;
    }

    .client-main-title{
        font-size:46px;
    }

    .logo-card{

        width:180px;
        height:120px;
    }

}

/* ================= MOBILE ================= */

@media(max-width:576px){

    .clients-section{
        padding:80px 0;
    }

    .client-main-title{
        font-size:34px;
    }

    .client-description{
        font-size:15px;
    }

    .logo-track{
        gap:18px;
    }

    .logo-card{

        width:150px;
        height:150px;

        padding:12px;

        border-radius:18px;
    }

    .logo-slider::before,
    .logo-slider::after{

        width:60px;
    }

}
</style>
<section class="clients-section section-padding"
         id="clients">

    <div class="container">

        <!-- SECTION TITLE -->

        <div class="section-title text-center mb-5">

            <span class="client-mini-title">
                Trusted By Brands
            </span>

            <h2 class="client-main-title">

                Our <span>Clients</span>

            </h2>

            <p class="client-description">

                We proudly collaborate with innovative brands
                across multiple industries.

            </p>

        </div>

        <!-- LOGO SLIDER -->

       <div class="logo-slider">

    <div class="logo-track">

        <?php
        while($row = mysqli_fetch_assoc($logos))
        {
        ?>
            <div class="logo-card">
                <img src="logouploads/<?php echo $row['logoimage']; ?>"
                     alt="<?php echo $row['logoname']; ?>">
            </div>
        <?php
        }
        ?>

        <!-- Duplicate logos for smooth infinite scroll -->

        <?php

        $logos2 = mysqli_query($connect,"SELECT * FROM logodb ORDER BY id DESC");

        while($row = mysqli_fetch_assoc($logos2))
        {
        ?>

            <div class="logo-card">
                <img src="logouploads/<?php echo $row['logoimage']; ?>"
                     alt="<?php echo $row['logoname']; ?>">
            </div>

        <?php
        }
        ?>

    </div>

</div>

    </div>

</section>

<!------------------------------------------------------------------------------->
<!-- ====================================================== -->
<!-- ================= FOUNDER SECTION ==================== -->
<!-- ====================================================== -->

<section class="founder-section section-padding" id="founder">

    <!-- BACKGROUND EFFECTS -->

    <div class="founder-bg founder-bg-1"></div>
    <div class="founder-bg founder-bg-2"></div>

    <div class="container">

        <!-- ================================================= -->
        <!-- SECTION TITLE -->
        <!-- ================================================= -->

        <div class="founder-title text-center"
             data-aos="fade-up">

            <span class="founder-mini-title">
                Leadership Team
            </span>

            <h2 class="founder-main-title">

                Meet The
                <span>Founder</span>

            </h2>

            <p class="founder-description">

                Passionate creators building premium digital experiences,
                cinematic branding and performance-driven marketing
                strategies for modern businesses.

            </p>

        </div>

        <!-- ================================================= -->
        <!-- FOUNDER CARDS -->
        <!-- ================================================= -->

        <div class="row g-4 justify-content-center mt-5">

            <!-- ================================================= -->
            <!-- FOUNDER -->
            <!-- ================================================= -->

            <div class="col-lg-5 col-md-6"
                 data-aos="fade-right">

                <div class="founder-card">

                    <!-- IMAGE -->

                    <div class="founder-image">

                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1200&auto=format&fit=crop"
                             alt="Founder">

                        <div class="founder-overlay"></div>

                    </div>

                    <!-- CONTENT -->

                    <div class="founder-content">

                        <span class="founder-role">
                            Founder
                        </span>

                        <h3 class="founder-name">
                            Mithran
                        </h3>

                        <p class="founder-text">

                            Hi, I’m Mithran — Founder of
                            <strong>AlphaCrest Digital.</strong>

                        </p>

                        <p class="founder-desc">

                            What started as a small idea in Trichy has now
                            grown into helping 20+ brands build their digital
                            presence through creative strategy, cinematic
                            content and performance-driven marketing.

                        </p>

                        <!-- SOCIAL -->

                        <div class="founder-social">

                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>

                            <a href="#">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>

                            <a href="#">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ================================================= -->
            <!-- CO-FOUNDER -->
            <!-- ================================================= -->

            <div class="col-lg-5 col-md-6"
                 data-aos="fade-left">

                <div class="founder-card cofounder-card">

                    <!-- IMAGE -->

                    <div class="founder-image">

                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1200&auto=format&fit=crop"
                             alt="Co Founder">

                        <div class="founder-overlay"></div>

                    </div>

                    <!-- CONTENT -->

                    <div class="founder-content">

                        <span class="founder-role co-role">
                            Co-Founder
                        </span>

                        <h3 class="founder-name">
                            Your Name
                        </h3>

                        <p class="founder-text">

                            Creative strategist focused on building
                            impactful digital experiences.

                        </p>

                        <p class="founder-desc">

                            From branding concepts to campaign execution,
                            our mission is to help businesses stand out
                            with modern visuals, storytelling and
                            growth-focused marketing solutions.

                        </p>

                        <!-- SOCIAL -->

                        <div class="founder-social">

                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>

                            <a href="#">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>

                            <a href="#">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ====================================================== -->
<!-- ======================= CSS ========================== -->
<!-- ====================================================== -->

<style>

/* ====================================================== */
/* ================= MAIN SECTION ======================== */
/* ====================================================== */

.founder-section{

    position:relative;

    overflow:hidden;

    padding:120px 0;

    background:
    linear-gradient(135deg,
    #020617 0%,
    #07152f 40%,
    #0f172a 100%);
}

/* ====================================================== */
/* ================= BACKGROUND EFFECT =================== */
/* ====================================================== */

.founder-bg{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    opacity:0.22;

    z-index:0;
}

.founder-bg-1{

    width:320px;
    height:320px;

    background:#0ea5e9;

    top:-100px;
    left:-80px;
}

.founder-bg-2{

    width:350px;
    height:350px;

    background:#6366f1;

    bottom:-120px;
    right:-100px;
}

.founder-section .container{

    position:relative;

    z-index:2;
}

/* ====================================================== */
/* ================= TITLE =============================== */
/* ====================================================== */

.founder-title{

    max-width:850px;

    margin:auto;
}

.founder-mini-title{

    display:inline-block;

    padding:10px 22px;

    border-radius:50px;

    background:
    rgba(255,255,255,0.08);

    border:
    1px solid rgba(255,255,255,0.08);

    color:#38bdf8;

    font-size:14px;

    font-weight:600;

    margin-bottom:20px;
}

.founder-main-title{

    font-size:62px;

    font-weight:800;

    color:#fff;

    margin-bottom:20px;

    letter-spacing:-2px;
}

.founder-main-title span{

    background:
    linear-gradient(45deg,#38bdf8,#6366f1);

    -webkit-background-clip:text;
    background-clip:text;

    -webkit-text-fill-color:transparent;

    color:transparent;
}

.founder-description{

    color:#94a3b8;

    font-size:17px;

    line-height:1.9;
}

/* ====================================================== */
/* ================= CARD ================================ */
/* ====================================================== */

.founder-card{

    position:relative;

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    transition:0.5s ease;

    height:100%;

    box-shadow:
    0 15px 40px rgba(0,0,0,0.28);
}

/* HOVER */

.founder-card:hover{

    transform:
    translateY(-12px);

    border-color:
    rgba(56,189,248,0.35);

    box-shadow:
    0 30px 55px rgba(0,0,0,0.4);
}

/* ====================================================== */
/* ================= IMAGE =============================== */
/* ====================================================== */

.founder-image{

    position:relative;

    overflow:hidden;
}

.founder-image img{

    width:100%;

    height:420px;

    object-fit:cover;

    transition:0.6s ease;
}

.founder-card:hover .founder-image img{

    transform:scale(1.08);
}

/* OVERLAY */

.founder-overlay{

    position:absolute;

    inset:0;

    background:
    linear-gradient(to top,
    rgba(2,6,23,0.9),
    rgba(2,6,23,0.1));
}

/* ====================================================== */
/* ================= CONTENT ============================= */
/* ====================================================== */

.founder-content{

    padding:35px;
}

/* ROLE */

.founder-role{

    display:inline-block;

    padding:8px 18px;

    border-radius:50px;

    background:
    rgba(56,189,248,0.15);

    border:
    1px solid rgba(56,189,248,0.2);

    color:#38bdf8;

    font-size:13px;

    font-weight:600;

    margin-bottom:18px;
}

.co-role{

    color:#818cf8;

    background:
    rgba(99,102,241,0.15);

    border:
    1px solid rgba(99,102,241,0.2);
}

/* NAME */

.founder-name{

    color:#fff;

    font-size:34px;

    font-weight:800;

    margin-bottom:14px;
}

/* TEXT */

.founder-text{

    color:#e2e8f0;

    font-size:17px;

    line-height:1.8;

    margin-bottom:16px;
}

.founder-desc{

    color:#94a3b8;

    font-size:15px;

    line-height:1.9;

    margin-bottom:24px;
}

/* ====================================================== */
/* ================= SOCIAL ============================== */
/* ====================================================== */

.founder-social{

    display:flex;

    align-items:center;

    gap:14px;
}

.founder-social a{

    width:46px;
    height:46px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    background:
    rgba(255,255,255,0.08);

    border:
    1px solid rgba(255,255,255,0.08);

    color:#fff;

    text-decoration:none;

    transition:0.4s ease;
}

.founder-social a:hover{

    transform:
    translateY(-5px);

    background:
    linear-gradient(135deg,
    #38bdf8,
    #6366f1);

    border-color:transparent;
}

/* ====================================================== */
/* ================= LIGHT MODE ========================== */
/* ====================================================== */

body.light-mode .founder-section{

    background:
    linear-gradient(180deg,
    #f8fafc,
    #eef4ff,
    #ffffff);
}

body.light-mode .founder-mini-title{

    background:#ffffff;

    border:1px solid #dbeafe;

    color:#2563eb;

    box-shadow:
    0 5px 15px rgba(0,0,0,0.05);
}

body.light-mode .founder-main-title{
    color:#0f172a;
}

body.light-mode .founder-description{
    color:#475569;
}

body.light-mode .founder-card{

    background:#ffffff;

    border:1px solid #e2e8f0;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.08);
}

body.light-mode .founder-name{
    color:#0f172a;
}

body.light-mode .founder-text{
    color:#334155;
}

body.light-mode .founder-desc{
    color:#64748b;
}

body.light-mode .founder-social a{

    background:#ffffff;

    border:1px solid #e2e8f0;

    color:#0f172a;
}

/* ====================================================== */
/* ================= RESPONSIVE ========================== */
/* ====================================================== */

@media(max-width:991px){

    .founder-section{
        padding:100px 0;
    }

    .founder-main-title{
        font-size:48px;
    }

    .founder-image img{
        height:360px;
    }

}

@media(max-width:576px){

    .founder-section{
        padding:80px 0;
    }

    .founder-main-title{

        font-size:34px;

        line-height:1.3;
    }

    .founder-description{

        font-size:15px;
    }

    .founder-content{

        padding:25px;
    }

    .founder-name{

        font-size:28px;
    }

    .founder-text{

        font-size:15px;
    }

    .founder-desc{

        font-size:14px;
    }

    .founder-image img{

        height:300px;
    }

}

</style>

<!-- ====================================================== -->
<!-- ================= AOS ANIMATION ====================== -->
<!-- ====================================================== -->

<link rel="stylesheet"
href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({

    duration:1200,
    once:true

});

</script>

<!--------------------------------Contact------------------------------------------------>




<!-- ✅ All your HTML starts here, AFTER the closing ?> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-------------------------------- Contact Section -------------------------------->
<section class="contact-section" id="contact">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2>Let's <span>Connect</span></h2>
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Left: Contact Form -->
            <div class="col-lg-6">
                <div class="contact-box">

                    <form method="POST" id="contactForm">
                        <input type="hidden" name="send" value="1">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <input type="text" name="name" id="name"
                                    class="form-control"
                                    placeholder="Your Name" required>
                            </div>

                            <div class="col-md-6">
                                <select name="country" id="country"
                                    class="form-control" required>
                                    <option value="" disabled selected>Select Country</option>
                                    <option>India</option>
                                    <option>USA</option>
                                    <option>UK</option>
                                    <option>UAE</option>
                                    <option>Singapore</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="phone-group">
                                    <select name="countryCode" id="countryCode"
                                        class="country-code" required>
                                        <option>+91</option>
                                        <option>+1</option>
                                        <option>+44</option>
                                        <option>+971</option>
                                    </select>

                                    <input type="tel" name="mobile" id="phone"
                                        class="form-control"
                                        placeholder="Mobile No." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" id="email"
                                    class="form-control"
                                    placeholder="Email Address" required>
                            </div>

                            <div class="col-12">
                                <select name="service" id="service"
                                    class="form-control" required>
                                    <option value="" disabled selected>Select Service</option>
                                    <option>Social Media Marketing</option>
                                    <option>Branding</option>
                                    <option>Content Creation</option>
                                    <option>Meta Ads</option>
                                    <option>Web Devlopment</option>
                                    <option>Video Production</option>
                                      <option>AI Storytelling Videos</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <textarea name="message" id="message"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Your Message" required></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <input type="submit" value="Send" id="sendBtn" class="btn-custom">
                            </div>
                            

                        </div>
                    </form>

                </div>
            </div>

            <!-- Right: Google Map -->
            <div class="col-lg-6">
                <div class="map-box">
                    <iframe
                        src="https://maps.google.com/maps?q=London&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0; min-height: 400px;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SweetAlert JS loaded at the bottom AFTER all HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_SESSION['form_status'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if($_SESSION['form_status'] == 'success') { ?>
    Swal.fire({
        icon: 'success',
        title: 'Message Sent!',
        text: 'Your message stored successfully',
        confirmButtonColor: '#06b6d4'
    });
    <?php } else { ?>
    Swal.fire({
        icon: 'error',
        title: 'Failed!',
        text: 'Database insert error',
        confirmButtonColor: '#ef4444'
    });
    <?php } ?>
});
</script>
<?php
    unset($_SESSION['form_status']); // clear after showing
}
?>

<style>
    input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield; /* Firefox */
}
/* Root Dark variables (Default) */
:root {
    --box-bg: #111827;
    --input-bg: #0f172a;
    --text-color: #ffffff;
    --border-color: rgba(255,255,255,0.08);
    --input-border: rgba(255,255,255,0.1);
    --placeholder-color: #cbd5e1;
}

/* Light mode overrides */
body.light-mode {
    --box-bg: #ffffff;
    --input-bg: #f1f5f9;
    --text-color: #111827;
    --border-color: #e5e7eb;
    --input-border: #cbd5e1;
    --placeholder-color: #64748b;
}

body {
    background-color: #0b0f19;
    transition: background-color 0.3s ease;
}
body.light-mode {
    background-color: #f8fafc;
}

.contact-section{
    padding:80px 0;
}

/* BOX */
.contact-box{
    background: var(--box-bg);
    padding:30px;
    border-radius:20px;
    border:1px solid var(--border-color);
    transition: background 0.3s ease, border 0.3s ease;
}

/* TITLE */
.section-title h2{
    color: var(--text-color);
    font-size:28px;
    margin-bottom:20px;
}

.section-title span{
    color:#06b6d4;
}

/* INPUT */
.form-control, 
.country-code,
select.form-control,
textarea.form-control {
    width:100%;
    padding:12px;
    margin-bottom:12px;
    border-radius:12px;
    background: var(--input-bg) !important;
    color: var(--text-color) !important;
    border: 1px solid var(--input-border) !important;
    outline:none;
    transition: all 0.3s ease;
}

.form-control::placeholder, 
textarea.form-control::placeholder {
    color: var(--placeholder-color) !important;
}

/* DROPDOWN ARROW FIX */
select.form-control,
.country-code{
    appearance: auto !important;
}

/* PHONE GROUP */
.phone-group{
    display:flex;
    gap:10px;
}

.country-code{
    width:100px;
    flex-shrink: 0;
}

/* BUTTON */
.btn-custom{
    width:100%;
    padding:12px;
    border:none;
    border-radius:50px;
    background:linear-gradient(135deg,#06b6d4,#6366f1);
    color:#fff;
    font-weight:600;
    cursor:pointer;
    transition: transform 0.2s;
}

.btn-custom:hover {
    transform: scale(1.01);
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.4);
}

/* MAP */
.map-box{
    width:100%;
    height:100%;
    min-height:520px;
    border-radius:20px;
    overflow:hidden;
    border:1px solid var(--border-color);
}

.map-box iframe{
    width:100%;
    height:100%;
    border:0;
}

/* RESPONSIVE */
@media(max-width:991px){
    .map-box{
        min-height:350px;
        margin-top: 20px;
    }
}

@media(max-width:576px){
    .phone-group{
        flex-direction: row; /* Mobile size screen-il select code line break aagama correct position-la iruka flex box optimization */
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if($success == "true"): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Your message has been sent.',
        confirmButtonColor: '#06b6d4'
    });
<?php elseif(!empty($error)): ?>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '<?php echo $error; ?>',
        confirmButtonColor: '#6366f1'
    });
<?php endif; ?>
</script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("contactForm").addEventListener("submit", function(e){

    e.preventDefault();

    let name = document.getElementById("name").value.trim();
    let country = document.getElementById("country").value;
    let code = document.getElementById("countryCode").value;
    let phone = document.getElementById("phone").value.trim();
    let email = document.getElementById("email").value.trim();
    let service = document.getElementById("service").value;
    let message = document.getElementById("message").value.trim();

    let phoneRegex = /^[0-9]{10,15}$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // NAME
    if(name.length < 3){
        Swal.fire("Error","Name must be at least 3 characters","error");
        return;
    }

    // COUNTRY
    if(country === ""){
        Swal.fire("Error","Select your country","warning");
        return;
    }

    // PHONE
    if(!phoneRegex.test(phone)){
        Swal.fire("Error","Enter valid phone (10–15 digits)","error");
        return;
    }

    // EMAIL
    if(!emailRegex.test(email)){
        Swal.fire("Error","Enter valid email","error");
        return;
    }

    // SERVICE
    if(service === ""){
        Swal.fire("Error","Select service","warning");
        return;
    }

    // MESSAGE
    if(message.length < 10){
        Swal.fire("Error","Message must be minimum 10 characters","warning");
        return;
    }

    // SUCCESS
    Swal.fire({
        icon:'success',
        title:'Message Ready!',
        text:'Form validated successfully',
        confirmButtonColor:'#06b6d4'
    });

    // OPTIONAL: submit after success
    this.submit();

});
</script>
<script>
function toggleTheme(){
    document.body.classList.toggle("light-mode");
}
</script>

<!---------------------------------------------------------------------------->

<!-- ================= FOOTER ================= -->

<footer class="footer">

  <div class="container">

    <div class="row g-4">

      <!-- BRAND -->
      <div class="col-lg-4 col-md-6">

        <div class="footer-brand">

          <!-- LIGHT / DARK LOGO -->
          <img src="static/image/AC.png"
               class="footer-logo light-logo"
               alt="AlphaCrest Logo">

          <img src="static/image/AC 1.png"
               class="footer-logo dark-logo"
               alt="AlphaCrest Logo">

          <p>
           Think Different. Market Better.

          </p>

        </div>

      </div>

      <!-- CONTACT -->
      <div class="col-lg-4 col-md-6">

        <div class="footer-box">

          <h4>Contact Info</h4>

          <p><i class="fas fa-map-marker-alt"></i> 38/B Vadavoor Middle Street Thillainagar Trichy</p>
          <p><i class="fas fa-phone"></i> +91 7397073151</p>
          <p><i class="fas fa-envelope"></i> contact@alphacrest.com</p>
          <p><i class="fas fa-globe"></i> www.alphacrestdigital.in</p>

        </div>

      </div>

      <!-- LINKS -->
      <div class="col-lg-2 col-md-6">

        <div class="footer-box">

          <h4>Quick Links</h4>

          <a href="#home">Home</a>
          <a href="#about">About</a>
           <a href="#services">Services</a>
          <a href="#portfolio">portfolio</a>
          <a href="#clients">Clients</a>
          <a href="#contact">Contact</a>

        </div>

      </div>

      <!-- SOCIAL -->
      <div class="col-lg-2 col-md-6">

        <div class="footer-box">

          <h4>Follow Us</h4>

          <div class="social-icons">

            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/alphacrestdigital.in/"
   target="_blank">

   <i class="fab fa-instagram"></i>

</a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>

          </div>

        </div>

      </div>

    </div>

    <div class="footer-bottom text-center mt-5">

      <p>© <script>document.write(new Date().getFullYear());</script> AlphaCrest Digital. All Rights Reserved.</p>

    </div>

  </div>

</footer>

<!-- ================= CSS ================= -->

<style>

/* DEFAULT = DARK MODE */
body{
    background:#0b1220;
    color:#cbd5e1;
}

/* FOOTER */
.footer{
    background:#0b1220;
    padding:70px 0 20px;
    transition:0.4s ease;
}

/* LIGHT MODE */
body.light-mode .footer{
    background:#ffffff;
    color:#1f2937;
}

.footer h4{
    color:inherit;
    font-size:18px;
    margin-bottom:18px;
}

.footer p, .footer a{
    color:#94a3b8;
}

body.light-mode .footer p,
body.light-mode .footer a{
    color:#4b5563;
}

/* LOGO SWITCH */
.footer-logo{
    width:160px;
    margin-bottom:15px;
}

.dark-logo{
    display:block;
}

.light-logo{
    display:none;
}

body.light-mode .dark-logo{
    display:none;
}

body.light-mode .light-logo{
    display:block;
}

/* LINKS */
.footer-box a{
    display:block;
    text-decoration:none;
    margin:6px 0;
    transition:0.3s;
}

.footer-box a:hover{
    color:#38bdf8;
    transform:translateX(5px);
}

/* SOCIAL */
.social-icons a{
    display:inline-flex;
    width:40px;
    height:40px;
    background:#111827;
    color:#fff;
    border-radius:50%;
    align-items:center;
    justify-content:center;
    margin-right:8px;
    transition:0.3s;
}

body.light-mode .social-icons a{
    background:#e5e7eb;
    color:#111;
}

.social-icons a:hover{
    background:#38bdf8;
    color:#000;
    transform:translateY(-4px);
}

/* FOOTER BOTTOM */
.footer-bottom{
    border-top:1px solid rgba(255,255,255,0.08);
    padding-top:20px;
}

body.light-mode .footer-bottom{
    border-top:1px solid #e5e7eb;
}

</style>

<!-- ================= THEME TOGGLE SCRIPT ================= -->

<script>
function toggleTheme(){
    document.body.classList.toggle("light-mode");
}
</script>

<!------------------------------float---------------------->
<!-- ====================================================== -->
<!-- =============== FLOATING BUTTONS ===================== -->
<!-- ====================================================== -->

<!-- LEFT SIDE BUTTONS -->
<div class="floating-left">

    
</div>

<!-- RIGHT SIDE BUTTONS -->
<div class="floating-right">

    

    <!-- SCROLL TOP -->
    <button id="scrollTopBtn"
            class="floating-btn scroll-top-btn">

        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- WHATSAPP -->
    <a href="https://wa.me/7397073151"
       target="_blank"
       class="floating-btn whatsapp-btn">

        <i class="fab fa-whatsapp"></i>
    </a>
    <!-- INSTAGRAM -->
    <a href="https://www.instagram.com/alphacrestdigital.in/"
       target="_blank"
       class="floating-btn insta-btn">

        <i class="fa-brands fa-instagram"></i>
    </a>

    <!-- CONTACT -->
    <a href="#contact"
       class="floating-btn contact-btn">

        <i class="fa-solid fa-envelope"></i>
    </a>


</div>

<!-- ====================================================== -->
<!-- ======================= CSS ========================== -->
<!-- ====================================================== -->

<style>

/* COMMON BUTTON STYLE */
.floating-btn{

    width:58px;
    height:58px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;
    border:none;

    text-decoration:none;
    cursor:pointer;

    font-size:22px;
    color:#fff;

    position:fixed;
    z-index:9999;

    backdrop-filter:blur(12px);

    box-shadow:0 10px 30px rgba(0,0,0,0.25);

    transition:0.4s ease;

    animation:floatBtn 3s ease-in-out infinite;
}

/* HOVER */
.floating-btn:hover{
    transform:translateY(-8px) scale(1.08);
}

/* ================= LEFT SIDE ================= */
.floating-left{
    position:fixed;
    left:25px;
    bottom:25px;
    display:flex;
    flex-direction:column;
    gap:12px;
    z-index:9999;
}

/* INSTAGRAM */
.insta-btn{
    position:relative;
    background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);
}

/* CONTACT */
.contact-btn{
    position:relative;
    background:linear-gradient(135deg,#0ea5e9,#6366f1);
}

/* ================= RIGHT SIDE ================= */
.floating-right{
    position:fixed;
    right:25px;
    bottom:25px;
    display:flex;
    flex-direction:column;
    gap:12px;
    z-index:9999;
}

/* WHATSAPP */
.whatsapp-btn{
    position:relative;
    background:linear-gradient(135deg,#25D366,#128C7E);
}

/* SCROLL TOP */
.scroll-top-btn{
    position:relative;
    background:linear-gradient(135deg,#f97316,#ef4444);

    opacity:0;
    visibility:hidden;
    transform:translateY(20px);
}

/* SHOW SCROLL BUTTON */
.scroll-top-btn.show{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

/* FLOAT ANIMATION */
@keyframes floatBtn{
    0%{transform:translateY(0);}
    50%{transform:translateY(-8px);}
    100%{transform:translateY(0);}
}

/* LIGHT MODE */
body.light-mode .floating-btn{
    box-shadow:0 12px 25px rgba(0,0,0,0.12);
}

/* MOBILE */
@media(max-width:576px){

    .floating-btn{
        width:52px;
        height:52px;
        font-size:20px;
    }

    .floating-left{
        left:15px;
        bottom:15px;
    }

    .floating-right{
        right:15px;
        bottom:15px;
    }
}

</style>

<!-- ====================================================== -->
<!-- ==================== SCRIPT ========================== -->
<!-- ====================================================== -->

<script>

/* SCROLL BUTTON */
const scrollTopBtn =
document.getElementById("scrollTopBtn");

window.addEventListener("scroll", function(){

    if(window.scrollY > 300){
        scrollTopBtn.classList.add("show");
    } else {
        scrollTopBtn.classList.remove("show");
    }

});

/* SCROLL TO TOP */
scrollTopBtn.addEventListener("click", function(){

    window.scrollTo({
        top:0,
        behavior:"smooth"
    });

});

</script>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<!-- JS -->
<script src="js/script.js"></script>

<script>
const scriptURL = "https://script.google.com/macros/s/AKfycbxuG6Yj_81Khceoh1fDpmmt8O44uJTbn5jW0rzOHfiXjCSuHdF288cmmgXrwx26z_n5/exec";

const form = document.getElementById("contactForm");

form.addEventListener("submit", e => {
  e.preventDefault();

  const data = {
    name: form.querySelector('[placeholder="Your Name"]').value,
    phone: form.querySelector('[placeholder="Phone Number"]').value,
    email: form.querySelector('[placeholder="Email Address"]').value,
    service: form.querySelector('[placeholder="Service Needed"]').value,
    message: form.querySelector('textarea').value
  };

  fetch(scriptURL, {
    method: "POST",
    body: JSON.stringify(data)
  })
  .then(() => {
    alert("Message sent successfully!");
    form.reset();
  })
  .catch(() => {
    alert("Error sending message!");
  });

});
document.querySelector("form").addEventListener("submit", function(){
    document.getElementById("sendBtn").disabled = true;
});
</script>
<!----mouse pointer---->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
