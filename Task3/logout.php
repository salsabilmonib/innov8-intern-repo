<?php
require_once 'autoload.php';
require_once 'connection.php';

$auth = new Auth($conn);
$auth->logout();

header("Location: login_signup.php");
exit();
?>
