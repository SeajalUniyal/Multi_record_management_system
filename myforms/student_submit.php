<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and validate input
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$age = intval($_POST['age']);
$course = trim($_POST['course']);
$cgpa = floatval($_POST['cgpa']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Insert data
$sql = "INSERT INTO students (name, email, age, course, cgpa) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisd", $name, $email, $age, $course, $cgpa);

if ($stmt->execute()) {
    echo "<h2>Registration successful!</h2><a href='student_form.html'>Go Back</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
