<?php 
require('connection.php');
include('header.html');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css"
    rel="stylesheet">
  <script
    src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/profile.css" />
  <title>BonVoyage - Profile</title>
</head>

<body>
  <div class="container head">
    <div class="row">
      <div class="col-md-12">
        <div class="profile-container">
          <div class="cover-photo cover-container">
            <button class="change-cover-btn">Change Cover</button>
          </div>
          <div class="display-picture">
            <a href="#">
              <img
                src="https://scontent.fmnl4-4.fna.fbcdn.net/v/t39.30808-6/431972958_7378356298879063_2594490752133297890_n.jpg?stp=dst-jpg_tt7&_nc_cat=100&cb=99be929b-255fc52a&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeE3dXs2PxfRaBM5ajHXr5qRK571Gdwt3VsrnvUZ3C3dWwPYux4zo7DHEfM2VEOqJSIVJS0fhnUKhLthj4TDDcnC&_nc_ohc=VMMSVKVSkJoQ7kNvgEwLCI9&_nc_zt=23&_nc_ht=scontent.fmnl4-4.fna&_nc_gid=Ar77QrJUIL9M67mrnn7Tqsb&oh=00_AYCAkNXatPGsn7JajCa-fU1cyoGJgH8CNCmBQCUQ7YboIg&oe=671E9D3E"
                alt="Profile Photo">
            </a>
          </div>
          <div class="profile-name">
            <h2>Marc Badua</h2>
            <p><strong>3.1K Friends</strong></p>
            <p>Joined 32 Tours around the Philippines</p>
          </div>
          <div class="profile-actions">
            <button class="message-btn">Message</button>
            <button class="add-btn">Add Friend</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container main">
    <div class="container leftside-bio">
      <div class="Bio">
        <p>I can do all thing through Christ who strengthens me. Philippians 4:13</p>
      </div>
      <div class="AboutMe">
        <h3>About Me</h3>
        <p>Studies at <strong>Technological Institute of the Philippines</strong></p>
        <p>Went to <strong>Casimiro A. Ynares Memorial National Highschool</strong></p>
        <p>Lives in <strong>Taytay, Rizal</strong></p>
      </div>
      <div class="Friends">
        <h3>Friends</h3>
        <div class="container bonfriends">
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/ELIJAH.jpg" class="friends-img">
              <p>Elijah Arizobal</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/Marc.jpg" class="friends-img">
              <p>Marc John Badua</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/ARON.jpg" class="friends-img">
              <p>Aron Jeric Cao</p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/Gello.jpg" class="friends-img">
              <p>Louise Cabana</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/jhi.jpg" class="friends-img">
              <p>Jhilou Lian Carpizo</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/cid.jpg" class="friends-img">
              <p>El Cid Apalisok</p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="assets/images/gwen.jpg" class="friends-img">
              <p>Gwen Flores</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/marielle.jpg" class="friends-img">
              <p>Marielle Festejo</p>
            </div>
            <div class="col-md-4">
              <img src="assets/images/jorgie.jpg" class="friends-img">
              <p>Jorgie Mae Jamison</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container findpeople">
        <h3>Find other people</h3>
        <div class="input-group rounded">
          <input type="search" class="form-control rounded" placeholder="User ID or User Name" aria-label="Search"
            aria-describedby="search-addon" />
          <span class="input-group-text border-1" id="search-addon">
            <i class="fa fa-user-plus"></i>
          </span>
        </div>
      </div>
    </div>


    <div class="container rightside">
      <div class="post-card-container">
        <div class="post-card">
          <div class="card-header">
            <div class="profile">
              <img src="assets/images/Marc.jpg" alt="Profile Picture" class="profile-img">
              <div class="host-info">
                <h4>Marc Badua</h4>
                <p>Travel Host</p>
              </div>
            </div>
            <div class="date">December 12, 2023</div>
          </div>

          <div class="card-image">
            <img src="assets/backgrounds/batanes.jpg" alt="Posted Image">
            <div class="carousel-controls">
              <button class="prev-btn">⟨</button>
              <button class="next-btn">⟩</button>
            </div>
            <div class="people-count">06/10</div>
          </div>

          <div class="card-content">
            <h3>Batanes Islands</h3>
            <p>Embrace every journey with flexibility, curiosity, exploration, and joy. Adjust your plans as needed,
              look for new perspectives, find hidden gems, and ultimately enjoy every moment!</p>
            <div class="tour-action">
              <button class="info-btn">i</button>
              <button class="join-btn">Join the Tour</button>
            </div>
          </div>
        </div>

        <div class="post-card">
          <div class="card-header">
            <div class="profile">
              <img src="assets/images/Marc.jpg" alt="Profile Picture" class="profile-img">
              <div class="host-info">
                <h4>Marc Badua</h4>
                <p>Travel Host</p>
              </div>
            </div>
            <div class="date">December 12, 2023</div>
          </div>

          <div class="card-image">
            <img src="assets/backgrounds/mactan.jpg" alt="Posted Image">
            <div class="carousel-controls">
              <button class="prev-btn">⟨</button>
              <button class="next-btn">⟩</button>
            </div>
            <div class="people-count">10/10</div>
          </div>

          <div class="card-content">
            <h3>Mactan, Cebu</h3>
            <p>Embrace every journey with flexibility, curiosity, exploration, and joy. Adjust your plans as needed,
              look for new perspectives, find hidden gems, and ultimately enjoy every moment!</p>
            <div class="tour-action">
              <button class="info-btn">i</button>
              <button class="join-btn">Join the Tour</button>
            </div>
          </div>
        </div>

        <div class="post-card">
          <div class="card-header">
            <div class="profile">
              <img src="assets/images/Marc.jpg" alt="Profile Picture" class="profile-img">
              <div class="host-info">
                <h4>Marc Badua</h4>
                <p>Travel Host</p>
              </div>
            </div>
            <div class="date">December 25, 2023</div>
          </div>

          <div class="card-image">
            <img src="assets/backgrounds/bg-palawan.jpg" alt="Posted Image">
            <div class="carousel-controls">
              <button class="prev-btn">⟨</button>
              <button class="next-btn">⟩</button>
            </div>
            <div class="people-count">09/10</div>
          </div>

          <div class="card-content">
            <h3>Palawan</h3>
            <p>Embrace every journey with flexibility, curiosity, exploration, and joy. Adjust your plans as needed,
              look for new perspectives, find hidden gems, and ultimately enjoy every moment!</p>
            <div class="tour-action">
              <button class="info-btn">i</button>
              <button class="join-btn">Join the Tour</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include('footer.html');
  ?>
</body>

</html>