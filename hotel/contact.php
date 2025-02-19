<?php
include 'config.php';
include 'header.php';

$messageSent = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO enquiries (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        $messageSent = true;
    } else {
        $error = "All fields are required!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIVINA Hotel | Contact Us</title>
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
</head>
<body>
<div class="mb-5">DIVINA</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white">📩 Contact Us</div>
                <div class="card-body">
                    <?php if ($messageSent): ?>
                        <div class="alert alert-success text-center">Your message has been sent successfully!</div>
                    <?php elseif (!empty($error)): ?>
                        <div class="alert alert-danger text-center"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label text-white">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
