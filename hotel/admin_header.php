<?php session_start(); ?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
              /* Modern Navbar Styling */
              .navbar {
            background: rgba(20, 30, 48, 0.8); /* Transparent glass effect */
            backdrop-filter: blur(10px);
            transition: background 0.3s ease-in-out;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #ffcc00 !important;
        }
        .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            color: white !important;
            transition: color 0.3s ease-in-out;
        }
        .nav-link:hover {
            color: #ffcc00 !important;
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">DIVINA Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_rooms.php">Manage Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_reservations.php">View Reservations</a>
                </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="view_enquiries.php">View Enquiries</a>
                    </li>
                
            </ul>
        </div>
    </div>
</nav>