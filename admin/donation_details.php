<?php
include 'admin_auth.php';
include '../meddb/meddb.php';

if (!isset($_GET['id'])) {
    header("Location: donations.php");
    exit();
}

$id = (int) $_GET['id'];

/* Approve / Reject actions from details page */
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'approve') {
        $conn->query("UPDATE donations SET status='approved' WHERE id=$id AND status='pending'");
    } elseif ($_GET['action'] === 'reject') {
        $conn->query("UPDATE donations SET status='rejected' WHERE id=$id AND status='pending'");
    }
    header("Location: donation_details.php?id=$id");
    exit();
}

/* Fetch donation request */
$sql = "SELECT id, doner_name, doner_email, quantity, status, created_at 
        FROM donations 
        WHERE id=$id";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

if ($result->num_rows === 0) {
    die("Request not found.");
}

$row = $result->fetch_assoc();

function badgeClass($status)
{
    if ($status === 'approved') return 'success';
    if ($status === 'rejected') return 'danger';
    return 'warning'; // pending
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Donation Details</title>
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
                    <div class="brand-badge"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <span>Admin Panel</span>
                </div>
                <hr>
                <?php include 'sidecar.php'; ?>
            </div>

            <!-- Content -->
            <div class="col-md-10 admin-content">

                <div class="admin-header mb-3">
                    <h2 class="title">Donation Details</h2>
                    <p class="sub">Review donation request and take action</p>
                </div>

                <div class="card stat-card">
                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Donation ID</div>
                                    <div class="fw-bold">#<?= (int)$row['id'] ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Status</div>
                                    <span class="badge bg-<?= badgeClass($row['status']) ?>">
                                        <?= htmlspecialchars(ucfirst($row['status'])) ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Donor Name</div>
                                    <div class="fw-bold"><?= htmlspecialchars($row['doner_name']) ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Email</div>
                                    <div class="fw-bold"><?= htmlspecialchars($row['doner_email']) ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Quantity</div>
                                    <div class="fw-bold"><?= number_format((float)$row['quantity']) ?></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded bg-light">
                                    <div class="text-muted small">Created On</div>
                                    <div class="fw-bold"><?= htmlspecialchars($row['created_at']) ?></div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2">
                            <?php if ($row['status'] === 'pending'): ?>
                                <a class="btn btn-success"
                                    href="donation_details.php?id=<?= (int)$row['id'] ?>&action=approve"
                                    onclick="return confirm('Approve this request?')">
                                    <i class="fa-solid fa-check"></i> Approve
                                </a>

                                <a class="btn btn-danger"
                                    href="donation_details.php?id=<?= (int)$row['id'] ?>&action=reject"
                                    onclick="return confirm('Reject this request?')">
                                    <i class="fa-solid fa-xmark"></i> Reject
                                </a>
                            <?php endif; ?>

                            <a class="btn btn-secondary" href="donations.php">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>