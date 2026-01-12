<?php

include 'meddb/meddb.php';

if (isset($_POST['signin'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel_no = $_POST['phone'];
    $category = $_POST['category'];
    $pass = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hased_password = password_hash($pass, PASSWORD_BCRYPT);

    if (empty($name) || empty($address) || empty($email) || empty($tel_no) || empty($category) || empty($pass) || empty($confirm_password)) {
        echo "<script>alert('All fields are required. Please fill in all fields.'); window.location.href='signin.php';</script>";
        exit();
    }

    if ($pass !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.location.href='signin.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (name, address, email, tel_no, category, pass) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $address, $email, $tel_no, $category, $hased_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful.'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.location.href='signin.php';</script>";
        exit();
    }
}

   


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">
    <title>MedDonation - Sign Up</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="signin.css">
</head>

<body>

    <div class="bg-container">
        <div class="overlay"></div>

        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-6 col-md-8">

                    <div class="glass-form">
                        <h3 class="text-center mb-4">Create Account</h3>

                        <form action="signin.php" method="post">

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" name="name">
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control" rows="2" placeholder="Address" name="address" required></textarea>
                            </div>

                            <div class="mb-3">
                                <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                            </div>

                            <div class="mb-3">
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    <option>Individual</option>
                                    <option>Organization</option>
                                    <option>Pharmaceutical</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2" name="signin">
                                Sign Up
                            </button>

                            <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='index.php'">
                                Back to Home
                            </button>

                            <p class="text-center mt-3 small">
                                Already have an account?
                                <a href="login.php">Login</a>
                            </p>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>