<?php include('db.php'); session_start(); if (!isset($_SESSION['userid'])) header("Location: login.php");

if (isset($_GET['buy'])) {
    $ticket_id = intval($_GET['buy']);
    $user_id = $_SESSION['userid'];
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, ticket_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $ticket_id);
    $stmt->execute();
    echo "<p>Purchase successful!</p>";
}

$categories = ['Music', 'Movie', 'Football'];
$cat = $_GET['category'] ?? 'Music';
$stmt = $conn->prepare("SELECT * FROM tickets WHERE category=?");
$stmt->bind_param("s", $cat);
$stmt->execute();
$tickets = $stmt->get_result();
?>

<form method="GET">
    <select name="category" onchange="this.form.submit()">
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c ?>" <?= $c == $cat ? 'selected' : '' ?>><?= $c ?></option>
        <?php endforeach; ?>
    </select>
</form>

<ul>
<?php while ($row = $tickets->fetch_assoc()): ?>
    <li>
        <strong><?= $row['event_name'] ?></strong><br>
        Date: <?= $row['event_date'] ?><br>
        Venue: <?= $row['venue'] ?><br>
        Price: $<?= $row['price'] ?><br>
        <a href="buy.php?buy=<?= $row['id'] ?>&category=<?= $cat ?>"><button>Buy</button></a>
    </li>
<?php endwhile; ?>
</ul>
<a href="dashboard.php">Back</a>