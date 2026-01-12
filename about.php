<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us | MedDonation</title>
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="stylenav.css">
    <style>
        /* ===== PAGE HEADER ANIMATION ===== */
        .page-header {
            position: relative;
            height: 100px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;

            background: linear-gradient(120deg, #0d6efd, #20c997, #0dcaf0);
            background-size: 300% 300%;
            animation: gradientMove 10s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Overlay for better text contrast */
        .header-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            z-index: 1;
        }

        /* Header content */
        .header-content {
            position: relative;
            z-index: 2;
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            animation: float 6s ease-in-out infinite;
        }

        .shape1 {
            width: 120px;
            height: 120px;
            top: 20%;
            left: 10%;
        }

        .shape2 {
            width: 80px;
            height: 80px;
            bottom: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape3 {
            width: 60px;
            height: 60px;
            top: 15%;
            right: 30%;
            animation-delay: 4s;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* ===== MISSION & VISION STYLES ===== */
        .mission-vision {
            background: linear-gradient(to right, #99d2ef, #62a4baff);
        }

        .mission-vision .card {

            border: 1px solid rgba(0, 0, 0, 0.3);
            color: black;
            transition: 0.6s;
        }

        .mission-vision .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);

        }

        /* ===== ICON BOX STYLES ===== */
        .box-info {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            background-color: #aad1ceff;
            color: #333333;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .box-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

    </style>





</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="header-overlay"></div>

        <!-- Floating shapes -->
        <span class="shape shape1"></span>
        <span class="shape shape2"></span>
        <span class="shape shape3"></span>

        <div class="container header-content text-center">
            <h1 class="fw-bold">About MedDonation</h1>
            <p class="mt-2">
                We bring hope through medicine donation.
            </p>
        </div>
    </section>


    <!-- ABOUT CONTENT -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">

                <!-- TEXT -->
                <div class="col-lg-6 mb-4">
                    <h2 class="fw-bold mb-3">Who We Are</h2>
                    <p>
                        MedDonation is an unused medicine donation platform created to help
                        poor and needy people who struggle to access essential medicines.
                    </p>
                    <p>
                        Due to the increasing number of financially incapable individuals,
                        ensuring medication for everyone has become difficult. MedDonation
                        works to bridge this gap by connecting donors with those in need.
                    </p>
                </div>

                <!-- ICON BOX -->
                <div class="col-lg-6">
                    <div class="row text-center g-4">

                        <div class="col-md-6">
                            <div class="p-4 shadow rounded box-info">
                                <i class="fas fa-hand-holding-heart fa-2x text-danger mb-2"></i>
                                <h5>Compassion</h5>
                                <p class="small">Helping people with care and dignity.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-4 shadow rounded box-info">
                                <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                                <h5>Trust</h5>
                                <p class="small">Safe, secure, and verified process.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-4 shadow rounded box-info">
                                <i class="fas fa-users fa-2x text-success mb-2"></i>
                                <h5>Community</h5>
                                <p class="small">Connecting donors and receivers.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-4 shadow rounded box-info">
                                <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                <h5>Impact</h5>
                                <p class="small">Making a real difference in lives.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="mission-vision py-5">
        <div class="container">
            <div class="row g-4 text-center">

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="p-4 shadow rounded h-100">
                            <i class="fas fa-bullseye fa-2x text-primary mb-3"></i>
                            <h4>Our Mission</h4>
                            <p>
                                To ensure that unused but safe medicines reach people who need
                                them the most, without any cost.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="p-4 shadow rounded h-100">
                            <i class="fas fa-eye fa-2x text-success mb-3"></i>
                            <h4>Our Vision</h4>
                            <p>
                                A society where no one is deprived of medicine due to financial
                                difficulties.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>