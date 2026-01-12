<?php

include '../meddb/meddb.php';
include '../auth_check.php';


$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

/* TOTAL DONATIONS */
$totalDonationsQuery = $conn->prepare(
    "SELECT COUNT(*) FROM donations WHERE user_id = ?"
);
$totalDonationsQuery->bind_param("i", $user_id);
$totalDonationsQuery->execute();
$totalDonationsQuery->bind_result($total_donations);
$totalDonationsQuery->fetch();
$totalDonationsQuery->close();

/* PENDING DONATIONS */
$pendingQuery = $conn->prepare(
    "SELECT COUNT(*) FROM donations WHERE user_id = ? AND status = 'Pending'"
);
$pendingQuery->bind_param("i", $user_id);
$pendingQuery->execute();
$pendingQuery->bind_result($pending_donations);
$pendingQuery->fetch();
$pendingQuery->close();

/* APPROVED DONATIONS */
$approvedQuery = $conn->prepare(
    "SELECT COUNT(*) FROM donations WHERE user_id = ? AND status = 'Approved'"
);
$approvedQuery->bind_param("i", $user_id);
$approvedQuery->execute();
$approvedQuery->bind_result($approved_donations);
$approvedQuery->fetch();
$approvedQuery->close();

/* COMPLETED DONATIONS */
$completedQuery = $conn->prepare(
    "SELECT COUNT(*) FROM donations WHERE user_id = ? AND status = 'Completed'"
);
$completedQuery->bind_param("i", $user_id);
$completedQuery->execute();
$completedQuery->bind_result($completed_donations);
$completedQuery->fetch();
$completedQuery->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MedDonation | User Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="user.css">
</head>

<body>

    <!-- ================= HEADER ================= -->
    <header class="dashboard-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h4 class="logo">
                <img
                    src="../logo.png"
                    alt="logo"
                    class="me-2 rounded-circle" /> MedDonation
            </h4>

            <div class="user-info">
                <span class="me-3">Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong></span>

                <a href="mydonation.php" class="btn btn-sm btn-outline-light me-2">
                    My Donations
                </a>
                
                <a href="my_request.php" class="btn btn-sm btn-outline-light me-2">My Requests</a>

                <a href="myactivity.php" class="btn btn-sm btn-outline-light me-2">Recent Activity</a>


                <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
            </div>
        </div>
    </header>

    <!-- ================= USER STATS ================= -->
    <div class="row text-center mb-5">

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <i class="fa-solid fa-hand-holding-medical"></i>
                <h4><?php echo $total_donations; ?></h4>
                <p>Total Donations</p>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <i class="fa-solid fa-notes-medical"></i>
                <h4><?php echo $pending_donations; ?></h4>
                <p>Pending</p>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <i class="fa-solid fa-circle-check"></i>
                <h4><?php echo $approved_donations; ?></h4>
                <p>Approved</p>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <i class="fa-solid fa-clock"></i>
                <h4><?php echo $completed_donations; ?></h4>
                <p>Completed</p>

            </div>
        </div>

    </div>

    


    <!-- ================= MAIN CONTENT ================= -->
    <section class="container mt-5">

        <h3 class="text-center mb-4">What would you like to do?</h3>

        <div class="row justify-content-center g-4">

            <!-- Donate Medicine Card -->
            <div class="col-md-5">
                <div class="action-card donate">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                    <h4>Donate Medicine</h4>
                    <p>Donate unused medicines to help people in need.</p>
                    <a href="donate.php" class="btn btn-success w-100">Donate Now</a>
                </div>
            </div>

            <!-- Request Medicine Card -->
            <div class="col-md-5">
                <div class="action-card request">
                    <i class="fa-solid fa-notes-medical"></i>
                    <h4>Request Medicine</h4>
                    <p>Request medicines that you or others need urgently.</p>
                    <a href="request.php" class="btn btn-primary w-100">Request Now</a>
                </div>
            </div>

        </div>

    </section>


    <footer class="footer">

        <!-- Footer Bottom -->
        <div class="text-center">
            <p>&copy; 2025 All rights reserved by: <span>MedDonation</span></p>
        </div>

    </footer>
</body>

</html>