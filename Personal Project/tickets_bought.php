<?php
include('db.php');
session_start();

$userId = $_SESSION['userid'] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit();
}

// Fetch all purchases (you can filter by user if you want)
$stmt = $conn->prepare("SELECT * FROM ticket_purchases ORDER BY purchase_date DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>All Tickets Bought</title>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
    max-width: 900px;
    margin: 20px auto;
  }
  th, td {
    border: 1px solid #aaa;
    padding: 8px 12px;
    text-align: left;
  }
  th {
    background: #eee;
  }
  body {
    font-family: Arial, sans-serif;
    padding: 20px;
  }
</style>
</head>
<body>

<h1>All Tickets Bought</h1>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>User ID</th>
      <th>Event Type</th>
      <th>Event Name</th>
      <th>Ticket Type</th>
      <th>Quantity</th>
      <th>Price per Ticket</th>
      <th>Total Price</th>
      <th>Purchase Date</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['user_id']) ?></td>
        <td><?= htmlspecialchars($row['event_type']) ?></td>
        <td><?= htmlspecialchars($row['event_name']) ?></td>
        <td><?= htmlspecialchars($row['ticket_type']) ?></td>
        <td><?= htmlspecialchars($row['quantity']) ?></td>
        <td>$<?= number_format($row['price_per_ticket'], 2) ?></td>
        <td>$<?= number_format($row['total_price'], 2) ?></td>
        <td><?= htmlspecialchars($row['purchase_date']) ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>
