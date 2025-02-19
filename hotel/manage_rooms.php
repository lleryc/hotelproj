<?php
include 'config.php';

// Check if admin is logged in

// Add Room
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO rooms (room_number, type, price, status) VALUES (?, ?, ?, 'available')");
    $stmt->execute([$room_number, $type, $price]);
    header("Location: manage_rooms.php");
    exit();
}

// Fetch all rooms
$stmt = $pdo->query("SELECT * FROM rooms");
$rooms = $stmt->fetchAll();

if (isset($_GET['delete'])) {
    $room_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->execute([$room_id]);
    header("Location: manage_rooms.php");
    exit();
}
?>

<?php include 'admin_header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-light">Manage Rooms</h2>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg bg-dark text-light p-4">
                <h3 class="text-center">Add New Room</h3>
                <form action="manage_rooms.php" method="POST">
                    <div class="mb-3">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="room_number" name="room_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <button type="submit" name="add_room" class="btn btn-success w-100">Add Room</button>
                </form>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card shadow-lg bg-dark text-light p-4">
                <h3 class="text-center">Room List</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Room Number</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room): ?>
                            <tr class="text-center">
                                <td><?= $room['room_number'] ?></td>
                                <td><?= $room['type'] ?></td>
                                <td>$<?= $room['price'] ?></td>
                                <td>
                                    <span class="badge <?= $room['status'] == 'available' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ucfirst($room['status']) ?>
                                    </span>
                                </td>
                                <td>
                                 
                                    <a href="manage_rooms.php?delete=<?= $room['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
    }
    .btn:hover {
        opacity: 0.8;
    }
</style>
