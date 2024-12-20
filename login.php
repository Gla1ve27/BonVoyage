<?php  
    require 'connection.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $stmt = $pdo->prepare("SELECT id, email, password FROM user_accounts WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.html"); 
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BondVoyage - Login</title>
        <link rel="stylesheet" href="assets/css/login.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo">
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <img src="assets/icons/navtitle.png" width="223" height="53" alt>
                        </a>
                    </nav>
                </div>
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Destinations</a></li>
                    <li><a href="#">Itineraries</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Sign In</a></li>
                    <li><a class="cta" href="#">Get Started</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <div id="overlay"></div>
            <div class="left">
                <h2>New Here?</h2>
                <p>Sign up and discover a great amount of new opportunities!</p>
                <a href="register.php" class="btn-signup">SIGN UP</a>
            </div>
            <div class="right">
                <form action="login.php" method="POST" class="login-form">
                    <h2>Login</h2>
                    
                    <!-- Display error message if login fails -->
                    <?php if (!empty($error)) : ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn-login">LOGIN</button>
                    <div class="forgot-password">
                        <a href="#">Forgot password? <span>Click here</span></a>
                    </div>
                    <div class="social-login">
                        <p>or sign in with</p>
                        <button class="btn-google"><img src="assets/icons/g-icon.svg" alt> Google</button>
                        <button class="btn-facebook"><img src="assets/icons/fb.png" alt> Facebook</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
