<?php
include 'header.php';
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $roomId = $_POST['room_id'];
    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];
    $cardNumber = $_POST['card_number'];
    $cardHolder = $_POST['card_holder'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Calculate total amount
    $stmt = $pdo->prepare("SELECT price FROM rooms WHERE id = ?");
    $stmt->execute([$roomId]);
    $room = $stmt->fetch();
    $days = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
    $totalAmount = $days * $room['price'];

    // Create reservation
    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $roomId, $checkIn, $checkOut]);
    $reservationId = $pdo->lastInsertId();

    // Update room status
    $pdo->prepare("UPDATE rooms SET status = 'booked' WHERE id = ?")->execute([$roomId]);

    // Save payment information
    $stmt = $pdo->prepare("INSERT INTO payments (reservation_id, card_number, card_holder, expiry_date, cvv, amount) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$reservationId, $cardNumber, $cardHolder, $expiryDate, $cvv, $totalAmount]);

    header("Location: my_reservations.php");
    exit();
}

// Fetch user details
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Fetch room details
$roomId = $_GET['room_id'];
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$roomId]);
$room = $stmt->fetch();

// Calculate total amount
$checkIn = $_POST['check_in'] ?? '';
$checkOut = $_POST['check_out'] ?? '';
$totalAmount = 0;

if ($checkIn && $checkOut) {
    $days = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
    $totalAmount = $days * $room['price'];
}
?>
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
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
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

<h1> DIVINA </h1>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white">
                    Complete Your Reservation
                </div>
                <div class="card-body">
                    <form action="reservation.php" method="POST">
                        <h5>Guest Information</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                        </div>

                        <h5 class="mt-4">Reservation Details</h5>
                        <div class="mb-3">
                            <label for="room_number" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="room_number" value="<?= $room['room_number'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="type" value="<?= $room['type'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price per Night</label>
                            <input type="text" class="form-control" id="price" value="$<?= $room['price'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-In Date</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" value="<?= $checkIn ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-Out Date</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" value="<?= $checkOut ?>" required>
                        </div>
                        

                        <h5 class="mt-4">Payment Information</h5>
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" maxlength="16" required>
                        </div>
                        <div class="mb-3">
                            <label for="card_holder" class="form-label">Card Holder Name</label>
                            <input type="text" class="form-control" id="card_holder" name="card_holder" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date (MM/YY)</label>
                                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" maxlength="5" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                            </div>
                        </div>

                        <input type="hidden" name="room_id" value="<?= $roomId ?>">
                        <center><button type="submit" class="btn btn-lg btn-success">Confirm Reservation</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>