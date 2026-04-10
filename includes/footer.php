    </main>
    <footer id="footer" class="footer" style="background-color: #ffffff; padding: 60px 0 30px; border-top: 1px solid #eee;">
        <div class="container">
            <div class="row gy-4 mb-5 pb-4 border-bottom">
                <div class="col-lg-3 col-md-3 footer-links">
                    <p class="fw-bold mb-3" style="font-size: 14px; color: #333;">Features</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Custom Itineraries</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Easy Booking</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">24/7 Support</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Group Discounts</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Flexible Payments</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 footer-links">
                    <p class="fw-bold mb-3" style="font-size: 14px; color: #333;">Explore Trips</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Beach Escapes</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Mountain Adventures</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Cultural Journeys</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Family Trips</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Weekend Getaways</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 footer-links">
                    <p class="fw-bold mb-3" style="font-size: 14px; color: #333;">About BondVoyage</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Our Mission</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Meet the Team</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Join Our Community</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Sustainability Commitment</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Careers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 footer-links">
                    <p class="fw-bold mb-3" style="font-size: 14px; color: #333;">Follow Us</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Facebook</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Instagram</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">Twitter</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">LinkedIn</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted small">YouTube</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="d-flex align-items-center mb-2">
                    <img src="assets/img/BondLogo.png" alt="Logo" style="height: 30px; margin-right: 10px;">
                    <span class="fw-bold" style="color: #333;">BondVoyage - Travel Made Easy for Everyone</span>
                </div>
                <p class="text-muted small mb-0">© 2023 BondVoyage. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-chevron-up"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/aos.js"></script>
    <script src="assets/vendors/glightbox.min.js"></script>
    <script src="assets/vendors/swiper-bundle.min.js"></script>
    <script src="assets/js/validate.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/landing.js"></script>
    <?php if (isset($extraJS)): ?>
        <?php foreach ($extraJS as $js): ?>
            <script src="assets/js/<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    </body>

    </html>