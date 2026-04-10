<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonVoyage</title>

    <!-- Website Icon -->
    <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">

    <!-- WebPage Styles -->
    <link rel="stylesheet" href="ageneral.css">
    <link rel="stylesheet" href="focusedTrip.css">

    <!-- Bootstrap Import Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Importat link of Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Boxicon imports -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

     <!-- Vendor CSS Files -->
     <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
     <link href="/vendor/aos/aos.css" rel="stylesheet">
     <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
     <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   
     <!-- Main CSS File -->
     <link href="footer.css" rel="stylesheet">

     <!-- Favicons -->
    <link href="assets/img/BondLogo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
</head>
<body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
        <a class="navbar-brand" href="#"><img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="BonVoyageLogo" class="logo-image"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-3 pt-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" aria-current="page" href="#">Destination and Itineraries</a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" aria-current="page" href="#">About Us</a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" aria-current="page" href="#">Contact</a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" aria-current="page" href="#">Partners</a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" aria-current="page" href="registration.ph">Sign up</a>
            </li>
            <li class="nav-item"></li>
                <button class="Login-btn nav-link" aria-current="page" href="login.php">Log in</button>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="main-container container">
        <section class="first-section">
            <div class="trip-title">
                Vigan’s Cultural Gems Trip
                <span><button>Report this listing</button></span>
            </div>
            <div class="trip-pictures">
                <div class="carousel-pictures">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="assets/carouselSampleImages/Vigan/1.png" class="d-block" alt="vigan">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/carouselSampleImages/Vigan/2.png" class="d-block" alt="vigan">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/carouselSampleImages/Vigan/3.png" class="d-block" alt="vigan">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
                <div class="otherPictures">
                    <div class="picture1">
                        <img src="assets/carouselSampleImages/Vigan/4.png" class="d-block" alt="vigan">
                    </div>
                    <div class="picture2">
                        <img src="assets/carouselSampleImages/Vigan/5.png" class="d-block" alt="vigan">
                    </div>
                </div>
            </div>
        </section>

        <section class="second-section">
            <div class="details-part">
                <h5 class="title">
                    Calle Crisologo is the epitome of a Vigan adventure.
                </h5>
                <p class="tour-description">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                </p>
                <hr>
                <div class="host-part">
                    <div class="host-profile">
                        <img src="assets/profilePicture/aronjeric.jpg" alt="My Profile Picture" class="profile-picture">
                        <div class="profile-text">
                            <h5 class="host-name">Hosted by <span>Aron Jeric Cao</span></h5>
                            <p>Joined 35 Tours around the Philippines</p>
                        </div>
                    </div>
                    <button class="message-btn">
                        Message Host
                    </button>
                </div>
                <hr>
                <div class="indept-description">
                  <div>
                    sads
                  </div>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                Accordion Item #3
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                              <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                Accordion Item #3
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                              <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
                <div>
                  sads
                </div>
            </div>
            <div class="pricing-part">
                <div class="pricing-container">
                  <div class="current-count">
                    <h5>Currently, there are <span>16 Joiners</span> in this tour</h5>
                  </div>
                  <div class="pickup-location">
                    <div class="location-container">
                      <div>
                        <h5>Date of Departure</h5>
                        <p>October 16, 2024</p>
                      </div>
                      <i class='bx bx-calendar-check calendar-icon'></i>
                    </div>
                    <h5 class="pk-poin-text">
                      Pick-up Point
                    </h5>
                    <a href="" class="pick-location-text">
                      Sampaloc, Manila, Metro Manila, Philippines
                    </a>
                  </div>
                  <div class="price-breakdown">
                    <div class="price-container">
                      <p class="tot-price">₱6,060</p>
                      <p class="period"><span>3 Days</span> Tour</p>
                    </div>
                    <hr>
                    <div class="price-details">
                      <div class="inner-price-detail">
                        <p>Total Trip Cost:</p>
                        <p>P1,500</p>
                      </div>
                      <div class="inner-price-detail">
                        <p>Divided to members:</p>
                        <p>16 Persons</p>
                      </div>
                      <div class="inner-price-detail">
                        <p>Service fee:</p>
                        <p>5% of the bill</p>
                      </div>
                      <div class="inner-price-detail">
                        <p>Calculation:</p>
                        <p>$1,500 / 8 = $187.5</p>
                      </div>
                      <div class="inner-price-detail">
                        <p>Total payment due:</p>
                        <p>₱6,060 </p>
                      </div>
                    </div>
                    <div class="price-btn-container">
                      <button class="join-btn">Join this Tour</button>
                      <button class="share-btn"><i class='bx bx-share bx-flip-horizontal shareicon' ></i>Share</button>  
                    </div>
                  </div>
                </div>
            </div>
        </section>

        <section class="third-section">
            <h5>Destination's Location through Google Maps</h5>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6135.660372754811!2d120.38494310284196!3d17.569400757228564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x338e6f821753bae5%3A0x20035e6de330b125!2sVigan%20City%2C%20Ilocos%20Sur!5e0!3m2!1sen!2sph!4v1729410765474!5m2!1sen!2sph" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p class="map-description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
            </p>
        </section>

        <section class="fourth-section">
            <h5>Meet your Travel Buddies</h5>
            <div class="profiles-container">
                <div class="host-prof-container">
                    <img src="assets/profilePicture/aronjeric.jpg" alt="host profile picture">
                    <div class="host-name">
                        <h3>Aron Jeric Cao</h3>
                        <p>Travel Host</p>
                    </div>
                    <p class="short-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem e unchanged. 
                    </p>
                </div>
                <div class="other-buddies">
                    <h5>Aron Jeric Joined 35 Tours around the Philippines</h5>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                    </p>
                    <div class="meet-container">
                        <h5>Meet other Joiners in the Tour</h5> 
                        <div class="count-container">
                            15
                        </div>
                    </div>
                    <div class="other-buddies-profile">
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                        <div class="profile-card">
                            <img src="assets/profilePicture/aronjeric.jpg" alt="Prifile">
                            <div>Louise Angelo Cabana</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="fifth-section">
          <h5>Other Tour Suggestions</h5>
          <p>Find more related tours based on your search</p>
          <div class="suggested-tour-container">
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
            <div class="suggested-card">
              <img src="assets/carouselSampleImages/Vigan/1.png" alt="vigan">
              <p>Vigan City, Ilocos Norte</p>
              <p class="date-price">October 14, 2024 <span>P752.00</span></p>
            </div>
          </div>
        </section>
    </div>

    <footer id="footer" class="footer">
      <div class="container footer-top">
          <div class="row gy-4">
              <div class="col-lg-3 col-md-3 footer-links">
                  <p class="col-title">Features</p>
                  <ul>
                      <li><a href="#">Custom Itineraries</a></li>
                      <li><a href="#">Easy Booking</a></li>
                      <li><a href="#">24/7 Support</a></li>
                      <li><a href="#">Group Discounts</a></li>
                      <li><a href="#">Flexible Payments</a></li>
                  </ul>
              </div>
  
              <div class="col-lg-3 col-md-3 footer-links">
                  <p class="col-title">Explore Trips</p>
                  <ul>
                      <li><a href="#">Beach Escapes</a></li>
                      <li><a href="#">Mountain Adventures</a></li>
                      <li><a href="#">Cultural Journeys</a></li>
                      <li><a href="#">Family Trips</a></li>
                      <li><a href="#">Weekend Getaways</a></li>
                  </ul>
              </div>
  
              <div class="col-lg-3 col-md-3 footer-links">
                  <p class="col-title">About BondVoyage</p>
                  <ul>
                      <li><a href="#">Our Mission</a></li>
                      <li><a href="#">Meet The Team</a></li>
                      <li><a href="#">Join Our Community</a></li>
                      <li><a href="#">Sustainability and Commitment</a></li>
                      <li><a href="#">Careers</a></li>
                  </ul>
              </div>
  
              <div class="col-lg-3 col-md-3 col-sm-6 footer-links footer-link-4">
                  <p class="col-title">Follow Us</p>
                  <ul>
                      <li><a href="#">Facebook </a></li>
                      <li><a href="#">Instagram</a></li>
                      <li><a href="#">Twitter</a></li>
                      <li><a href="#">LinkedIn</a></li>
                      <li><a href="#">YouTube</a></li>
                  </ul>
              </div>
          </div>
  
          <div class="credit">
              <span><img class="footer-logo" src="/BondVoyage/assets/img/BondLogo.png" alt="">
                  <span class="credit-text-1">BondVoyage - Travel made easy for everyone.</span>
              </span>
              <span class="credit-text-2">© 2024 BondVoyage. All rights reserved.</span>
          </div>
      </div>
  
      <!-- <div class="social-links">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
      </div> -->
      
  </footer>

  <script>
    const joinBtn = document.querySelector(".join-btn");

    joinBtn.addEventListener("click", ()=>{
      location.href = "/payment.html";
    });
  </script>
  
  
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    <!-- Preloader -->
    <div id="preloader"></div>
    <script>
    window.embeddedChatbotConfig = {
    chatbotId: "QKkANZ_Ch__nAo_NXO5qV",
    domain: "www.chatbase.co"
    }
    </script>
    <script
    src="https://www.chatbase.co/embed.min.js"
    chatbotId="QKkANZ_Ch__nAo_NXO5qV"
    domain="www.chatbase.co"
    defer>
    </script>
</body>
</html>
