<?php 
require_once 'connection.php';
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']); // Clear error message after displaying
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calorie Tracker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="forms-container">
        <div class="signup-form">
            <form action="signup.php" method="POST">
                <h2>Sign up</h2>
                <?php if (!empty($error)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <div class="columns-container">
                    <div class="column1">
                        <input type="text" name="name" placeholder="Enter your name" required>
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <input type="password" name="password" placeholder="Create password" required>
                        <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <div class="column2">
                        <input type="number" name="age" placeholder="Enter your age" required>
                        <input type="number" name="height" placeholder="Height (cm)" required>
                        <input type="number" name="weight" placeholder="Weight (kg)" required>
                        <input type="number" name="calorie_goal" placeholder="Calorie Goal" required>
                    </div>
                </div>
                <button type="submit" name="signup">Register Now</button>
                <p class="login-link">Already have an account? <u href="#" onclick="event.preventDefault(); toggleForm(true);">Login now</u></p>
            </form>
        </div>
        <div class="login-form" style="display: none;">
            <form action="login.php" method="POST">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter password" required>
                <div class="checkbox-container">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Remember me?</label>
                </div>
                <button type="submit" name="login">Login Now</button>
            </form>
        </div>
    </div>
    <div class="slogan">
        <h1>Calorie Tracker</h1>
    </div>
    <script>
        function toggleForm(showLogin) {
            const loginForm = document.querySelector('.login-form');
            const signupForm = document.querySelector('.signup-form');
            if (showLogin) {
                signupForm.style.display = 'none';
                loginForm.style.display = 'block';
            } else {
                signupForm.style.display = 'block';
                loginForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>
