<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$pageTitle = "Contact Us - BondVoyage";
$extraCSS = ['contactus.css', 'ageneral.css'];

include 'includes/header.php';
?>

<div class="container-fluid main-container" style="padding-top: 100px;">
  <div class="contact-container">
    <h1>Contact us!</h1>
    <p>Send us email through <a href="mailto:bondVoyage2024@gmail.com">bondVoyage2024@gmail.com</a> <br>
      or call us through mobile phone <i class="fa bi-phone"></i> <a href="tel:+09999705666">09999705666</a></p>

    <div class="contact-options">
      <div class="contact-box">
        <h2>I have a technical question</h2>
        <p>If you have encountered technical issues such as bugs, errors, and such through the system, please let us know so that we can help you solve the issue.</p>
        <button class="contact-button" id="support-btn">Submit a Support Ticket</button>
      </div>
      <div class="contact-box">
        <h2>I have a basic question</h2>
        <p>If you have a random question that pops up in your mind, don’t hesitate to ask. We are happy to help you provide the right answer.</p>
        <button class="contact-button" id="question-btn">Ask a Question</button>
      </div>
    </div>

    <div class="social-media mt-5">
      <p>Follow us on our Social Media Platforms</p>
      <div class="social-icons">
        <i class='bx bxl-facebook fa-facebook'></i>
        <i class='bx bxl-instagram fa-instagram'></i>
        <i class='bx bxl-tiktok fa-tiktok'></i>
        <i class='bx bxl-linkedin fa-linkedin'></i>
        <i class='bx bxl-twitter fa-x-twitter'></i>
      </div>
    </div>
  </div>
  <div class="promo">
    <p>Be part of the large travel communities through <span class="brand">BondVoyage</span>
      <br>Don’t miss the chance to enjoy your vacation in a much cheaper way!
    </p>
    <button class="promo-button" onclick="location.href='registration.php'">Register now Get 20% Discount</button>
  </div>
</div>

<?php
$extraJS = ['contactus.js'];
include 'includes/footer.php';
?>