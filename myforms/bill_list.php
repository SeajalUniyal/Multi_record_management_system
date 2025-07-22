<?php
$conn = new mysqli("localhost", "root", "", "Shopkeeper");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch billing records directly from the bills table
$res = $conn->query("SELECT id, customer_name, product_name, quantity, total FROM bills");

echo "<h2>Billing Records</h2><table border='1' cellpadding='10'>
<tr><th>ID</th><th>Customer</th><th>Product</th><th>Qty</th><th>Total</th></tr>";

while ($row = $res->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['customer_name']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['quantity']}</td>
            <td>₹{$row['total']}</td>
          </tr>";
}

echo "</table>";
$conn->close();
?>
