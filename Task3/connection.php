<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "calorietracker";

// Create connection
$dsn = 'mysql:host='.$host . ';dbname='.$dbname;

try {
    $conn = new PDO($dsn , $username , $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES , false);
    
} catch (PDOException $e){
    echo 'connection failed: ' . $e->getMessage();
}
