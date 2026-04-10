<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$pageTitle = "Destination and Itineraries - BondVoyage";
$extraCSS = ['itineraries.css', 'ageneral.css'];

include 'includes/header.php';

// Fetch trips from database
$stmt = $pdo->prepare("SELECT * FROM trips ORDER BY created_at DESC");
$stmt->execute();
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Itineraries Main Content -->
<!-- Itineraries Hero -->
<section class="itineraries-hero">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side Text -->
            <div class="col-lg-6">
                <div class="hero-content-left" data-aos="fade-right">
                    <h1>WORRY LESS ABOUT YOUR BUDGET.</h1>
                    <p class="hero-description">Find the best the perfect vacation and itineraries this company has to offer based on your budget.</p>
                    <p class="hero-description">At BonVoyage, we believe that travel is not just about reaching a destination—it's about the experiences, the connections, and the memories you create along the way. Our comprehensive range of services is designed to cater to every type of traveler, ensuring that your journey is seamless and extraordinary.</p>

                    <h5 class="hero-highlight">ADJUST, LOOK, FIND and ENJOY</h5>
                    <p class="hero-description">Embrace every journey with flexibility, curiosity, exploration, and joy. Adjust your plans as needed, look for new perspectives, find hidden gems, and ultimately enjoy every moment!</p>
                </div>
            </div>

            <!-- Right Side Filter Card -->
            <div class="col-lg-6">
                <div class="filter-card" data-aos="fade-left">
                    <span class="filter-label-top">ENTER AMOUNT OF YOUR BUDGET</span>

                    <div class="budget-slider-container">
                        <input type="range" min="600" max="60000" value="47000" class="range-slider" id="budgetRange">
                        <div class="range-values">
                            <span>600</span>
                            <span>60,000</span>
                        </div>
                    </div>

                    <div class="budget-input-row">
                        <input type="text" class="budget-input-field" value="P 47,000" disabled>
                        <button class="btn-filter-small">Filter</button>
                        <div class="budget-summary">
                            <span class="label">YOUR BUDGET IS</span>
                            <span class="value" id="budgetValue">47,000</span>
                        </div>
                    </div>

                    <div class="selection-group">
                        <span class="selection-title">WHICH PART OF THE PHILIPPINES</span>
                        <div class="radio-list">
                            <div class="radio-item">
                                <div class="radio-dot"></div> Luzon, Philippines
                            </div>
                            <div class="radio-item active">
                                <div class="radio-dot"></div> Visayas, Philippines
                            </div>
                            <div class="radio-item">
                                <div class="radio-dot"></div> Mindanao, Philippines
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="selection-group">
                                <span class="selection-title">Method</span>
                                <div class="radio-list flex-row gap-3">
                                    <div class="radio-item">
                                        <div class="radio-dot"></div> Be a Joiner
                                    </div>
                                    <div class="radio-item active">
                                        <div class="radio-dot"></div> Be a Group Host
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="selection-group mb-0">
                        <span class="selection-title">Enter Number of Person/s</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pax-input-container">
                                <input type="number" class="pax-input" value="10">
                                <span class="pax-label">pax</span>
                            </div>
                            <button class="btn-find-tour">Find a tour</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vacation Section -->
<section class="region-section pb-0">
    <div class="container">
        <span class="region-label text-orange">Available Perfect Vacation in</span>
        <h2 class="region-title">Visayas Region, Philippines</h2>

        <div class="trip-grid" data-aos="fade-up">
            <?php
            $vacations = [
                ['title' => 'Chocolate Hills, Bohol', 'img' => 'assets/img/itineraryImages/chocolate-hills.jpg'],
                ['title' => 'Bahura Reefs, Cebu', 'img' => 'assets/img/itineraryImages/reef.jpg'],
                ['title' => 'San Joaquin Church, Iloilo', 'img' => 'assets/img/itineraryImages/church.jpg'],
                ['title' => 'Boracay Beach, Aklan', 'img' => 'assets/img/itineraryImages/boracay.jpg'],
                ['title' => 'Mactan City, Cebu', 'img' => 'assets/img/itineraryImages/mactan.jpg'],
                ['title' => 'Bahura Reefs, Cebu', 'img' => 'assets/img/itineraryImages/reef2.jpg'],
                ['title' => 'Kawa Hot Bath, Tibiao', 'img' => 'assets/img/itineraryImages/kawa.jpg'],
                ['title' => 'Bugang River, Antique', 'img' => 'assets/img/itineraryImages/river.jpg'],
                ['title' => 'Malumpati Cold Spring', 'img' => 'assets/img/itineraryImages/spring.jpg'],
                ['title' => 'Antique Rice Terraces', 'img' => 'assets/img/itineraryImages/terraces.jpg'],
                ['title' => 'Aguinid Falls, Cebu', 'img' => 'assets/img/itineraryImages/falls.jpg'],
                ['title' => 'Kawasan Falls, Cebu', 'img' => 'assets/img/itineraryImages/kawasan.jpg'],
            ];
            foreach ($vacations as $v):
            ?>
                <div class="tour-card">
                    <img src="<?= $v['img'] ?>" class="tour-image" alt="<?= $v['title'] ?>" onerror="this.src='assets/img/itineraries-img.png'">
                    <h4 class="tour-title"><?= $v['title'] ?></h4>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn-load-more">Load More</button>
    </div>
</section>

<!-- Itineraries Section -->
<section class="region-section pt-0">
    <div class="container">
        <span class="region-label text-orange">Available Perfect Itineraries on</span>
        <h2 class="region-title">Visayas Region, Philippines</h2>

        <div class="itinerary-grid" data-aos="fade-up">
            <div class="itin-item wide">
                <img src="assets/img/itineraryImages/zipline.jpg" alt="Zipline">
            </div>
            <div class="itin-item wide">
                <img src="assets/img/itineraryImages/diving.jpg" alt="Diving">
            </div>
            <div class="itin-item">
                <img src="assets/img/itineraryImages/skydive.jpg" alt="Skydive">
            </div>
            <div class="itin-item">
                <img src="assets/img/itineraryImages/boating.jpg" alt="Boating">
            </div>
            <div class="itin-item">
                <img src="assets/img/itineraryImages/hiking.jpg" alt="Hiking">
            </div>
            <div class="itin-item">
                <img src="assets/img/itineraryImages/camping.jpg" alt="Camping">
            </div>
            <div class="itin-item wide">
                <img src="assets/img/itineraryImages/rafting.jpg" alt="Rafting">
            </div>
        </div>
        <button class="btn-load-more">Load More</button>
    </div>
</section>

<a href="uploadTour.php" class="btn-host-fixed" title="Host a Tour">
    <i class="bi bi-plus-lg"></i>
</a>

<?php
$extraJS = ['itineraries.js'];
include 'includes/footer.php';
?>