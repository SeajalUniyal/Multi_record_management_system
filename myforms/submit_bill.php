<?php
// Get data from form
$customer_name = $_POST['customer_name'];
$product_name = $_POST['product_name'];
$price = floatval($_POST['price']);
$quantity = intval($_POST['quantity']);
$total = $price * $quantity;

// Save to database
$conn = new mysqli("localhost", "root", "", "Shopkeeper");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Use a prepared statement for security
$stmt = $conn->prepare("INSERT INTO bills (customer_name, product_name, price, quantity, total) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssddi", $customer_name, $product_name, $price, $quantity, $total);
$stmt->execute();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bill Receipt</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 40px;
    }
    .receipt {
      max-width: 500px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    p {
      font-size: 16px;
      margin: 8px 0;
    }
    .total {
      font-weight: bold;
      font-size: 18px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="receipt">
    <h2>Bill Receipt</h2>
    <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
    <p><strong>Product:</strong> <?php echo htmlspecialchars($product_name); ?></p>
    <p><strong>Price per Item:</strong> ₹<?php echo number_format($price, 2); ?></p>
    <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
    <p class="total">Total: ₹<?php echo number_format($total, 2); ?></p>
  </div>
</body>
</html>
