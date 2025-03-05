<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging
    if (empty($_POST["name"]) || empty($_POST["phone"]) || empty($_POST["password"])) {
        die("Error: All fields are required.");
    }

    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];

    // Validate input fields
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        die("Error: Name can only contain letters and spaces.");
    }
    if (!preg_match("/^\d{10}$/", $phone)) {
        die("Error: Phone number must be a 10-digit number.");
    }
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/\d/", $password) || !preg_match("/[\W_]/", $password)) {
        die("Error: Password must be at least 8 characters long and include an uppercase letter, a number, and a special character.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the users table
    $stmt = $conn->prepare("INSERT INTO users (name, phone, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sss", $name, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: roleselection.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
