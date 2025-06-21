<?php
session_start();

// Check the session
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}


include __DIR__ . './../includes/function.php';

// Get user's session data
$email = $_SESSION['email'];
$user = query("SELECT DISTINCT * FROM tb_users WHERE email = '$email'");
$kdUser = $user[0]['kd_user'];

if ($user[0]['role'] == 'Admin') {
    $assignments = query("SELECT DISTINCT *
                    FROM tb_users 
                    JOIN tb_tugas ON tb_users.kd_user = tb_tugas.kd_user 
                    LEFT JOIN tb_pembayaran ON tb_tugas.kd_tugas = tb_pembayaran.kd_tugas 
                    ORDER BY tb_tugas.created_at DESC");
} else if ($user[0]['role'] == 'Penjoki') {
    $assignments = query("SELECT DISTINCT *
                    FROM tb_users 
                    JOIN tb_tugas ON tb_users.kd_user = tb_tugas.kd_user 
                    LEFT JOIN tb_pembayaran ON tb_tugas.kd_tugas = tb_pembayaran.kd_tugas 
                    WHERE tb_tugas.kd_penjoki IS NULL
                    ORDER BY tb_tugas.created_at DESC");
} else {
    $assignments = query("SELECT DISTINCT *
                    FROM tb_users 
                    JOIN tb_tugas ON tb_users.kd_user = tb_tugas.kd_user 
                    LEFT JOIN tb_pembayaran ON tb_tugas.kd_tugas = tb_pembayaran.kd_tugas 
                    WHERE tb_users.kd_user = '$kdUser'
                    ORDER BY tb_tugas.created_at DESC");
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
    <link rel="stylesheet" href="./../dist/css/style-main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Tugas | Jokiin</title>

</head>

<body>
    <!-- Navigation Start -->
    <section class="navigation">
        <div class="container">
            <div class="box-navigation">
                <div class="box">
                    <h2><a href="./home.php">Joki.In</a></h2>
                    <ul>
                        <li><a href="./home.php">Beranda</a></li>
                        <li><a href="./dashboard/dashboard.php">Dashboard</a></li>
                        <li><a href="./riwayat.php">Riwayat</a></li>
                    </ul>
                </div>
                <div class="box">
                    <ul>
                        <li>
                            <form action="">
                                <input type="text" name="cari" id="cari" placeholder="Cari sesuatu">
                            </form>
                        </li>
                        <li>
                            <a href="">
                                <i class="ri-mail-unread-line"></i>
                            </a>
                        </li>
                        <li>
                            <div class="profile">
                                <img src="./../img/user-1.jpg" alt="user-1">
                            </div>
                        </li>
                        <li>
                            <a href="">
                                <h3>John Nash</h3>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Mobile Navigation Start -->
                <div class="box menu-bar">
                    <h1>Joki.In</h1>
                    <i class="ri-menu-3-line"></i>
                </div>
                <div class="box menu-navigation">
                    <svg width="24" height="12" viewBox="0 0 24 12" class="arrow">
                        <polygon points="12,0 24,12 0,12" fill="#2a9d8f" />
                    </svg>
                    <ul>
                        <li>
                            <i class="ri-home-5-line" onclick="location.href='./../home.php'"></i>
                            <a href="./home.php">Beranda</a>
                        </li>
                        <li>
                            <i class="ri-dashboard-line" onclick="location.href='dashboard.php'"></i>
                            <a href="./dashboard/dashboard.php">Dashboard</a>
                        </li>
                        <li>
                            <i class="ri-history-line"></i>
                            <a href="./riwayat.php">Riwayat</a>
                        </li>
                        <li>
                            <i class="ri-user-line"></i>
                            <a href="./profile.php">Profile</a>
                        </li>
                        <li>
                            <i class="ri-logout-circle-line" onclick="location.href='./../logout.php'"></i>
                            <a href="./../index.html">Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Mobile Navigation End -->
        </div>
    </section>
    <!-- Navigation End -->

    <!-- Content Start -->
    <section class="content">
        <div class="container">
            <h1>Seluruh Tugas</h1>
            <p>Seluruh tugas yang diajukan.</p>
            <div class="box-content">
                <?php foreach ($assignments as $assignment) : ?>
                    <div class="project-item">
                        <div class="box-project-item">
                            <img src="./../img/user-2.jpg" alt="user-2">
                        </div>
                        <div class="box-project-item">
                            <h2><?= $assignment['nama_lengkap']; ?></h2>
                            <h3><?= $assignment['judul']; ?></h3>
                            <p><?= $assignment['deskripsi']; ?></p>
                            <div class="tag">
                                <?= $assignment['assignment_type']; ?>
                            </div>
                        </div>
                        <div class="box-project-item">
                            <p><?= $assignment['total_bayar']; ?></p>
                            <button class="button" onclick="location.href='./confirm_assignment.php?kd_tugas=<?= $assignment['kd_tugas']; ?>&kd_penjoki=<?= $user[0]['kd_user']; ?>'">Ambil Tugas</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Content End -->


    <!-- Footer Start -->
    <footer>
        <section class="footer">
            <div class="container">
                <div class="box-footer">
                    <div class="box">
                        <h1>Joki.In</h1>
                    </div>
                    <div class="box">
                        <div class="box-wrap">
                            <h2>Joki.In</h2>
                            <ul>
                                <li><a href="">Tentang</a></li>
                                <li><a href="">Demo sistem</a></li>
                            </ul>
                        </div>
                        <div class="box-wrap">
                            <h2>Jadi Bagian</h2>
                            <ul>
                                <li><a href="">Bergabung dengan kami</a></li>
                                <li><a href="">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <p>Copyright &copy; 2025 Rafifbanner.</p>
            </div>
        </section>
    </footer>
    <!-- Footer End -->

    <script src="./../dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>