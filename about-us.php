<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$pageTitle = "About Us - BondVoyage";
$extraCSS = ['about-us.css', 'ageneral.css'];

include 'includes/header.php';
?>

<section class="about-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <h1 class="about-title">Discover the Heart of <span>BonVoyage</span></h1>
        <p class="about-subtitle">We believe that the best adventures are the ones shared with others. Join us in exploring the hidden gems of the Philippines.</p>
        <a href="#mission" class="btn-join-trip" style="text-decoration: none;">Know More About Us</a>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="about-visual">
          <div class="about-mask">
            <img src="assets/img/itineraries-img2.png" alt="Travel Together" class="img-fluid">
          </div>
          <div class="about-dot about-dot-1"></div>
          <div class="about-dot about-dot-2"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mission, Vision, Values -->
<section id="mission" class="mission-vision">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="mv-card">
          <div class="mv-icon"><i class='bi bi-target'></i></div>
          <h3>Our Mission</h3>
          <p>To provide seamless travel experiences for everyone by fostering a community of passionate explorers and reliable partners.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="mv-card">
          <div class="mv-icon"><i class='bi bi-eye'></i></div>
          <h3>Our Vision</h3>
          <p>To be the leading travel companion globally, connecting hearts and destinations through unforgettable shared adventures.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="mv-card">
          <div class="mv-icon"><i class='bi bi-heart-fill'></i></div>
          <h3>Our Values</h3>
          <p>Integrity, Passion, and Community are at the core of everything we do, ensuring every journey is meaningful and safe.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team-section">
  <div class="container">
    <div class="section-title text-center mb-5" data-aos="fade-up">
      <h2>Meet the Visionaries</h2>
      <p>The group of adventurous collaborators who made BonVoyage possible.</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="dev-card">
          <div class="dev-img-wrapper">
            <img src="assets/img/clients/girl-formal.jpg" alt="Developer">
          </div>
          <h4>Milly Kuschla</h4>
          <span>Lead Designer</span>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="dev-card">
          <div class="dev-img-wrapper">
            <img src="assets/img/developersImg/dev2.jpg" alt="Developer" onerror="this.src='assets/img/clients/girl-formal.jpg'">
          </div>
          <h4>John Doe</h4>
          <span>Lead Developer</span>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="dev-card">
          <div class="dev-img-wrapper">
            <img src="assets/img/developersImg/dev3.jpg" alt="Developer" onerror="this.src='assets/img/clients/girl-formal.jpg'">
          </div>
          <h4>Jane Smith</h4>
          <span>Backend Engineer</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$extraJS = ['about-us.js'];
include 'includes/footer.php';
?>