<?php
include '../meddb/meddb.php';
include '../auth_check.php';

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (isset($_POST['donate'])) {



    $medicine_name = $_POST['medicine_name'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];
    $description = $_POST['description'];
    

    /* Basic validation */
    if (empty($medicine_name) || empty($quantity) || empty($expiry_date)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO donations (user_id, doner_name,doner_email, medicine_name, quantity, expiry_date, description)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "isssiss",
            $user_id,
            $user_name,
            $user_email,
            $medicine_name,
            $quantity,
            $expiry_date,
            $description
        );

        if ($stmt->execute()) {
            echo "<script>alert('Donation submitted successfully!'); window.location.href='user.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate Medicine | MedDonation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow p-4">
                <h3 class="text-center mb-4">Donate Medicine</h3>

                <form method="post">

                    <div class="mb-3">
                        <label class="form-label">Medicine Name *</label>
                        <input type="text" class="form-control" name="medicine_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity *</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Expiry Date *</label>
                        <input type="date" class="form-control" name="expiry_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (optional)</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>

                    <button type="submit" name="donate" class="btn btn-success w-100">
                        Submit Donation
                    </button>

                    <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='user.php'">
                        Back to Home
                    </button>

                

                </form>
            </div>

        </div>
    </div>
</div>

<footer class="footer">

        <!-- Footer Bottom -->
        <div class="text-center mt-4 mb-2 ">
            <p>&copy; 2025 All rights reserved by: <span>MedDonation</span></p>
        </div>

    </footer>
</body>
</html>
