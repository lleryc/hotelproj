<?php

include 'config.php';
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch reservations and payment details for the logged-in user
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT reservations.*, rooms.room_number, rooms.type, rooms.price, payments.card_holder, payments.amount, payments.payment_date 
                       FROM reservations 
                       JOIN rooms ON reservations.room_id = rooms.id 
                       LEFT JOIN payments ON reservations.id = payments.reservation_id 
                       WHERE reservations.user_id = ?");
$stmt->execute([$userId]);
$reservations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIVINA Hotel | Reservation System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            color:white;
        }
        .card-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            background: transparent;
            color: #ffcc00;
            border-bottom: 2px solid #ffcc00;
        }

        .table {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
</style>
<p class="mt-3"> DIVINA </p>
<div class="container mt-5">
   

    <?php if (empty($reservations)): ?>
        <div class="alert alert-warning text-center">You have no reservations yet. <a href="rooms.php" class="alert-link">Book a room now!</a></div>
    <?php else: ?>
        <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header text-white">Reservation List</div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room #</th>
                        <th>Type</th>
                        <th>Price/Night</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total Paid</th>
                        <th>Card Holder</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['room_number']) ?></td>
                        <td><?= htmlspecialchars($reservation['type']) ?></td>
                        <td>$<?= number_format($reservation['price'], 2) ?></td>
                        <td><?= htmlspecialchars($reservation['check_in']) ?></td>
                        <td><?= htmlspecialchars($reservation['check_out']) ?></td>
                        <td><?= empty($reservation['amount']) ? '<span class="text-danger">Pending</span>' : '$' . number_format($reservation['amount'], 2) ?></td>
                        <td><?= empty($reservation['card_holder']) ? '<span class="text-danger">Not Paid</span>' : htmlspecialchars($reservation['card_holder']) ?></td>
                        <td><?= empty($reservation['payment_date']) ? '<span class="text-danger">-</span>' : htmlspecialchars($reservation['payment_date']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
