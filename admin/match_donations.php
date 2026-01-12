<?php
include '../meddb/meddb.php';
include '../admin/admin_auth.php';

/* Fetch pending requests */
$requests = $conn->query(
    "SELECT id, medicine_name, quantity 
     FROM requests 
     WHERE status='pending'"
);
if (!$requests) {
    die("SQL Error: " . $conn->error);
}

/* Fetch pending donations */
$donations = $conn->query(
    "SELECT id, medicine_name, quantity 
     FROM donations 
     WHERE status='approved'"
);
if (!$donations) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Match Donations | Admin</title>
    <link rel="icon" type="image/x-icon" href="../medicine_18550325.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar">
                <div class="brand">
                    <div class="brand-badge"><i class="fa-solid fa-people-group"></i></div>
                    <span style="color: white;">Admin Panel</span>
                </div>
                <hr>
                <?php include 'sidecar.php'; ?>
            </div>


            <div class="col-md-10 p-4">

                <h3 class="mb-4">Match Donations to Requests</h3>

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Request</th>
                            <th>Qty Needed</th>
                            <th>Select Donation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($requests->num_rows > 0): ?>
                            <?php while ($req = $requests->fetch_assoc()): ?>

                                <tr>
                                    <form method="post" action="link_donation.php">
                                        <td><?= htmlspecialchars($req['medicine_name']) ?></td>
                                        <td><?= (int)$req['quantity'] ?></td>

                                        <td>
                                            <select name="donation_id" class="form-select" required>
                                                <option value="">-- Select Donation --</option>

                                                <?php
                                                $donations->data_seek(0);
                                                while ($don = $donations->fetch_assoc()):
                                                    if (strcasecmp($don['medicine_name'], $req['medicine_name']) === 0):
                                                ?>
                                                        <option value="<?= $don['id'] ?>">
                                                            <?= htmlspecialchars($don['medicine_name']) ?>
                                                            (Qty: <?= $don['quantity'] ?>)
                                                        </option>
                                                <?php endif;
                                                endwhile; ?>
                                            </select>
                                        </td>

                                        <td>
                                            <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                            <button class="btn btn-success btn-sm">Link</button>
                                        </td>
                                    </form>
                                </tr>

                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No pending requests</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>