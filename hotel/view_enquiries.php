<?php
include 'config.php';
include 'admin_header.php';

// Check if admin is logged in

// Fetch all enquiries
$stmt = $pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC");
$enquiries = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2 class="text-center text-light mb-4">Customer Enquiries</h2>
    
    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or message..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover text-center" id="enquiriesTable">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquiries as $enquiry): ?>
                <tr>
                    <td><?= htmlspecialchars($enquiry['name']) ?></td>
                    <td><?= htmlspecialchars($enquiry['email']) ?></td>
                    <td><?= htmlspecialchars($enquiry['message']) ?></td>
                    <td><?= date('M d, Y - h:i A', strtotime($enquiry['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Search Filtering -->
<script>
function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#enquiriesTable tbody tr");

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
}
</script>

<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        font-family: 'Poppins', sans-serif;
    }
    .table {
        border-radius: 12px;
        overflow: hidden;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
