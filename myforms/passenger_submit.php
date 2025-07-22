<?php
$conn = new mysqli("localhost", "root", "", "data_collection");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching POST data
$name = $_POST['name'];
$ticket_number = $_POST['ticket_number'] ?? ''; // Optional, adjust if not used
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$travel_date = $_POST['travel_date'];

// Check if column exists before inserting
$sql = "INSERT INTO passengers (name, ticket_number, departure, destination, travel_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Ensure the correct number of placeholders and types
$stmt->bind_param("sssss", $name, $ticket_number, $departure, $destination, $travel_date);

if ($stmt->execute()) {
    echo "Reservation saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
