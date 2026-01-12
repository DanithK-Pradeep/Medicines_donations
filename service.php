<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Our Services | MedDonation</title>
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="stylenav.css">

    <style>
        .contact-uss-section {
            background: linear-gradient(to right, #99d2ef, #62a4baff);
            /* light grey section */
            padding: 50px 0;
            /* top/bottom space */
            color: black;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;

        }

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


        .header {
            padding: 50px 0;
            /* top/bottom space */
            color: black;

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
            <h1 class="fw-bold">Our Services</h1>
            <p class="mt-2">
                We bring hope through medicine donation and free access to essential medicines. </p>
        </div>
    </section>

    <!-- SERVICES CONTENT (FROM INDEX) -->
    <section class="serv-section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Donate Medicine -->
                <div class="col-md-4">
                    <div class="card h-100 shadow text-center p-4">
                        <i class="fas fa-heart fa-2x mb-3 text-danger"></i>
                        <h4>Donate Medicines</h4>
                        <p class="mt-3">
                            Donate unused and unexpired medicines from your home.
                            There is no cost involved, and any quantity is accepted.
                        </p>
                    </div>
                </div>

                <!-- Request Medicine -->
                <div class="col-md-4">
                    <div class="card h-100 shadow text-center p-4">
                        <i class="fas fa-hand-holding-medical fa-2x mb-3 text-success"></i>
                        <h4>Request Medicines</h4>
                        <p class="mt-3">
                            Incapable and needy people can request medicines by submitting
                            valid personal details and doctor prescriptions.
                        </p>
                    </div>
                </div>

                <!-- Free & Secure -->
                <div class="col-md-4">
                    <div class="card h-100 shadow text-center p-4">
                        <i class="fas fa-shield-alt fa-2x mb-3 text-primary"></i>
                        <h4>Free & Secure Platform</h4>
                        <p class="mt-3">
                            All donations and medicine requests are processed securely
                            and completely free of charge.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- WHY MEDDONATION -->
    <section class="contact-uss-section py-5">

        <div class="container text-center">
            <h2 class=" text-black fw-bold mb-4">Why Choose MedDonation?</h2>

            <div class="row g-4">

                <div class="col-md-3">
                    <i class="fas fa-check-double text-danger"></i>
                    <p class=" mt-2">Easy Donation Process</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-home text-success"></i>
                    <p class=" mt-2">Donate or Receive From Home</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-handshake text-danger"></i>
                    <p class=" mt-2">No Cost Involved</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-users text-success"></i>
                    <p class=" mt-2">Helping Needy People</p>
                </div>

            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>