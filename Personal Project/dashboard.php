<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="dashboard">
    <h2>Welcome to Ticket Booking</h2>
    <ul>
        <li><a href="buy.php">Buy Tickets</a></li>
        <li><a href="my_tickets.php">My Tickets</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

