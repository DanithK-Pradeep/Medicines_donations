<?php
include 'admin_auth.php';
include '../meddb/meddb.php';





/* Handle approve / reject */
if (isset($_GET['action'], $_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] === 'approve') {
        $conn->query("UPDATE donations SET status='approved' WHERE id=$id");
    }

    if ($_GET['action'] === 'reject') {
        $conn->query("UPDATE donations SET status='rejected' WHERE id=$id");
    }

    header("Location: donations.php");
    exit();
}

/* Fetch donations */
$sql = "SELECT * FROM donations ORDER BY id DESC";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Donations</title>
    <link rel="icon" type="image/x-icon" href="../medicine_18550325.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar">
                <div class="brand">
                    <div class="brand-badge"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <span style="color: white;">Admin Panel</span>
                </div>
                <hr>
                <?php include 'sidecar.php'; ?>
            </div>

            <!-- Content -->
            <div class="col-md-10 admin-content">

                <div class="admin-header mb-3">
                    <h2 class="title">Donation Management</h2>
                    <p class="sub">Approve or reject donations</p>
                </div>

                <div class="card stat-card">
                    <div class="card-body table-responsive">

                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Donor</th>
                                    <th>Email</th>
                                    <th>Medicine</th>
                                    <th>Quantity</th>
                                    <th>Donation Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= htmlspecialchars($row['doner_name']) ?></td>
                                        <td><?= htmlspecialchars($row['doner_email']) ?></td>
                                        <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                                        <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>


                                        <td>
                                            <span class="badge bg-<?=
                                                                    $row['status'] === 'approved' ? 'success' : ($row['status'] === 'rejected' ? 'danger' : 'warning')
                                                                    ?>">
                                                <?= ucfirst($row['status']) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php if ($row['status'] === 'pending'): ?>
                                                <a class="btn btn-sm btn-success"
                                                    href="?action=approve&id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Approve this donation?')">
                                                    <i class="fa-solid fa-check"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger"
                                                    href="?action=reject&id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Reject this donation?')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                                <a class="btn btn-sm btn-primary"
                                                    href="donation_details.php?id=<?= $row['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                            <?php else: ?>
                                                <span class="text-muted">Completed</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>