<?php

$servername = "localhost";
$username = "root";       
$password = "";           
$database = "data_collection"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employees
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        h2 {
            margin-bottom: 20px;
        }
        .delete-btn {
            padding: 6px 10px;
            border-radius: 4px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border: none;
        }
    </style>
</head>
<body>

<h2>Employee List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Position</th>
        <th>Salary (INR)</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["name"]. "</td>
                    <td>" . $row["position"]. "</td>
                    <td>" . number_format($row["salary"], 2) . "</td>
                    <td>" . $row["department"]. "</td>
                    <td>
                      <a class='delete-btn' href='delete_employee.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No employees found</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>
