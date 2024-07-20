<?php
class Auth {
    private $conn;
    private $user;

    public function __construct($db) {
        $this->conn = $db;
        $this->user = new User($db);
    }

    public function login($email, $password, $remember_me) {
        $user = $this->user->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            if ($remember_me) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 30 days
                setcookie('email', $user['email'], time() + (86400 * 30), "/");
            }

            return true;
        }

        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        setcookie('user_id', '', time() - 3600, "/");
        setcookie('email', '', time() - 3600, "/");
    }

    public function checkLogin() {
        session_start();
        if (isset($_SESSION['user_id']) || (isset($_COOKIE['user_id']) && isset($_COOKIE['email']))) {
            $_SESSION['user_id'] = $_SESSION['user_id'] ?? $_COOKIE['user_id'];
            $_SESSION['email'] = $_SESSION['email'] ?? $_COOKIE['email'];
            return true;
        }
        return false;
    }
}
?>
