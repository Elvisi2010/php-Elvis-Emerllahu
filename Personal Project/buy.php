<?php
include('db.php');
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit(); // Always exit after a header redirect
}

if (isset($_GET['buy'])) {
    $ticket_id = intval($_GET['buy']); // Sanitize input
    $user_id = $_SESSION['userid'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, ticket_id, purchase_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $ticket_id);

    if ($stmt->execute()) {
        echo "<p class='success'>Purchase successful!</p>"; // Use a class for styling
    } else {
        echo "<p class='error'>Purchase failed: " . $stmt->error . "</p>"; // Display error message
    }

    $stmt->close();
}

$categories = ['Music', 'Movie', 'Football'];
$cat = $_GET['category'] ?? 'Music'; // Use null coalescing operator

// Prepared statement for selecting tickets
$stmt = $conn->prepare("SELECT * FROM tickets WHERE category = ?");
$stmt->bind_param("s", $cat);
$stmt->execute();
$tickets = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('dashboard.php'); // Include the dashboard navigation ?>

<div class="container">
    <h1>Buy Tickets</h1>

    <form method="GET">
        <label for="category">Select Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <?php foreach ($categories as $c): ?>
                <option value="<?= htmlspecialchars($c) ?>" <?= ($c == $cat) ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
            <?php endforeach; ?>
        </select>
    </form>

    <ul>
        <?php while ($row = $tickets->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['event_name']) ?></strong><br>
                Date: <?= htmlspecialchars($row['event_date']) ?><br>
                Venue: <?= htmlspecialchars($row['venue']) ?><br>
                Price: $<?= htmlspecialchars($row['price']) ?><br>
                <a href="buy.php?buy=<?= $row['id'] ?>&category=<?= htmlspecialchars($cat) ?>"><button>Buy</button></a>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
