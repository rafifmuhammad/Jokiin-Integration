<?php
session_start();

include './../config/connect.php';
include './../includes/function.php';

if (isset($_POST['submit'])) {
    global $conn;

    $email = $_POST['email'];
    $password = trim($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");

    // If username exists
    if (mysqli_num_rows($result) === 1) {
        // Check the password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['email'] = $_POST['email'];

            header("Location: home.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Masuk | Jokiin</title>
</head>

<body class="login-body">
    <img class="blob-bottom" src="./../img/blob-bottom.svg" alt="blob-bottom">
    <img class="blob-top" src="./../img/blob-top.svg" alt="blob-top">

    <!-- Navigation Start -->
    <section class="navigation-logo">
        <div class="container">
            <h1>Joki.In</h1>
        </div>
    </section>
    <!-- Navigation End -->

    <!-- Content Start -->
    <section class="login-form">
        <div class="container">
            <div class="box-login-form">
                <div class="box">
                    <h1>Temukan kemudahan dalam menyelesaikan tugas Anda.</h1>
                </div>
                <div class="box">
                    <form action="" method="post">
                        <div>
                            <label for="email">Email</label><br>
                            <input type="email" name="email" id="email" placeholder="Masukkan email">
                        </div>
                        <div>
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Masukkan password">
                        </div>
                        <?php if (isset($error)) : ?>
                            <p style="font-size: 12px; margin-top: 10px; color: #f26a8d; font-weight: 500;">Email atau password salah!</p>
                        <?php endif; ?>
                        <button type="submit" name="submit">Masuk</button>
                        <a href="./register.php">Belum memiliki akun? Daftar</a>
                    </form>
                    <a class="forget-password" href="./email_check.html">Lupa password?</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Content End -->

</body>

</html>