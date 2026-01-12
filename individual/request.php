<?php
include '../meddb/meddb.php';
include '../auth_check.php';


$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

if (isset($_POST['request'])) {

    $medicine_name = trim($_POST['medicine_name']);
    $quantity      = (int) $_POST['quantity'];
    $needed_date   = $_POST['needed_date'];
    $reason        = trim($_POST['reason']);

    if ($medicine_name === "" || $quantity <= 0 || $needed_date === "") {
        echo "<script>alert('Please fill all required fields correctly.');</script>";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO requests (user_id, user_email ,medicine_name, quantity, needed_date,  reason)
             VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ississ", $user_id, $user_email, $medicine_name, $quantity, $needed_date, $reason);
        if ($stmt->execute()) {
            echo "<script>alert('Request submitted successfully!'); window.location.href='user.php';</script>";
        } else {
            echo "<script>alert('Request failed. Please try again.');</script>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request Medicine | MedDonation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../individual/request.css" />
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card req-card p-4">
                    <h3 class="text-center mb-4">Request Medicine</h3>

                    <form method="post">

                        <div class="mb-3">
                            <label class="form-label">Medicine Name *</label>
                            <input type="text" name="medicine_name" class="form-control"
                                placeholder="Eg: Insulin / Paracetamol 500mg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity *</label>
                            <input type="number" name="quantity" class="form-control"
                                placeholder="Eg: 2 / 10" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Needed Date *</label>
                            <input type="date" name="needed_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reason (Optional)</label>
                            <textarea name="reason" class="form-control" rows="3"
                                placeholder="Eg: For patient, urgent requirement..."></textarea>
                        </div>

                        <button type="submit" name="request" class="btn btn-primary w-100">
                            Submit Request
                        </button>

                        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='user.php'">
                            Back to Home
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    

</body>

</html>