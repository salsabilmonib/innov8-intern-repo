<?php
require_once 'autoload.php';
require_once 'connection.php';

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember_me']);

    $auth = new Auth($conn);

    if ($auth->login($email, $password, $remember_me)) {
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login_signup.php");
        exit();
    }
}
?>
