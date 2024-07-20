<?php 
require_once 'autoload.php';
require_once 'connection.php';

// Start session to handle error messages
session_start();
$user = new User($conn);

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['signup'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $age = $_POST['age'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $calorie_goal = $_POST['calorie_goal'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($age) || empty($height) || empty($weight) || empty($calorie_goal)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login_signup.php");
        exit();
    } elseif ($user->findByEmail($email)) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: login_signup.php");
        exit();
    } elseif ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: login_signup.php");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, password, age, height, weight, calorie_goal) VALUES (:name, :email, :password, :age, :height, :weight, :calorie_goal)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed_password,
            ':age' => $age,
            ':height' => $height,
            ':weight' => $weight,
            ':calorie_goal' => $calorie_goal
        ]);

        header("Location: index.php");
        exit(); // Redirect to index page
    }
}
?>
