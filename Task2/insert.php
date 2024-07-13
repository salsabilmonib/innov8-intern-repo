<!-- <?php
include 'connection.php'; 

$Food = $_POST['Food'];
$Calories = $_POST['Calories'];


$sql = "INSERT INTO products (Food, Calories) VALUES ('$Food', '$Calories')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: index.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>  -->
