<?php
$conn = new mysqli("localhost", "root", "", "data_collection");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$name = $_POST['name'];
$position = $_POST['position'];
$salary = $_POST['salary'];
$department = $_POST['department'];

$sql = "INSERT INTO employees (name, position, salary, department) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds", $name, $position, $salary, $department);

if ($stmt->execute()) { echo "Employee data saved successfully!"; }
else { echo "Error: " . $stmt->error; }

$stmt->close();
$conn->close();
?>
