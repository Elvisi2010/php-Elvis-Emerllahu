<?php
include('db.php');
session_start();

$userId = $_SESSION['userid'] ?? null;
if (!$userId) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Sample events data
$eventsData = [
    'Concerts' => [
        ['id' => 1, 'name' => 'Rock Night Live', 'date' => '2025-07-20', 'venue' => 'Arena XYZ', 'tickets' => [
            ['type' => 'General', 'price' => 50],
            ['type' => 'VIP', 'price' => 120],
        ]],
        ['id' => 2, 'name' => 'Jazz Festival', 'date' => '2025-08-15', 'venue' => 'City Park', 'tickets' => [
            ['type' => 'General', 'price' => 30],
        ]],
    ],
    'Movies' => [
        ['id' => 3, 'name' => 'Blockbuster Movie', 'date' => '2025-06-25', 'venue' => 'Cinema Hall 1', 'tickets' => [
            ['type' => 'Standard', 'price' => 12],
        ]],
    ],
    'Football Matches' => [
        ['id' => 4, 'name' => 'City FC vs United', 'date' => '2025-07-05', 'venue' => 'Stadium ABC', 'tickets' => [
            ['type' => 'Regular', 'price' => 40],
            ['type' => 'Premium', 'price' => 80],
        ]],
    ],
    'Music Festivals' => [
        ['id' => 5, 'name' => 'Summer Beats Festival', 'date' => '2025-09-10', 'venue' => 'Open Air Grounds', 'tickets' => [
            ['type' => 'General', 'price' => 60],
            ['type' => 'VIP', 'price' => 150],
        ]],
    ],
];

// Initialize variables
$selectedEventType = $_POST['event_type'] ?? null;
$selectedEventId = $_POST['event_id'] ?? null;
$quantities = $_POST['quantity'] ?? [];
$errors = [];
$totalPrice = 0;
$selectedEvent = null;
$ticketsBought = false; // Flag to show confirmation

// Find the selected event from posted values
if ($selectedEventType && $selectedEventId) {
    foreach ($eventsData[$selectedEventType] as $event) {
        if ($event['id'] == $selectedEventId) {
            $selectedEvent = $event;
            break;
        }
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $selectedEvent) {
    // Calculate total price & validate quantities
    foreach ($selectedEvent['tickets'] as $ticket) {
        $type = $ticket['type'];
        $qty = intval($quantities[$type] ?? 0);
        if ($qty < 0) {
            $errors[] = "Quantity for $type cannot be negative.";
        }
        $totalPrice += $qty * $ticket['price'];
    }

    if (empty($errors) && $totalPrice > 0) {
        // Insert ticket purchases into DB
        foreach ($selectedEvent['tickets'] as $ticket) {
            $type = $ticket['type'];
            $qty = intval($quantities[$type] ?? 0);
            if ($qty > 0) {
                $price = $ticket['price'];
                $total = $price * $qty;

                $stmt = $conn->prepare("INSERT INTO ticket_purchases (user_id, event_type, event_name, ticket_type, quantity, price_per_ticket, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($stmt === false) {
                    $errors[] = "Database error: " . htmlspecialchars($conn->error);
                    break;
                }
                $stmt->bind_param("isssidd", $userId, $selectedEventType, $selectedEvent['name'], $type, $qty, $price, $total);
                $stmt->execute();
                $stmt->close();
            }
        }
        if (empty($errors)) {
            $ticketsBought = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Buy Tickets - Ticket.al</title>
<style>
  body {
    font-family: Arial, sans-serif;
    max-width: 700px;
    margin: 40px auto;
    padding: 20px;
    background: #f7f7f7;
    color: #333;
  }
  h1, h3 {
    color: #222;
  }
  form {
    background: #fff;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 0 10px #ccc;
  }
  label {
    display: block;
    margin: 15px 0 6px;
  }
  select, input[type=number] {
    padding: 8px;
    width: 100%;
    max-width: 300px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  input[type=number] {
    width: 80px;
  }
  .ticket-row {
    margin: 10px 0;
  }
  button {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 1.1em;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
  }
  button:disabled {
    background: #aaa;
    cursor: not-allowed;
  }
  .confirmation {
    background: #d4edda;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #c3e6cb;
    color: #155724;
    margin-bottom: 20px;
  }
  .error {
    color: #d00;
  }
</style>
</head>
<body>

<h1>Buy Tickets</h1>

<?php if ($ticketsBought): ?>
  <div class="confirmation">
    <strong>Success!</strong> Tickets bought.
  </div>
<?php endif; ?>

<form method="POST" id="ticketForm">
  <label for="event_type">Select Event Type:</label>
  <select name="event_type" id="event_type" onchange="this.form.submit()" required <?= $ticketsBought ? 'disabled' : '' ?>>
    <option value="">-- Choose Event Type --</option>
    <?php foreach ($eventsData as $type => $events): ?>
      <option value="<?= htmlspecialchars($type) ?>" <?= ($type === $selectedEventType) ? 'selected' : '' ?>>
        <?= htmlspecialchars($type) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <?php if ($selectedEventType): ?>
    <label for="event_id">Select Event:</label>
    <select name="event_id" id="event_id" onchange="this.form.submit()" required <?= $ticketsBought ? 'disabled' : '' ?>>
      <option value="">-- Choose Event --</option>
      <?php foreach ($eventsData[$selectedEventType] as $event): ?>
        <option value="<?= $event['id'] ?>" <?= ($event['id'] == $selectedEventId) ? 'selected' : '' ?>>
          <?= htmlspecialchars($event['name']) ?> - <?= htmlspecialchars($event['date']) ?> @ <?= htmlspecialchars($event['venue']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>

  <?php if ($selectedEvent): ?>
    <h3>Tickets for <?= htmlspecialchars($selectedEvent['name']) ?></h3>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $err) echo "<p>" . htmlspecialchars($err) . "</p>"; ?>
      </div>
    <?php endif; ?>

    <?php foreach ($selectedEvent['tickets'] as $ticket): ?>
      <div class="ticket-row">
        <label>
          <?= htmlspecialchars($ticket['type']) ?> ($<?= number_format($ticket['price'], 2) ?> each):
          <input
            type="number"
            name="quantity[<?= htmlspecialchars($ticket['type']) ?>]"
            min="0"
            value="<?= intval($quantities[$ticket['type']] ?? 0) ?>"
            <?= $ticketsBought ? 'disabled' : '' ?>
          />
        </label>
      </div>
    <?php endforeach; ?>

    <button type="submit" <?= $ticketsBought ? 'disabled' : '' ?>>Buy Tickets</button>
  <?php endif; ?>
</form>

</body>
</html>


