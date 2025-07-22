<?php
$conn = new mysqli("localhost", "root", "", "data_collection");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM passengers WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: passenger_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided to delete.";
}
?>
