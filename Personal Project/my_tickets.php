<?php
include('db.php');
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];

// Prepared statement to fetch purchased tickets
$stmt = $conn->prepare("SELECT t.event_name, t.category, t.event_date, t.venue, t.price, p.purchase_date
                        FROM purchases p
                        JOIN tickets t ON p.ticket_id = t.id
                        WHERE p.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('dashboard.php'); // Include the dashboard navigation ?>

<div class="container">
    <h2>My Purchased Tickets</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['event_name']) ?> (<?= htmlspecialchars($row['category']) ?>) on <?= htmlspecialchars($row['event_date']) ?> at <?= htmlspecialchars($row['venue']) ?> <br>
                Price: $<?= htmlspecialchars($row['price']) ?> <br>
                Purchased on: <?= htmlspecialchars($row['purchase_date']) ?>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
