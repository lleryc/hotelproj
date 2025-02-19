<?php
include 'config.php';
// Generate reports using SQL queries
$reservations = $pdo->query("SELECT * FROM reservations")->fetchAll();
$revenue = $pdo->query("SELECT SUM(rooms.price) FROM reservations JOIN rooms ON reservations.room_id = rooms.id")->fetchColumn();
?>
<!-- Display reports and statistics -->
<?php


// Check if admin is logged in


// Fetch total revenue
$revenue = $pdo->query("SELECT SUM(rooms.price) FROM reservations JOIN rooms ON reservations.room_id = rooms.id")->fetchColumn();

// Fetch total reservations
$totalReservations = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
?>

<?php include 'admin_header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Generate Reports</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$<?= $revenue ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Reservations</h5>
                    <p class="card-text"><?= $totalReservations ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
