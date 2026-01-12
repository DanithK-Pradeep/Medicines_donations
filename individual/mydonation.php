<?php
include '../meddb/meddb.php';
include '../auth_check.php';

$user_id = $_SESSION['user_id'];

/* Fetch donations of logged-in user */
$sql = "SELECT id, medicine_name, quantity, expiry_date, status, created_at 
        FROM donations 
        WHERE user_id = ?
        ORDER BY created_at DESC";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);


$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Donations | MedDonation</title>
    <link rel="icon" type="image/x-icon" href="../logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f8fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-title {
            font-weight: 700;
            color: #0d6efd;
        }

        .cardx {
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            font-size: 13px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #cfe2ff;
            color: #084298;
        }

        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-rejected {
            background: #f8d7da;
            color: #842029;
        }

        .back-btn {
            border-radius: 20px;
            padding: 6px 15px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="page-title">My Donations</h3>
            <a href="user.php" class="btn btn-secondary btn-sm back-btn">Back to Dashboard</a>
        </div>

        <div class="card donation-card">
            <div class="card-body">

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Donated On</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                $statusClass = "status-" . strtolower($row['status']);

                        ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['medicine_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['expiry_date']; ?></td>
                                    <td>
                                        <span class="status <?php echo $statusClass; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <?php if ($row['status'] === 'pending') { ?>
                                            <a class="btn btn-sm btn-danger"
                                                href="../individual/delete_donation.php?id=<?php echo (int)$row['id']; ?>"
                                                onclick="return confirm('Cancel this donation?');">
                                                Cancel
                                            </a>
                                        <?php } else { ?>
                                            <span class="text-muted">N/A</span>
                                        <?php } ?>
                                    </td>

                                </tr>
                        <?php
                                $count++;
                            }
                        } else {
                            echo "<tr>
                            <td colspan='6'>No donations found</td>
                          </tr>";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>