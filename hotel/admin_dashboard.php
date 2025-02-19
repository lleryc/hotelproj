<?php
include 'config.php';
// Check admin authentication
?>
<?php include 'admin_header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-light">Admin Dashboard</h2>
    <div class="row justify-content-center">
        <div class="col-md-3 mb-3">
            <div class="card shadow-lg text-center bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Manage Rooms</h5>
                    <a href="manage_rooms.php" class="btn btn-light fw-bold">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-lg text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">View Reservations</h5>
                    <a href="view_reservations.php" class="btn btn-light fw-bold">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-lg text-center bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">View Enquiries</h5>
                    <a href="view_enquiries.php" class="btn btn-light fw-bold">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-lg text-center bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Generate Reports</h5>
                    <a href="reports.php" class="btn btn-dark fw-bold">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        font-family: 'Poppins', sans-serif;
    }
    .card {
        border-radius: 12px;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.05);
    }
</style>
