<?php
include 'includes/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Check if the vehicle exists and fetch the model and seating capacity
        $stmtVehicle = $pdo->prepare("SELECT vehicle_model, seating_capacity FROM server_vehicles WHERE vehicle_model = ?");
        $stmtVehicle->execute([$_POST['vehicle_model']]);
        $vehicle = $stmtVehicle->fetch(PDO::FETCH_ASSOC);

        if (!$vehicle) {
            die("Error: Vehicle model not found.");
        }

        // Handle file uploads
        $uploadDirectory = 'tourImages/';
        $img1 = $uploadDirectory . basename($_FILES['img1']['name']);
        $img2 = $uploadDirectory . basename($_FILES['img2']['name']);
        $img3 = $uploadDirectory . basename($_FILES['img3']['name']);
        $img4 = $uploadDirectory . basename($_FILES['img4']['name']);
        $itinerary_image = $uploadDirectory . basename($_FILES['itinerary_image']['name']);

        // Move uploaded files to the desired directory
        if (
            !move_uploaded_file($_FILES['img1']['tmp_name'], $img1) ||
            !move_uploaded_file($_FILES['img2']['tmp_name'], $img2) ||
            !move_uploaded_file($_FILES['img3']['tmp_name'], $img3) ||
            !move_uploaded_file($_FILES['img4']['tmp_name'], $img4) ||
            !move_uploaded_file($_FILES['itinerary_image']['tmp_name'], $itinerary_image)
        ) {
            die("Error: File upload failed.");
        }

        // Prepare the SQL statement for inserting into server_tours
        $stmt = $pdo->prepare("
            INSERT INTO server_tours (
                user_id,
                tour_name,
                destination_city,
                destination_description,
                departure_date,
                return_date,
                vehicle_model,
                pickup_time,
                landmark_point,
                price,
                max_capacity,
                joiner_counts,
                destination_address,
                img1,
                img2,
                img3,
                img4,
                destination_name,
                municipality,
                activity_date,
                category,
                itinerary_image,
                description,
                pickup_address
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // Execute the prepared statement with the necessary data
        $stmt->execute([
            $_SESSION['user_id'],
            $_POST['tour_name'],
            $_POST['destination_city'],
            $_POST['destination_description'],
            $_POST['departure_date'],
            $_POST['return_date'],
            $vehicle['vehicle_model'], // Retrieved from server_vehicle
            $_POST['pickup_time'],
            $_POST['landmark_point'],
            $_POST['price'],
            $vehicle['seating_capacity'], // Retrieved from server_vehicle
            0, // Initial joiner count
            $_POST['destination_address'],
            $img1,
            $img2,
            $img3,
            $img4,
            $_POST['destination_name'],
            $_POST['municipality'],
            $_POST['activity_date'],
            $_POST['category'],
            $itinerary_image,
            $_POST['description'],
            $_POST['pickup_address']
        ]);

        echo "New tour added successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonVoyage.com</title>

    <!-- Website Icon -->
    <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="uploadTour.css">
    <link rel="stylesheet" href="ageneral.css">

    <!-- Bootstrap Import Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Importat link of Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Boxicon imports -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Sweet Alert Import -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/img/Logo/BonVoyage - Long Logo.png" alt="BonVoyageLogo" class="logo-image"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-3 pt-2 mb-lg-0">
                    <li class="nav-item"></li>
                    <div class="nav-profile d-flex">
                        <button><i class='bx bx-cog'></i></button>
                        <button class="notif-button"><i class='bx bx-bell notif-btn-icon'>
                                <p class="notif-counter">12</p>
                            </i></button>
                        <button class="profile-btn"><img src="/assets/profilePicture/aronjeric.jpg" alt="profile"><i class='bx bx-menu'></i></button>

                        <div class="profile-options">
                            <button><i class='bx bx-log-out'></i>Log Out</button>
                            <a href="/profile.html">
                                <button><i class='bx bx-user-circle'></i>My Profile</button>
                            </a>
                            <button><i class='bx bxs-chat'></i>Messages</button>
                        </div>

                        <div class="notification-list">
                            <h5 class="mb-1">Notifications <span>12</span></h5>
                            <div class="notif-container">

                                <!-- Design for Add Friend -->
                                <div class="add-friend-notif">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #f36e01;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p><span style="font-weight: bold;">Aron Jeric Cao</span> sent you a friend request.</p>
                                        <div class="btn-container">
                                            <button class="accept-btn">Accept</button>
                                            <button class="decline-btn">Decline</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Design for Tour Invitation -->
                                <div class="add-friend-notif">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #f3bb01;">
                                            <i class='bx bx-briefcase-alt-2'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p><span style="font-weight: bold;">Aron Jeric Cao</span> sent you invitation to travel at <span style="font-weight: bold;">Travel Location</span></p>
                                        <div class="btn-container">
                                            <button class="accept-btn">Let's Go!</button>
                                            <button class="decline-btn">Can't Go</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Starting Tour -->
                                <div class="add-friend-notif d-flex justify-content-center align-items-center">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #3d8bff;">
                                            <i class='bx bxs-bell-ring'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p class="mb-0"><span style="font-weight: bold;">Laguna Pansol 2025</span> is near! Please be prepared it will happen <span style="font-weight: bold;">Tomorrow, November 3, 2024</span></p>
                                    </div>
                                </div>

                                <!-- Starting Tour -->
                                <div class="add-friend-notif">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #ff3d57;">
                                            <i class='bx bxs-bookmark-heart'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p class="mb-0">Hello, <span style="font-weight: bold;">Aron Jeric!</span> BonVoyage is concern about you. Do you got home safe and sound from <span style="font-weight: bold;">Tour Name</span>?</p>
                                        <div class="btn-container mt-2">
                                            <button class="accept-btn ms-auto" style="background-color: #f36e01;">Yes, I Got home!</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tour Inclusion -->
                                <div class="add-friend-notif d-flex justify-content-center align-items-center">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #3d8bff;">
                                            <i class='bx bx-plus-medical'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p class="mb-0">You are now part of <span style="font-weight: bold;">Tour Name</span> Please be prepared it will happen<span style="font-weight: bold;"> November 3, 2024</span> pick up point at <span style="font-weight: bold;"> Pick-up Point</span> </p>
                                    </div>
                                </div>

                                <!-- Starting Tour -->
                                <div class="add-friend-notif d-flex justify-content-center align-items-center">
                                    <div class="img-container">
                                        <img src="assets/profilePicture/aronjeric.jpg" alt="profile">
                                        <span class="notif-icon" style="background-color: #3d8bff;">
                                            <i class='bx bxs-book-add'></i>
                                        </span>
                                    </div>
                                    <div class="notif-content">
                                        <p class="mb-0"><span style="font-weight: bold;">Aron Jeric Cao</span> Accepted your friend request.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form action="" method="POST" enctype="multipart/form-data" novalidate>
        <div class="main-container container">
            <div class="title-page">
                <h4 style="font-weight: bold;">Start a Hosting a Tour <button data-bs-toggle="modal" data-bs-target="#informationModal"><i class='bx bxs-info-circle'></i></button></h4>
                <hr style="width: 80px; color: #f36e01; border: solid 3px; opacity: 1; margin-top: -8px; border-radius: 5px;">
            </div>

            <div class="first-section">
                <div class="side-bar">
                    <div class="meet-up-point-container">
                        <h5>Meet-up Point</h5>
                        <div class="location-container">
                            <i class='bx bx-map'></i>
                            <p id="pickUpLocation">Metro Manila~ Marikina City , Santa Elena</p>
                        </div>
                        <p class="landmark" id="landmark">In front of OLA Church</p>
                        <button id="pickUpBtn" type="button">Choose a Pick-up Point</button>
                    </div>
                    <div class="friend-list">
                        <img src="assets/img/beach-2.jpg" alt="">
                    </div>
                </div>
                <div class="main-bar">
                    <div class="main-destination-form">
                        <h5>Main Destination Information Sheet</h5>
                        <div class="destination-form-row1">
                            <div class="destination-name">
                                <p>Tour Name:</p>
                                <input type="text" placeholder="Enter the Tour Name" name="tour_name">
                            </div>
                            <div class="city-location">
                                <p>City or Province Location:</p>
                                <input type="text" placeholder="Enter Destination City" name="destination_city">
                            </div>
                        </div>
                        <div class="destination-address">
                            <p>Destination Address:</p>
                            <div class="address-third-row">
                                <input type="text" name="destination_address"
                                    class="searchDestination"
                                    id="searchDestination"
                                    placeholder="Please Search for the Destination">
                            </div>
                        </div>
                        <div class="show-destination-map d-none">
                            <iframe class="map-iframe"
                                id="address-iframe"
                                width="100%"
                                height="100%"
                                frameborder="0"
                                scrolling="no"
                                marginheight="0"
                                marginwidth="0"
                                loading="lazy"
                                allowfullscreen=""
                                src="https://maps.google.com/maps?width=100%25&height=600&hl=en&q=Subdivision+(My%20Business%20Name)&t=&z=15&ie=UTF8&iwloc=B&output=embed">
                            </iframe>
                        </div>

                        <div class="lower-part mt-4">
                            <div class="lower-left-part">
                                <p>Departure and Return:</p>
                                <div class="departure-return-div">
                                    <input type="date" placeholder="Date of Departure" name="departure_date">
                                    <input type="time" name="pickup_time" id="" placeholder="Time of Departure">
                                    <p>....</p>
                                    <input type="date" name="return_date" id="" placeholder="Return Date">
                                </div>
                                <p class="mt-4">Destination Description:</p>
                                <textarea name="destination_description" id="description-text" class="destination-descriptions" placeholder="Write the destination's description"></textarea>
                            </div>
                        </div>
                        <p class="mt-4">Destination Images</p>
                        <div class="image-show-part">
                            <div class="image-container">
                                <input type="file" name="img1" id="fileImg" accept="image/*" hidden>
                                <div class="img-area active" data-img="" id="imgArea">
                                    <i class='bx bx-cloud-upload'></i>
                                    <h5>Upload Image</h5>
                                    <p>Please Upload High Quality Resolution Images</p>
                                </div>
                                <button class="select-image" id="selectImg1" type="button">
                                    Select Image
                                </button>
                            </div>
                            <div class="image-container">
                                <input type="file" name="img2" id="fileImg1" accept="image/*" hidden>
                                <div class="img-area active" data-img="" id="imgArea1">
                                    <i class='bx bx-cloud-upload'></i>
                                    <h5>Upload Image</h5>
                                    <p>Please Upload High Quality Resolution Images</p>
                                </div>
                                <button class="select-image" id="selectImg2" type="button">
                                    Select Image
                                </button>
                            </div>
                            <div class="image-container">
                                <input type="file" name="img3" id="fileImg2" accept="image/*" hidden>
                                <div class="img-area active" data-img="" id="imgArea2">
                                    <i class='bx bx-cloud-upload'></i>
                                    <h5>Upload Image</h5>
                                    <p>Please Upload High Quality Resolution Images</p>
                                </div>
                                <button class="select-image" id="selectImg3" type="button">
                                    Select Image
                                </button>
                            </div>
                            <div class="image-container">
                                <input type="file" name="img4" id="fileImg3" accept="image/*" hidden>
                                <div class="img-area active" data-img="" id="imgArea3">
                                    <i class='bx bx-cloud-upload'></i>
                                    <h5>Upload Image</h5>
                                    <p>Please Upload High Quality Resolution Images</p>
                                </div>
                                <button class="select-image" id="selectImg4" type="button">
                                    Select Image
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php
                    try {
                        // Fetch vehicles and their assigned drivers
                        $stmt = $pdo->prepare("
                            SELECT v.*, d.first_name, d.last_name, d.photo_path 
                            FROM server_vehicles v 
                            LEFT JOIN server_drivers d ON v.assigned_driver = d.driver_id
                        ");
                        $stmt->execute();

                        // Fetch all vehicle records
                        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }
                    ?>

                    <div class="vehicle-form">
                        <div class="vehicle-info">
                            <h5>Choose your Vehicle</h5>
                            <p>Vehicle Brand</p>

                            <div class="first-input">
                                <select id="vehicle-brand" class="form-control" name="vehicle_model">
                                    <option value="" disabled selected>Select a Vehicle Model</option>
                                    <?php
                                    // Fetch vehicle models from the database
                                    try {
                                        $stmt = $pdo->prepare("SELECT DISTINCT vehicle_model FROM server_vehicles");
                                        $stmt->execute();
                                        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    } catch (PDOException $e) {
                                        die("Query failed: " . $e->getMessage());
                                    }

                                    // Populate the select options
                                    foreach ($models as $model) {
                                        echo '<option value="' . htmlspecialchars($model['vehicle_model']) . '">' . htmlspecialchars($model['vehicle_model']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <p for="vehicle-brand" class="d-none">Assigned Driver:</p>
                            <div class="company-provider d-none">
                                <input type="text" placeholder="Vehicle Provider" class="company-provider" id="vehicle-provider">
                            </div>
                            <div class="lower-part-vehicle d-none">
                                <div>
                                    <p for="vehicle-brand">Maximum Capacity:</p>
                                    <input type="text" placeholder="Vehicle Capacity" id="vehicle-capacity">
                                </div>
                            </div>
                            <div class="browseBtn-container d-none">
                                <button>Browse</button>
                            </div>
                        </div>
                        <div class="vehicle-pictures d-none">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="innest-item">
                                            <img src="/assets/cars/van1.png" alt="car">
                                            <p>Nissan Ultra Vold 155 18 seatadader1 </p>
                                            <span class="model">Model 123</span>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="innest-item">
                                            <img src="/assets/cars/van2.png" alt="car">
                                            <p>Ford Taunus Transit </p>
                                            <span class="model">Model 123</span>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="innest-item">
                                            <img src="/assets/cars/van3.webp" alt="car">
                                            <p>Hyundai Lavita/Matrix </p>
                                            <span class="model">Model 123</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev car-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <i class='bx bx-chevron-left'></i>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next car-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <i class='bx bx-chevron-right' style='color:#ffffff'></i>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="second-section">
                <div class="itineraries-input">
                    <h5>Create your Tour Itinerary</h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <p>Destination or Activity Name</p>
                                <input
                                    type="text"
                                    name="destination_name"
                                    id="destination_name"
                                    placeholder="Enter the name of activity or destination" />
                            </div>
                            <div class="col-4">
                                <p>Municipality / City</p>
                                <input
                                    type="text"
                                    name="municipality"
                                    id="municipality"
                                    placeholder="Ex. Marikina City" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <p>Day of Activity</p>
                                        <input type="date" name="activity_date" id="activity_date" />
                                    </div>
                                    <div class="col-6">
                                        <p>Category</p>
                                        <input
                                            type="text"
                                            name="category"
                                            id="category"
                                            placeholder="Ex. Hiking" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <p>Itinerary Image</p>
                                        <input type="file" name="itinerary_image" id="itinerary_image" />
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <p>Price</p>
                                    <input
                                        type="number"
                                        name="price"
                                        id="price"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="col-5 mt-3 d-flex flex-column">
                                <p>Description</p>
                                <textarea
                                    name="description"
                                    id="description"
                                    placeholder="Itinerary Description"
                                    class="w-100 h-100"></textarea>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>

                <!-- <div class="bucket-list">
                <h5 class="mb-1">Activity Bucket List</h5>
                <div class="activity-list-container" id="activity_list_container">
                </div>
                </div> -->
            </div>

            <div class="d-flex w-100 justify-content-end">
                <button class="payment-button" type="submit">
                    Upload Tour
                </button>
            </div>
        </div>

        <!-- Popup Overlay -->
        <div class="overlay" id="popupOverlay">
            <div class="popup">
                <h2>Select Pickup Location Address</h2>
                <p>Location Address</p>
                <input type="text" class="pickUpAddress mb-2" id="pickUpAddress" name="pickup_address">
                <p style="margin-top: 0px;">Landmark</p>
                <input type="text" class="puLandmark mb-3" id="puLandmark" name="landmark_point">
                <iframe class="map-iframe2"
                    id="address-iframe"
                    width="100%"
                    height="100%"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    loading="lazy"
                    allowfullscreen=""
                    src="https://maps.google.com/maps?width=100%25&height=600&hl=en&q=Subdivision+(My%20Business%20Name)&t=&z=15&ie=UTF8&iwloc=B&output=embed">
                </iframe>
                <button id="ConfirmPickUp" class="ConfirmPickUp" type="button">Confirm Location</button>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="informationModal" tabindex="-1" aria-labelledby="informationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2 ms-2" id="informationModalLabel">Host Your own BonVoyage Tour!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>What is this all about?</h4>
                    <p class="mb-5">Hosting a tour with BonVoyage is a seamless and rewarding experience! Start by selecting your destination and crafting an engaging itinerary that highlights local attractions and experiences. Next, gather your group and promote your tour through BonVoyage’s platform.</p>
                    <div class="modal-inner-content">
                        <h4>Step 1: Fill Up Main Information Sheet</h4>
                        <p class="mb-4">Here, you can easily add new destinations by entering the name, providing a brief description, and uploading captivating images. Don’t forget to select relevant categories to enhance visibility. Once you’ve reviewed your entries, save your changes to make your destination accessible to the BonVoyage community. Sharing your favorite travel spots has never been easier!</p>
                        <video src="/assets/videos/upload-tutorial-main-destination.mp4" controls muted></video>
                        <h4 class="mt-5">Step 2: Choose your prefered Vehicle Service</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Got It!</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    const showMap = document.querySelector(".show-destination-map");
    const showMapBtn = document.querySelector(".showMap-btn");
    const googleMapsInput = document.querySelector(".googleMapsInput");

    let value = 0;

    // showing profile option
    const profileOptions = document.querySelector(".profile-options");
    const profileBtn = document.querySelector(".profile-btn");

    profileBtn.addEventListener("click", () => {
        if (profileOptions.style.display === "none") {
            profileOptions.style.display = "flex";
            notificationList.style.display = "none";
        } else {
            profileOptions.style.display = "none";
        }
    })

    // showing notification list
    const notificationList = document.querySelector(".notification-list");
    const notifButton = document.querySelector(".notif-button");

    notifButton.addEventListener("click", () => {
        if (notificationList.style.display === "none") {
            notificationList.style.display = "block";
            profileOptions.style.display = "none";
        } else {
            notificationList.style.display = "none";
        }
    })

    // showing instructions and functionality of modules throug information icon.

    // showing images when selected 
    const selectImage = document.querySelector("#selectImg1");
    const imageFile = document.querySelector("#fileImg");
    const imageArea = document.querySelector("#imgArea");

    const selectImage1 = document.querySelector("#selectImg2");
    const imageFile1 = document.querySelector("#fileImg1");
    const imageArea1 = document.querySelector("#imgArea1");

    const selectImage2 = document.querySelector("#selectImg3");
    const imageFile2 = document.querySelector("#fileImg2");
    const imageArea2 = document.querySelector("#imgArea2");

    const selectImage3 = document.querySelector("#selectImg4");
    const imageFile3 = document.querySelector("#fileImg3");
    const imageArea3 = document.querySelector("#imgArea3");

    selectImage.addEventListener('click', () => {
        imageFile.click();
    })

    selectImage1.addEventListener('click', () => {
        imageFile1.click();
    })

    selectImage2.addEventListener('click', () => {
        imageFile2.click();
    })

    selectImage3.addEventListener('click', () => {
        imageFile3.click();
    })

    imageFile.addEventListener('change', function() {
        const image = this.files[0]
        console.log(image)
        const reader = new FileReader();
        reader.onload = () => {
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imageArea.appendChild(img);
            imageArea.classList.add('active');
            imageArea.dataset.img = image.name;
        }
        reader.readAsDataURL(image);
    })

    imageFile1.addEventListener('change', function() {
        const image = this.files[0]
        console.log(image)
        const reader = new FileReader();
        reader.onload = () => {
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imageArea1.appendChild(img);
            imageArea1.classList.add('active');
            imageArea1.dataset.img = image.name;
        }
        reader.readAsDataURL(image);
    })

    imageFile2.addEventListener('change', function() {
        const image = this.files[0]
        console.log(image)
        const reader = new FileReader();
        reader.onload = () => {
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imageArea2.appendChild(img);
            imageArea2.classList.add('active');
            imageArea2.dataset.img = image.name;
        }
        reader.readAsDataURL(image);
    })

    imageFile3.addEventListener('change', function() {
        const image = this.files[0]
        console.log(image)
        const reader = new FileReader();
        reader.onload = () => {
            const imgUrl = reader.result;
            const img = document.createElement('img');
            img.src = imgUrl;
            imageArea3.appendChild(img);
            imageArea3.classList.add('active');
            imageArea3.dataset.img = image.name;
        }
        reader.readAsDataURL(image);
    })

    // Changing the vhicle brands inputs
    const carPrev = document.querySelector(".car-prev");
    const carNext = document.querySelector(".car-next");

    const carBrandInput = document.querySelector("#vehicle-brand");
    const carProviderInput = document.querySelector("#vehicle-provider");
    const carPriceInput = document.querySelector("#vehicle-price");
    const carCapacityInput = document.querySelector("#vehicle-capacity");

    let carQue = 0;
    let carBrand = ["Nissan Ultra Vold 155 18 seatadader1", "Ford Taunus Transit", "Hyundai Lavita/Matrix"]
    carBrandInput.value = carBrand[carQue];

    carNext.addEventListener('click', () => {
        (carQue === carQue.length) ? carQue = 0: carQue++
        carBrandInput.value = carBrand[carQue];
    })

    carPrev.addEventListener('click', () => {
        (carQue === 0) ? carQue = carQue.length: carQue--
        vcarBrandInput.value = carBrand[carQue];

    })

    // Address Input
    const searchDestination = document.getElementById('searchDestination');
    const mapIframe = document.getElementById('address-iframe');
    const showMaps = document.querySelector('.show-destination-map');

    // Add an event listener to update the iframe URL when the input changes
    searchDestination.addEventListener('input', () => {
        const destination = encodeURIComponent(searchDestination.value.trim());
        mapIframe.src = `https://maps.google.com/maps?width=100%25&height=600&hl=en&q=${destination}&t=&z=15&ie=UTF8&iwloc=B&output=embed`;
        showMaps.classList.remove('d-none');
    });

    // JavaScript for handling popup
    const pickUpBtn = document.getElementById('pickUpBtn');
    const ConfirmPickUp = document.getElementById('ConfirmPickUp');
    const popupOverlay = document.getElementById('popupOverlay');
    const pickUpAddress = document.getElementById('pickUpAddress');
    const pickUpLocation = document.getElementById('pickUpLocation');
    const puLandmark = document.getElementById('puLandmark');
    const landmark = document.getElementById('landmark');


    // Function to show the popup
    pickUpBtn.addEventListener('click', () => {
        popupOverlay.style.display = 'flex'; // Show overlay
        const popup = popupOverlay.querySelector('.popup');
        popup.classList.add('focused'); // Add focus to the popup
        popup.focus(); // Ensure the popup gets focus
    });

    var destination = 'Marikina City';

    // Function to hide the popup
    ConfirmPickUp.addEventListener('click', () => {
        if (pickUpAddress.value.trim() === "" || pickUpAddress.value.length < 5) {
            alert("Please Enter a valid address");
        } else {
            if (puLandmark.value.trim() === "") {
                alert("Please Enter a valid landmark");
            } else {
                popupOverlay.style.display = 'none'; // Hide overlay
                Swal.fire({
                    title: "Pick up location are all set!",
                    text: `The location is now on ${pickUpAddress.value}`,
                    icon: "success"
                });
                pickUpLocation.innerHTML = `${pickUpAddress.value}`
                landmark.innerHTML = `${puLandmark.value}`
            }
        }

    });

    // Close popup when clicking outside of it
    popupOverlay.addEventListener('click', (event) => {
        if (event.target === popupOverlay) {
            popupOverlay.style.display = 'none';
        }
    });

    // ACTIVITY BUCKET LIST
    document.addEventListener("DOMContentLoaded", () => {
        const addListButton = document.getElementById("add_list_btn");
        const activityListContainer = document.getElementById("activity_list_container");
        let bucketListData = {};

        const renderBucketList = () => {
            activityListContainer.innerHTML = ""; // Clear the container

            // Sort the dates in ascending order
            const sortedDates = Object.keys(bucketListData).sort((a, b) => new Date(a) - new Date(b));

            sortedDates.forEach((date, index) => {
                // Create a header for the date
                const dayHeader = document.createElement("div");
                dayHeader.className = "day mt-3 pe-2";
                dayHeader.innerHTML = `
        <p>Day ${index + 1} <span>(${date})</span></p>
        <button class="clear-btn" data-date="${date}">clear</button>
      `;
                activityListContainer.appendChild(dayHeader);

                // Iterate through the activities for this date
                bucketListData[date].forEach((activity, activityIndex) => {
                    const itinerary = document.createElement("div");
                    itinerary.className = "itinerary-container mt-2";
                    itinerary.innerHTML = `
          <p class="name">${activity.destination_name}</p>
          <p class="place">${activity.municipality}</p>
          <div class="number">${activityIndex + 1}</div>
        `;
                    activityListContainer.appendChild(itinerary);
                });
            });


            // Add event listeners for the clear buttons
            document.querySelectorAll(".clear-btn").forEach((button) => {
                button.addEventListener("click", (e) => {
                    const dateToClear = e.target.dataset.date;
                    delete bucketListData[dateToClear];
                    renderBucketList(); // Re-render the bucket list
                });
            });
        };

        addListButton.addEventListener("click", () => {
            const destinationInput = document.getElementById("destination_name");
            const municipalityInput = document.getElementById("municipality");
            const dateInput = document.getElementById("activity_date");
            const categoryInput = document.getElementById("category");
            const descriptionInput = document.getElementById("description");
            const fileInput = document.getElementById("itinerary_image");

            const destinationName = destinationInput.value.trim();
            const municipality = municipalityInput.value.trim();
            const date = dateInput.value.trim();
            const category = categoryInput.value.trim();
            const description = descriptionInput.value.trim();
            const file = fileInput.files[0]?.name || "No file uploaded";

            if (!destinationName || !municipality || !date) {
                alert("Please fill out all required fields!");
                return;
            }

            const activity = {
                destination_name: destinationName,
                municipality: municipality,
                date: date,
                category: category,
                description: description,
                itinerary_image: file,
            };

            if (!bucketListData[date]) {
                bucketListData[date] = [];
            }
            bucketListData[date].push(activity);

            destinationInput.value = "";
            municipalityInput.value = "";
            dateInput.value = "";
            categoryInput.value = "";
            descriptionInput.value = "";
            fileInput.value = "";

            renderBucketList();
        });

        renderBucketList();
    });
</script>

</html>