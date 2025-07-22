<?php
$conn = new mysqli("localhost", "root", "", "data_collection");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM passengers";
if (!empty($search)) {
  $sql .= " WHERE name LIKE '%$search%' OR ticket_number LIKE '%$search%' OR departure LIKE '%$search%' OR destination LIKE '%$search%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Passenger List</title>
  <style>
    body { font-family: Arial; background: #f1f1f1; padding: 30px; }
    table { border-collapse: collapse; width: 100%; background: #fff; }
    th, td { padding: 10px; border: 1px solid #ccc; }
    th { background: teal; color: white; }
    .search-box { margin-bottom: 20px; }
    .search-box input[type="text"] { padding: 6px; width: 250px; }
    .search-box button { padding: 6px 12px; background: teal; color: white; border: none; }
    a { color: purple; text-decoration: underline; }
  </style>
</head>
<body>

  <h2>Passenger List</h2>
  <form method="GET" class="search-box">
    <input type="text" name="search" placeholder="Search passengers..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
  </form>

  <table>
    <tr>
      <th>ID</th><th>Name</th><th>Ticket No.</th><th>Departure</th><th>Destination</th><th>Date</th><th>Action</th>
    </tr>
    <?php if ($result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['ticket_number']) ?></td>
        <td><?= htmlspecialchars($row['departure']) ?></td>
        <td><?= htmlspecialchars($row['destination']) ?></td>
        <td><?= htmlspecialchars($row['travel_date']) ?></td>
        <td><a href="delete_passenger.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
      </tr>
    <?php endwhile; else: ?>
      <tr><td colspan="7">No passengers found.</td></tr>
    <?php endif; ?>
  </table>

</body>
</html>

<?php $conn->close(); ?>
