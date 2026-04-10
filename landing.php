<?php
require_once 'includes/db.php';
$pageTitle = "Discover Your Next Adventure - BonVoyage";
$extraCSS = ['landing.css'];
include 'includes/header.php';
?>

<!-- Hero Section -->
<section id="R1" class="section R1">
  <div class="container hero-container">
    <div class="row gy-4 align-items-center">
      <div class="col-lg-6 order-2 order-lg-1 hero-content" data-aos="fade-up">
        <h1 class="hero-title">Discover Your Next Adventure with BonVoyage!</h1>
        <p class="hero-subtitle">Explore amazing trips tailored just for you and your group.</p>
        <div class="hero-actions">
          <a href="itineraries.php" class="btn-join-trip">Join a Trip Now!</a>
        </div>
        <div class="social-proof" data-aos="fade-up" data-aos-delay="200">
          <p class="proof-text">Join thousands of satisfied travelers who love BonVoyage!</p>
          <div class="profile-card">
            <img src="assets/img/clients/girl-formal.jpg" alt="Milly Kuschla" class="prof-img">
            <div class="profile-meta">
              <span class="name">Milly Kuschla</span>
              <span class="role">Adventurer & Travel Vlogger</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-visual" data-aos="zoom-out" data-aos-delay="200">
        <div class="image-mask">
          <img src="assets/img/landing-page-pic.png" class="main-hero-img" alt="Adventure">
        </div>
        <div class="circle circle-orange-1"></div>
        <div class="circle circle-orange-2"></div>
        <div class="circle circle-orange-3"></div>
        <div class="semi-circle-yellow"></div>
      </div>
    </div>
    <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
      <div class="stat-item">
        <h2>20 thousands</h2>
        <p>Explore 100+ Destinations</p>
      </div>
      <div class="stat-item">
        <h2>24 billion</h2>
        <p>Experience Trips Worth 1 Billion Smiles</p>
      </div>
      <div class="stat-item">
        <h2>99%</h2>
        <p>99% Customer Satisfaction Rate</p>
      </div>
    </div>
  </div>
</section>

<!-- Browse Trips Section -->
<section class="browse-trips" id="browse-trips">
  <div class="container-fluid px-lg-5">
    <h1 class="section-title">Browse Our Exciting Trips</h1>
    <p class="section-description">Explore Your New Adventure with BonVoyage!</p>
    <div class="trips-container swiper-container">
      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1.2,
                "spaceBetween": 20
              },
              "480": {
                "slidesPerView": 2.2,
                "spaceBetween": 30
              },
              "768": {
                "slidesPerView": 3.2,
                "spaceBetween": 30
              },
              "992": {
                "slidesPerView": 4.2,
                "spaceBetween": 30
              },
              "1200": {
                "slidesPerView": 4.5,
                "spaceBetween": 30
              }
            }
          }
        </script>
        <div class="swiper-wrapper">
          <div class="swiper-slide trip-card">
            <img src="assets/img/educational-tours.jpg" alt="Educational Tours">
            <p>Educational Tours</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/tourist-tours.jpg" alt="Tourist Tours">
            <p>Tourist Tours</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/one-day.jpg" alt="One Day Trips">
            <p>One Day Trips</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/beach1.jpg" alt="Beach getaways">
            <p>Beach getaways</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/mountain-retreats.jpg" alt="Mountain Retreats">
            <p>Mountain Retreats</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/cultural-tours.jpg" alt="Cultural Tours">
            <p>Cultural Tours</p>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</section>

<!-- Host Section -->
<section id="R3" class="section R3">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <h1 class="host-title">Be a host and earn commissions!</h1>
        <p class="publish-text">Publish curated trips and itineraries to find the perfect getaway that suits your mood!</p>
        <a href="partnership.php" class="btn-start-journey">Start Your Journey Now</a>

        <div class="host-feedback mt-5">
          <div class="rating-box">
            <div class="stars">
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <span class="rating-num">5.0</span>
            </div>
            <p class="rating-text">Gain and build a profound host reputation and earn!</p>
            <div class="host-profile">
              <img src="assets/img/clients/boy.jpg" alt="Aluh Akhibar" class="host-img">
              <div class="host-info">
                <span class="host-name">Aluh Akhibar</span>
                <span class="host-role">Indian Tourist</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="host-visual">
          <img src="assets/img/beach-vert.jpg" alt="Host an adventure" class="img-fluid rounded-4 shadow-lg">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Unique Trips Section -->
<section class="unique section" id="unique-trips">
  <div class="container-fluid px-lg-5">
    <h1 class="section-title">Choose from our diverse and unique trips!</h1>
    <div class="trips-container swiper-container">
      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1.2,
                "spaceBetween": 20
              },
              "480": {
                "slidesPerView": 2.2,
                "spaceBetween": 30
              },
              "768": {
                "slidesPerView": 3.2,
                "spaceBetween": 30
              },
              "992": {
                "slidesPerView": 4.2,
                "spaceBetween": 30
              },
              "1200": {
                "slidesPerView": 4.5,
                "spaceBetween": 30
              }
            }
          }
        </script>
        <div class="swiper-wrapper">
          <div class="swiper-slide trip-card">
            <img src="assets/img/romantic-getaways.jpg" alt="Romantic Getaways">
            <p>Romantic Getaways</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/wildlife-safaris.jpg" alt="Wildlife Safaris">
            <p>Wildlife Safaris</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/skuba-divings.jpg" alt="Skuba Diving">
            <p>Skuba Diving</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/private-tours.jpg" alt="Private Tours">
            <p>Private Tours</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/publish-your-own.jpg" alt="Host a Tour">
            <p>Host a Tour</p>
          </div>
          <div class="swiper-slide trip-card">
            <img src="assets/img/culinary-adventure.jpg" alt="Culinary Adventure">
            <p>Culinary Adventure</p>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us Section -->
<section id="why-choose-us" class="why-choose-us section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Why choose us for best tour experience?</h2>
    <p>Here in BonVoyage we offer a lot of tours that best suits your preference. Join wide variety of tours around the Philippines.</p>
  </div>

  <div class="container">
    <!-- Row 1: Curated Itineraries -->
    <div class="row gy-4 align-items-center mb-5">
      <div class="col-lg-5" data-aos="fade-right">
        <h3 class="feature-title">Various Curated Exciting Itineraries</h3>
        <p>Our tours are designed by travel experts who know the ins and outs of each destination, ensuring you experience the best sights, culture, and hidden gems. We understand that every traveler is unique. Our tours offer flexibility and customization options, allowing you to tailor your journey to your interests.</p>
      </div>
      <div class="col-lg-7" data-aos="fade-left">
        <div class="feature-visual">
          <div class="image-mask-curved">
            <img src="assets/img/itineraries-img2.png" alt="Curated Itineraries" class="img-fluid">
          </div>
          <div class="dot dot-1"></div>
          <div class="dot dot-2"></div>
          <div class="dot dot-3"></div>
        </div>
      </div>
    </div>

    <!-- Row 2: Safety and Comfort -->
    <div class="row gy-4 align-items-center mb-5">
      <div class="col-lg-7 order-2 order-lg-1" data-aos="fade-right">
        <div class="feature-visual visual-left">
          <div class="image-mask-curved mask-inverted">
            <img src="assets/img/itineraries-img.png" alt="Safety and Comfort" class="img-fluid">
          </div>
          <div class="dot dot-4"></div>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2" data-aos="fade-left">
        <h3 class="feature-title">Safety and Comfort</h3>
        <p>We prioritize your safety and comfort throughout your journey, with reliable transportation and accommodations that meet high standards. Enjoy a more intimate experience with smaller groups, allowing for better interaction, personalized attention, and a more relaxed atmosphere.</p>
      </div>
    </div>

    <!-- Row 3: Competitive Pricing -->
    <div class="row gy-4 align-items-center">
      <div class="col-lg-5" data-aos="fade-right">
        <h3 class="feature-title">Competitive Pricing and Diverse Destinations</h3>
        <p>We offer great value for your money without compromising on quality. Our transparent pricing includes all essential elements, so you can plan your budget with confidence. Whether you're looking for adventure, relaxation, or cultural immersion, we offer a wide range of destinations to suit every traveler's taste, from bustling cities to serene landscapes.</p>
      </div>
      <div class="col-lg-7" data-aos="fade-left">
        <div class="feature-visual">
          <div class="image-mask-curved">
            <img src="assets/img/itineraries-img3.png" alt="Pricing and Destinations" class="img-fluid">
          </div>
          <div class="dot dot-5"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Register/Partner Section -->
<section id="perfect-trip" class="perfect-trip section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Find the Perfect trip that best suits you!</h2>
    <p>The group of adventurous collaborators of BonVoyage who made significant contributions to the company along the way making BonVoyage as it is today.</p>
  </div>

  <div class="container">
    <div class="search-bar-wrapper mb-5" data-aos="fade-up">
      <div class="search-container">
        <input type="text" id="searchDestination" placeholder="Search destination...">
        <button class="search-btn"><i class="bi bi-search"></i></button>
      </div>
    </div>

    <div class="row gy-4">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="card-cta register-card">
          <h3>Register an Account</h3>
          <p>Join us at BonVoyage! By registering an account, you'll unlock exclusive benefits that make planning your trips easier and more enjoyable.</p>
          <div class="card-visual">
            <img src="assets/img/view-itineraries.png" alt="Registration UI" class="img-fluid">
          </div>
          <a href="registration.php" class="btn-cta">Register Now</a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="card-cta partner-card">
          <h3>Be One of Our Partners</h3>
          <p>Join us at BonVoyage! By registering an account, you'll unlock exclusive benefits that make planning your trips easier and more enjoyable.</p>
          <div class="card-visual">
            <img src="assets/img/find-tour.png" alt="Partner UI" class="img-fluid">
          </div>
          <a href="partnership.php" class="btn-cta btn-white">Apply Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="faq section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Frequently Asked Questions</h2>
    <p>At BonVoyage, our FAQs are designed to answer all your burning questions about joining trips, booking processes, and travel tips. Don't hesitate to ask your questions—your adventure starts with the right information!</p>
  </div>

  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-4" data-aos="fade-up">
        <div class="faq-cta">
          <h3>Do you have Questions in Mind?</h3>
          <p>Here, you'll find answers to common inquiries about our products, services, and policies. Whether you're looking for information on ordering, shipping, or troubleshooting, we've got you covered.</p>
          <a href="contactus.php" class="btn-ask">Ask a Question</a>

          <div class="faq-nav mt-5">
            <button class="nav-arrow prev"><i class="bi bi-chevron-left"></i></button>
            <button class="nav-arrow next"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>
      </div>

      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
        <div class="accordion accordion-flush" id="faqlist">
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                How do I register for an account?
              </button>
            </h3>
            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                Registering is easy! Just click on the 'Sign up' link in the navigation bar and fill in your details.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                What is BonVoyage?
              </button>
            </h3>
            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                BonVoyage is a comprehensive travel platform that helps you discover and join exciting trips around the Philippines.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                Is there a fee to join BonVoyage?
              </button>
            </h3>
            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                Joining the platform is free! You only pay for the trips you choose to join.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                What benefits do I get as a registered user?
              </button>
            </h3>
            <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                As a registered user, you get early access to new trips, personalized recommendations, and a streamlined booking process.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                How do I join a trip?
              </button>
            </h3>
            <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                Browse our destinations, pick a trip that interests you, and click 'Join Now'!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Explore More Section -->
<section id="menu" class="menu section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Explore More!</h2>
    <p>New adventure awaits here!</p>
  </div>
  <div class="container">
    <div class="row gy-4">
      <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="menu-item">
          <img src="assets/img/find-tour.png" alt="Find a Tour" class="img-fluid mb-3">
          <h4>Find a Tour</h4>
          <p>Explore our website and find tours that suit your trip and budget!</p>
          <a href="itineraries.php" class="learn-more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="menu-item">
          <img src="assets/img/host-tour.png" alt="Host an Exciting Trip" class="img-fluid mb-3">
          <h4>Host an Exciting Trip</h4>
          <p>Immerse yourself in our hosting program which allows you to earn incentives!</p>
          <a href="partnership.php" class="learn-more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="menu-item">
          <img src="assets/img/view-itineraries.png" alt="View Itineraries" class="img-fluid mb-3">
          <h4>View Itineraries</h4>
          <p>Find out more about affordable and time exclusive trips!</p>
          <a href="itineraries.php" class="learn-more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="menu-item">
          <img src="assets/img/join-team.png" alt="Join Our Team" class="img-fluid mb-3">
          <h4>Join Our Team</h4>
          <p>Start your career with BonVoyage! Be a professional and love your job!</p>
          <a href="contactus.php" class="learn-more-btn">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>