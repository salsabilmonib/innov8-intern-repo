
 <?php
include 'connection.php'; // Connection to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$Food = $_POST['Food'];
$Calories = $_POST['Calories'];


$sql = "INSERT INTO products (Food, Calories) VALUES ('$Food', '$Calories')";
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . " - " . $conn->error;
    }
}
$conn->close();
?> 
<head>
    <title>Calorie Tracker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Welcome to Calorie Tracker
    </header>
    <div class="profile">
        <img src="profileSample.jpg" alt="Profile Photo" class="profile-photo">
        <h2>Salsabil Monib</h2>
        <p>Email: salsabillotfymonib@gmail.com</p>
        <p>Age: 23</p>
        <p>Height: 165 cm</p>
        <p>Weight: 60 kg</p>
        <p>Calorie Goal: 1800 kcal</p>
    </div>
    <div class="leftcontent">
	<?php
include 'connection.php'; // Include the database connection file

$sql = "SELECT Food, Calories FROM products";
$result = $conn->query($sql);

    echo "<table><tr><th>Food</th><th>Calories</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Food"]. "</td><td>" . $row["Calories"]. "</td></tr>";
    }
    echo "</table>";
$conn->close();
?>
    
    <div class="add-form">
        <form action="index.php" method="post">
            <h2>Add product</h2>
            <input type="text" name="Food" placeholder="Food " required>
            <input type="number" name="Calories" placeholder="Calories/100g" required>
            <input type="submit" value="Add">
        </form>
    </div>
    </div>
</body>
</html>
