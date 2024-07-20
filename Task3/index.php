
 <?php
require_once 'connection.php'; 
require_once 'autoload.php'; 



$auth = new Auth($conn);

if (!$auth->checkLogin()) {
    header("Location: login_signup.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Food = $_POST['Food'];
    $Calories = $_POST['Calories'];

    $sql = "INSERT INTO products (Food, Calories) VALUES (:Food, :Calories)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':Food' => $Food, ':Calories' => $Calories]);
}

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
    <p><a href="logout.php">Logout</a></p>
    <div class="leftcontent">


<?php
    $sql = "SELECT id, name , email , age , height , weight , calorie_goal  FROM users";
    $stmt = $conn->query($sql);

    echo "<table><tr><th>id</th><th>name</th><th>email</th><th>age</th><th>height</th><th>weight</th><th>calorie Goal</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" . htmlspecialchars($row->id) . "</td><td>" . htmlspecialchars($row->name) . "</td><td>" . htmlspecialchars($row->email) . 
        "</td><td>" . htmlspecialchars($row->age) . "</td><td>" . htmlspecialchars($row->height) .
         "</td><td>" . htmlspecialchars($row->weight) . "</td><td>" . htmlspecialchars($row->calorie_goal) . "</td></tr>";
    }
    echo "</table>";
    ?>

<?php
    $sql = "SELECT Food, Calories FROM products";
    $stmt = $conn->query($sql);

    echo "<table><tr><th>Food</th><th>Calories</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" . htmlspecialchars($row->Food) . "</td><td>" . htmlspecialchars($row->Calories) . "</td></tr>";
    }
    echo "</table>";
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
