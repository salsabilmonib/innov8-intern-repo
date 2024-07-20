<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email, $password, $age, $height, $weight, $calorie_goal) {
        $sql = "INSERT INTO users (name, email, password, age, height, weight, calorie_goal) VALUES (:name, :email, :password, :age, :height, :weight, :calorie_goal)";
        $stmt = $this->conn->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed_password,
            ':age' => $age,
            ':height' => $height,
            ':weight' => $weight,
            ':calorie_goal' => $calorie_goal
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
