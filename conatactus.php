<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us | MedDonation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">

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

        .contactus {
            background: #1365b7ff;
        }



        /* CONTACT FORM STYLES */
        .contact-form .form-control {
            border-radius: 0;
            box-shadow: none;
            border-color: gray;
            border-radius: 5px;
            background: none;

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
            <h1 class="fw-bold">Contact Us</h1>
            <p class="mt-2">
                For any query, please feel free to contact us.
            </p>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class=" py-5">
        <div class="container">
            <div class="row align-items-start">

                <!-- LEFT INFO -->
                <div class="col-lg-5 mb-4">
                    <h3 class="fw-bold mb-3">Get in Touch</h3>
                    <p>
                        If you have any questions regarding medicine donation, requests,
                        or our platform, we are always here to help you.
                    </p>

                    <ul class="list-unstyled mt-4">
                        <li class="mb-3">
                            <i class="fas fa-home me-2 text-primary"></i>
                            Kurunegala, Sri Lanka
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <a href="mailto:meddonation@gmail.com">meddonation@gmail.com</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            +94 71 123 4567
                        </li>
                    </ul>
                </div>

                <!-- CONTACT FORM (SAME AS INDEX) -->

                <div class="col-lg-7">
                    <div class="p-4">
                        <form class="contact-form">

                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Enter your phone number">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="4" placeholder="Enter your message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Send Message
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>