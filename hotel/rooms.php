<?php
include 'config.php';
include 'header.php';

// Fetch available rooms
$stmt = $pdo->query("SELECT * FROM rooms WHERE status = 'available'");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIVINA Hotel | Available Rooms</title>
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
            padding: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 20px rgba(255, 204, 0, 0.5);
        }
        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
            color: #ffcc00;
        }
        .card-text {
            color: white;
        }
        .btn-primary {
            width: 100%;
            background-color: #ffcc00;
            color: black;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px;
            transition: background 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #ffdb4d;
        }
    </style>
</head>
<body>
<div class="mb-5">DIVINA</div>
<div class="container">
    <h2 class="text-center mb-4">🏨 Available Rooms</h2>
    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Room <?= $room['room_number'] ?></h5>
                        <p class="card-text">Type: <?= $room['type'] ?></p>
                        <p class="card-text">Price: <strong>$<?= $room['price'] ?> / night</strong></p>
                        <a href="reservation.php?room_id=<?= $room['id'] ?>" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
