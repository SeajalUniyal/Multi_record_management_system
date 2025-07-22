<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_portal";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, age, course, cgpa FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registered Students</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 40px;
      color: #333;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #222;
    }
    table {
      width: 100%;
      max-width: 900px;
      margin: auto;
      background: #fff;
      border-collapse: collapse;
      border: 1px solid #ccc;
    }
    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #e0e0e0;
      color: #333;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #444;
      text-decoration: none;
    }
    .search-container {
      text-align: center;
      margin-bottom: 20px;
    }
    #searchInput {
      padding: 10px;
      width: 60%;
      max-width: 400px;
      border: 1px solid #bbb;
      border-radius: 6px;
      font-size: 16px;
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

  <h2>Registered Students</h2>

  <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by name, email, or course...">
  </div>

  <table id="studentsTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Course</th>
        <th>CGPA</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = htmlspecialchars($row["id"]);
          $name = htmlspecialchars($row["name"]);
          $email = htmlspecialchars($row["email"]);
          $age = htmlspecialchars($row["age"]);
          $course = htmlspecialchars($row["course"]);
          $cgpa = htmlspecialchars($row["cgpa"]);

          echo "<tr>
                  <td>$id</td>
                  <td>$name</td>
                  <td>$email</td>
                  <td>$age</td>
                  <td>$course</td>
                  <td>$cgpa</td>
                  <td>
                    <a class='delete-btn' href='delete_student.php?id=$id' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                  </td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <a href="student_form.html" class="back-link">← Go back to registration form</a>

  <script>
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('studentsTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
      const filter = searchInput.value.toLowerCase();
      for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let match = false;
        for (let j = 0; j < cells.length - 1; j++) {
          if (cells[j].textContent.toLowerCase().includes(filter)) {
            match = true;
            break;
          }
        }
        rows[i].style.display = match ? '' : 'none';
      }
    });
  </script>

</body>
</html>
