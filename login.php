<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$pageTitle = "Login - BonVoyage";
$extraCSS = ['login.css'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Update online status
        $update = $pdo->prepare("UPDATE users SET online = 1 WHERE id = ?");
        $update->execute([$user['id']]);

        header("Location: landing.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

include 'includes/header.php';
?>

<section class="login-section">
    <div class="container login-container">
        <div class="login-wrapper">
            <!-- Left Side: New Here CTA -->
            <div class="login-left" data-aos="fade-right">
                <h2 class="new-here-title">New Here?</h2>
                <p>Sign up and discover a great amount of new opportunities!</p>
                <a href="registration.php" class="btn-signup-white">SIGN UP</a>
            </div>

            <!-- Right Side: Login Card -->
            <div class="login-right" data-aos="fade-left">
                <div class="login-card">
                    <h2>Login</h2>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger py-2 small mb-4" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i><?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" id="loginEmail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="loginPassword" required>
                        </div>

                        <button type="submit" class="btn-login-orange">LOGIN</button>

                        <span class="forgot-pw">Forgot password? <a href="#">Click here</a></span>

                        <div class="divider">or sign in with</div>

                        <div class="social-buttons">
                            <button type="button" class="btn-social">
                                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                                Google
                            </button>
                            <button type="button" class="btn-social">
                                <i class="bi bi-facebook text-primary"></i>
                                Facebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>