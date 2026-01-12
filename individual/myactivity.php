<?php

include '../meddb/meddb.php';
include '../auth_check.php';

$user_id = $_SESSION['user_id'];

/* ================= RECENT ACTIVITY ================= */

$sqlActivity = "
    SELECT 
        'Donation' AS type,
        medicine_name,
        quantity,
        status,
        created_at
    FROM donations
    WHERE user_id = ?

    UNION ALL

    SELECT
        'Request' AS type,
        medicine_name,
        quantity,
        status,
        created_at
    FROM requests
    WHERE user_id = ?

    ORDER BY created_at DESC
    LIMIT 5
";

$stmtActivity = $conn->prepare($sqlActivity);
$stmtActivity->bind_param("ii", $user_id, $user_id);
$stmtActivity->execute();
$activityResult = $stmtActivity->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">
    <title>activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .page-title {
            font-weight: 700;
            color: #0d6efd;
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
            <h3 class="page-title text-center mb-0">Recent Activity</h3>
            <a href="user.php" class="btn btn-secondary btn-sm back-btn">Back to Dashboard</a>
        </div>
        <div class="card donation-card">
            <div class="card-body">

                <table class="table table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($activityResult->num_rows > 0) { ?>
                            <?php while ($row = $activityResult->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php if ($row['type'] === 'Donation') { ?>
                                            <span class="badge bg-success">Donation</span>
                                        <?php } else { ?>
                                            <span class="badge bg-primary">Request</span>
                                        <?php } ?>
                                    </td>

                                    <td><?php echo htmlspecialchars($row['medicine_name']); ?></td>
                                    <td><?php echo (int)$row['quantity']; ?></td>

                                    <td>
                                        <span class="status status-<?php echo strtolower($row['status']); ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>

                                    <td><?php echo date("d M Y", strtotime($row['created_at'])); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5">No recent activity</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>


</body>

</html>