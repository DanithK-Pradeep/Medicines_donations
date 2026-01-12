<?php

include '../meddb/meddb.php';
include '../auth_check.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT 
    requests.id,
    requests.medicine_name,
    requests.quantity,
    requests.needed_date,
    requests.status,
    requests.created_at,
    donations.doner_name,
    donations.doner_email
FROM requests
LEFT JOIN donations ON requests.donation_id = donations.id
WHERE requests.user_id = ?
ORDER BY requests.created_at DESC";

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
    <title>My Requests | MedDonation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h3 class="page-title">My Requests</h3>
            <a href="user.php" class="btn btn-secondary btn-sm back-btn">Back to Dashboard</a>
        </div>

        <div class="card cardx">
            <div class="card-body">

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Needed Date</th>
                            <th>Status</th>
                            <th>Requested On</th>
                            <th>Action</th>
                            <th>Donor Info</th>

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
                                    <td><?php echo htmlspecialchars($row['medicine_name']); ?></td>
                                    <td><?php echo (int)$row['quantity']; ?></td>
                                    <td><?php echo htmlspecialchars($row['needed_date']); ?></td>
                                    <td>
                                        <span class="status <?php echo $statusClass; ?>">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td>
                                        <?php if ($row['status'] === 'pending') { ?>
                                            <a class="btn btn-sm btn-danger"
                                                href="../individual/delete_request.php?id=<?php echo (int)$row['id']; ?>"
                                                onclick="return confirm('Cancel this request?');">
                                                Cancel
                                            </a>
                                        <?php } else { ?>
                                            <span class="text-muted">N/A</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] === 'completed'): ?>
                                            <strong><?= htmlspecialchars($row['doner_name']) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($row['doner_email']) ?></small>
                                        <?php else: ?>
                                            <span class="text-muted">Not assigned</span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                        <?php
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>No requests found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>