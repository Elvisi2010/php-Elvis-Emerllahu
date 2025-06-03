<?php include('db.php'); session_start(); if (!isset($_SESSION['userid'])) header("Location: login.php");

$user_id = $_SESSION['userid'];
$stmt = $conn->prepare("SELECT t.event_name, t.category, t.event_date, t.venue, t.price, p.purchase_date
                        FROM purchases p JOIN tickets t ON p.ticket_id = t.id WHERE p.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>My Purchased Tickets</h2>
<ul>
<?php while ($row = $result->fetch_assoc()): ?>
    <li>
        <?= $row['event_name'] ?> (<?= $row['category'] ?>) on <?= $row['event_date'] ?> at <?= $row['venue'] ?> <br>
        Price: $<?= $row['price'] ?> <br>
        Purchased on: <?= $row['purchase_date'] ?>
    </li>
<?php endwhile; ?>
</ul>
<a href="dashboard.php">Back</a>
