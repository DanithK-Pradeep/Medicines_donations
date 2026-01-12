<?php include 'admin_auth.php'; ?>
<?php include '../meddb/meddb.php'; ?>

<?php
$totalUsers     = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$totalRequests  = $conn->query("SELECT COUNT(*) FROM requests")->fetch_row()[0];
$pendingReq     = $conn->query("SELECT COUNT(*) FROM requests WHERE status='pending'")->fetch_row()[0];
$totalDonations = $conn->query("SELECT COUNT(*) FROM donations")->fetch_row()[0];


?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 admin-sidebar">

                <div class="brand">
                    <div class="brand-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <span style="color: white;">Admin Panel</span>
                </div>

                <hr>

                <?php include 'sidecar.php'; ?>

            </div>


            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <h3 class="mb-4">Admin Dashboard</h3>

                <div class="row g-4">

                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5>Total Users</h5>
                                <h2><?= $totalUsers ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5>Total Requests</h5>
                                <h2><?= $totalRequests ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5>Pending Requests</h5>
                                <h2><?= $pendingReq ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5>Total Donations</h5>
                                <h2><?= $totalDonations ?></h2>
                            </div>
                        </div>
                    </div>



                    <div class="card shadow mt-5">
                        <div class="card-body">
                            <h5 class="text-center mb-4">Donations vs Requests</h5>
                            <canvas id="donationRequestChart" height="90"></canvas>
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </div>
    <script>
        const ctx = document.getElementById('donationRequestChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Donations', 'Total Requests', 'Pending Requests'],
                datasets: [{
                    label: 'Count',
                    data: [
                        <?= $totalDonations ?>,
                        <?= $totalRequests ?>,
                        <?= $pendingReq ?>
                    ],
                    backgroundColor: [
                        '#198754', // green
                        '#0d6efd', // blue
                        '#ffc107' // yellow
                    ],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>