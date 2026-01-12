
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">

            <!-- Brand: Logo + Name -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <!-- Placeholder logo -->
                <img src="logo.png" alt="logo" class="me-2 rounded-circle" />
                <span class="fw-bold">MedDonation</span>
            </a>

            <!-- Toggler for mobile -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Left space to push menu to right -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- Menu Links -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="conatactus.php">Contact</a>
                    </li>

                    <!-- Login Button -->
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-primary" href="login.php">Login</a>
                    </li>
                </ul>

                <!-- Call & Email (Right side) -->
                <div class="d-none d-lg-flex flex-column ms-4 text-end small">
                    <span><strong>Call us:</strong> +94 71 123 4567</span>
                    <span><strong>Email:</strong> meddonation@example.com</span>
                </div>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->