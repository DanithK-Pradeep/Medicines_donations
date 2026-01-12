<?php
include 'admin_auth.php';
include '../meddb/meddb.php';

// Handle actions
if (isset($_GET['action'], $_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] === 'delete') {
        $conn->query("DELETE FROM users WHERE id=$id AND category!='admin'");
    }

    if ($_GET['action'] === 'block') {
        $conn->query("UPDATE users SET status='blocked' WHERE id=$id AND category!='admin'");
    }

    if ($_GET['action'] === 'unblock') {
        $conn->query("UPDATE users SET status='active' WHERE id=$id");
    }

    header("Location: users.php");
    exit();
}

$result = $conn->query("SELECT id,name,email,category,status FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
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
                    <div class="brand-badge"><i class="fa-solid fa-users"></i>
                    </div>
                    <span style=color:white>Admin Panel</span>
                </div>
                <hr>
                <?php include 'sidecar.php'; ?>
            </div>


            <!-- Content -->
            <div class="col-md-10 admin-content">

                <div class="admin-header mb-3">
                    <h2 class="title">User Management</h2>
                    <p class="sub">View, block or delete users</p>
                </div>

                <div class="card stat-card">
                    <div class="card-body table-responsive">

                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>



                                        <td>
                                            <span class="badge bg-<?= $row['category'] == 'admin' ? 'primary' : 'secondary' ?>">
                                                <?= $row['category'] ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-<?= $row['status'] == 'active' ? 'success' : 'danger' ?>">
                                                <?= $row['status'] ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php if ($row['category'] !== 'admin'): ?>

                                                <?php if ($row['status'] === 'active'): ?>
                                                    <a class="btn btn-sm btn-warning"
                                                        href="?action=block&id=<?= $row['id'] ?>"
                                                        onclick="return confirm('Block this user?')">
                                                        <i class="fa-solid fa-ban"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="btn btn-sm btn-success"
                                                        href="?action=unblock&id=<?= $row['id'] ?>">
                                                        <i class="fa-solid fa-check"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <a class="btn btn-sm btn-danger"
                                                    href="?action=delete&id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Delete this user permanently?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>

                                            <?php else: ?>
                                                <span class="text-muted">Protected</span>
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