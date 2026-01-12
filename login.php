<?php
session_start();
include '../meddonation/meddb/meddb.php';


if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $admin_email = 'admin@gmail.com';
    $admin_password = 'admin';

    // 1️⃣ Empty check
    if ($email === "" || $password === "") {
        header("Location: login.php?error=empty");
        exit();
    }

    if ($email === $admin_email && $password === $admin_password) {
        // 5️⃣ Secure session
        session_regenerate_id(true);

        // 6️⃣ Store session values
        $_SESSION['user_id'] = 11;
        $_SESSION['user_name'] = 'admin';
        $_SESSION['user_email'] = $admin_email;
        $_SESSION['user_category'] = 'admin';

        // Redirect to admin dashboard
        header("Location: ../meddonation/admin/dashboard.php");
        exit();
    }

    // 2️⃣ Fetch user by email
    $stmt = $conn->prepare(
        "SELECT id, name, email,tel_no, pass, category FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // 3️⃣ Check user exists
    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // 4️⃣ Verify password
        if (password_verify($password, $user['pass'])) {

            // 5️⃣ Secure session
            session_regenerate_id(true);

            // 6️⃣ Store session values
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_tel_no'] = $user['tel_no'];
            $_SESSION['user_category'] = $user['category'];
            $_SESSION['user_status'] = $user['status'];


            // 7️⃣ Redirect based on role
            if ($user['category'] === 'individual') {
                header("location: ../meddonation/individual/user.php");
                exit();
            }
        }
    }

    // 8️⃣ Generic error
    header("Location: login.php?error=invalid");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="medicine_18550325.png">
    <title>MedDonation - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <!-- Background Image -->
    <div class="background-container">
        <div class="overlay"></div>

        <!-- Login Form Container -->
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-6 col-sm-12">
                    <div class="login-form">
                        <h3 class="text-center mb-4">MedDonation Login</h3>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <a href="#" class="text-primary">Forgot Password?</a>
                                <p> Not Registered? <a href="signin.php" class="text-primary">Sign Up</a></p>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
                            <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='index.php'">Back to Home</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>