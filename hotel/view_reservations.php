<?php

include 'config.php';
include 'admin_header.php';

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all reservations with guest and payment details
$stmt = $pdo->query("SELECT reservations.*, users.name AS guest_name, users.email, rooms.room_number, rooms.type, rooms.price, payments.card_holder, payments.amount, payments.payment_date 
                     FROM reservations 
                     JOIN users ON reservations.user_id = users.id 
                     JOIN rooms ON reservations.room_id = rooms.id 
                     LEFT JOIN payments ON reservations.id = payments.reservation_id");
$reservations = $stmt->fetchAll();
?>

<div class="container mt-5">
    
    <?php if (empty($reservations)): ?>
        <div class="alert alert-info">No reservations found.</div>
    <?php else: ?>
        <div class="col-md-16">
            <div class="card shadow-lg bg-dark text-light p-4">
                <h3 class="text-center">Reservation List</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Email</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Price per Night</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total Amount</th>
                        <th>Card Holder</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= $reservation['guest_name'] ?></td>
                        <td><?= $reservation['email'] ?></td>
                        <td><?= $reservation['room_number'] ?></td>
                        <td><?= $reservation['type'] ?></td>
                        <td>$<?= $reservation['price'] ?></td>
                        <td><?= $reservation['check_in'] ?></td>
                        <td><?= $reservation['check_out'] ?></td>
                        <td>$<?= $reservation['amount'] ?></td>
                        <td><?= $reservation['card_holder'] ?></td>
                        <td><?= $reservation['payment_date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        font-family: 'Poppins', sans-serif;
    }
    .card {
        border-radius: 12px;
    }
    .btn:hover {
        opacity: 0.8;
    }
</style>
