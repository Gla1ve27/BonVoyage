<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonVoyage</title>
    <!-- Website Icon -->
    <link rel="shortcut icon" href="assets/Logo/BonVoyage - Square Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="adminVerification.css">
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
</head>
<body>
    <div class="main-container container-fluid">
        <div class="verification-form">
           <img src="assets/Logo/BonVoyage - Square Logo.png" alt="logo">
           <h1>Enter Verification Code</h1>
           <p class="first">Please log in your credential to access the database of BonVoyage.</p>
           <div class="box-container">
            <input type="text" class="vnumber" placeholder="-">
            <input type="text" class="vnumber" placeholder="-">
            <input type="text" class="vnumber" placeholder="-">
            <input type="text" class="vnumber" placeholder="-">
            <input type="text" class="vnumber" placeholder="-">
            <input type="text" class="vnumber" placeholder="-">
           </div>
           <p class="second">To protect the company’s integrity and security, do not share this code.</p>
           <button class="verifyBTN">Verify</button>
           <p>Didn’t receive the code? <a href="">Click here to resend it.</a></p>
        </div>
</body>
</html>