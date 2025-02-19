<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
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
        .hero {
            text-align: center;
            padding: 80px 20px;
        }
        .hero h2 {
            font-size: 3rem;
            font-weight: bold;
            color: white;
        }
        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease-in-out;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card a {
            width: 100%;
            font-weight: bold;
        }
        .btn {
            border-radius: 8px;

        }
    </style>
</head>
<body>
    

    <div class="container hero mt-5">
        <h2>Welcome to <span style="color: #ffcc00;">DIVINA Hotel</span></h2>
        <p class="lead" style="color: whitesmoke;">Luxury and comfort await you. Book your stay now!</p>
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8aG90ZWx8ZW58MHx8MHx8fDA%3D" alt="Luxury Hotel Exterior" class="img-fluid img-thumbnail" style="height: 450px;">
    </div>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
