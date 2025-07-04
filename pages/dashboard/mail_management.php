<?php
session_start();

// Check the session
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include './../../includes/function.php';

// Get user's session data
$email = $_SESSION['email'];
$user = query("SELECT DISTINCT * FROM tb_users WHERE email = '$email'");
$kdUser = $user[0]['kd_user'];

// Pagination Set up
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$perPage = 5;
$start = ($page - 1) * $perPage;

// Ambil data sesuai halaman
if ($user[0]['role'] == 'Pengguna' || $user[0]['role'] == 'Penjoki') {
    $messages = query("SELECT * FROM tb_pesan WHERE kd_user = '$kdUser' ORDER BY created_at DESC LIMIT $start, $perPage");
    $total = count(query("SELECT * FROM tb_pesan WHERE kd_user = '$kdUser'"));
} else {
    $messages = query("SELECT * FROM tb_pesan ORDER BY created_at DESC LIMIT $start, $perPage");
    $total = count(query("SELECT * FROM tb_pesan"));
}


// Hitung total data
$totalPages = ceil($total / $perPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../../dist/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Manajemen Pesan | Jokiin</title>

</head>

<body>
    <!-- Sidebar Start -->
    <section class="sidebar menu-navigation menu-active">
        <div class="box">
            <h1>Joki.In</h1>
            <i class="ri-menu-2-line menu-bar"></i>
        </div>
        <div class="box">
            <i class="ri-dashboard-line" onclick="location.href='dashboard.php'"></i>
            <a href="./dashboard.php">Dashboard</a>
        </div>
        <?php if ($user[0]['role'] == 'Admin') : ?>
            <div class="box">
                <i class="ri-group-line" onclick="location.href='user_management.php'"></i>
                <a href="./user_management.php">Manajemen Pengguna</a>
            </div>
        <?php endif; ?>
        <div class="box active">
            <i class="ri-message-2-line" onclick="location.href='mail_management.php'"></i>
            <a href="#">Manajemen Pesan</a>
        </div>
        <div class="box">
            <i class="ri-list-check-3" onclick="location.href='tasks_list.php'"></i>
            <a href="./tasks_list.php">Tugas-tugas</a>
        </div>
        <div class="box">
            <i class="ri-bank-card-line" onclick="location.href='payment.php'"></i>
            <a href="./payment.php">Pembayaran</a>
        </div>
        <div class="box">
            <i class="ri-star-half-line" onclick="location.href='rating.php'"></i>
            <a href="./rating.php">Penilaian</a>
        </div>
        <div class="box">
            <i class="ri-home-5-line" onclick="location.href='./../home.php'"></i>
            <a href="./../home.php">Beranda</a>
        </div>
        <div class="box">
            <i class="ri-logout-circle-line" onclick="location.href='./../logout.php'"></i>
            <a href="./../logout.php">Keluar</a>
        </div>
    </section>
    <!-- Sidebar End -->

    <!-- Main-app -->
    <div class="main-app">
        <!-- Header Start -->
        <section class="header shrink">
            <div class="container">
                <div class="box-header">
                    <div class="box">
                        <h1>Manajemen Pesan</h1>
                    </div>
                    <div class="box">
                        <form action="">
                            <input type="text" name="cari" id="cari" placeholder="Cari sesuatu">
                        </form>
                        <img src="./../../img/user-1.jpg" alt="user-1">
                        <h2><?= $user[0]['nama_lengkap']; ?></h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- Header End -->

        <!-- Content Start -->
        <section class="content shrink">
            <div class="container">
                <div class="breadcrumb">
                    <a href="./dashboard.php">Dashboard</a>
                    <span>Manajemen Pesan</span>
                </div>

                <div class="box-content">
                    <div class="box">
                        <h1 class="title">Tabel Manajemen Pesan</h1>
                        <div>
                            <form action="">
                                <input type="text" name="cari" id="cari" placeholder="Cari dalam tabel">
                                <button>Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="table-responsive">
                            <table class="data-table">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pesan</th>
                                    <th>Kode Pengguna</th>
                                    <th>Judul Pesan</th>
                                    <th>Isi Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php if (!empty($messages)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($messages as $message) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $message['kd_pesan']; ?></td>
                                            <td><?= $message['kd_user']; ?></td>
                                            <td><?= $message['judul_pesan']; ?></td>
                                            <td class="desc"><?= $message['isi_pesan']; ?></td>
                                            <td class="button-action">
                                                <button class="danger"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">Tidak memiliki data</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="box">
                        <?php if ($page > 1): ?>
                            <button onclick="location.href='?page=<?= $page - 1 ?>'">Sebelumnya</button>
                        <?php else: ?>
                            <button disabled>Sebelumnya</button>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <button onclick="location.href='?page=<?= $i ?>'"
                                <?= $i == $page ? 'style="font-weight: bold;"' : '' ?>>
                                <?= $i ?>
                            </button>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <button onclick="location.href='?page=<?= $page + 1 ?>'">Selanjutnya</button>
                        <?php else: ?>
                            <button disabled>Selanjutnya</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content End -->

        <!-- Footer Start -->
        <footer>
            <section class="footer shrink">
                <p>Copyright &copy; 2025 Rafifbanner.</p>
            </section>
        </footer>
        <!-- Footer End -->
    </div>
    <!-- Main-app -->

    <script src="./../../dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>