<?php
include './../../includes/function.php';

// Pagination Set up
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$perPage = 5;
$start = ($page - 1) * $perPage;

// Ambil data sesuai halaman
$users = query("SELECT * FROM tb_users ORDER BY created_at DESC LIMIT $start, $perPage");

// Hitung total data
$total = count(query("SELECT * FROM tb_users"));
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
    <title>Manajemen Pengguna | Jokiin</title>
</head>

<body>
    <!-- Sidebar Start -->
    <section class="sidebar menu-navigation menu-active">
        <div class="box">
            <h1>Joki.In</h1>
            <i class="ri-menu-2-line menu-bar"></i>
        </div>
        <div class="box">
            <i class="ri-dashboard-line" onclick="location.href='dashboard.html'"></i>
            <a href="./dashboard.html">Dashboard</a>
        </div>
        <div class="box active">
            <i class="ri-group-line" onclick="location.href='user_management.php'"></i>
            <a href="#">Manajemen Pengguna</a>
        </div>
        <div class="box">
            <i class="ri-message-2-line" onclick="location.href='mail_management.php'"></i>
            <a href="./mail_management.php">Manajemen Pesan</a>
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
            <i class="ri-home-5-line" onclick="location.href='./../home.html'"></i>
            <a href="./../home.html">Beranda</a>
        </div>
        <div class="box">
            <i class="ri-logout-circle-line" onclick="location.href='./../../index.html'"></i>
            <a href="./../../index.html">Keluar</a>
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
                        <h1>Manajemen Pengguna</h1>
                    </div>
                    <div class="box">
                        <form action="">
                            <input type="text" name="cari" id="cari" placeholder="Cari sesuatu">
                        </form>
                        <img src="./../../img/user-1.jpg" alt="user-1">
                        <h2>John Nash</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- Header End -->

        <!-- Content Start -->
        <section class="content shrink">
            <div class="container">
                <div class="breadcrumb">
                    <a href="./dashboard.html">Dashboard</a>
                    <span>Manajemen Pengguna</span>
                </div>

                <div class="box-content">
                    <div class="box">
                        <h1 class="title">Tabel Manajemen Pengguna</h1>
                        <div>
                            <form action="">
                                <input type="text" name="cari" id="cari" placeholder="Cari dalam tabel">
                                <button>Cari</button>
                            </form>
                            <button class="primary" onclick="location.href='add_user.php'">Tambah Pengguna</button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="table-responsive">
                            <table class="data-table">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pengguna</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Profesi</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $user['kd_user']; ?></td>
                                        <td><?= $user['nama_lengkap']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td><?= $user['no_hp']; ?></td>
                                        <td><?= $user['profesi']; ?></td>
                                        <td><?= $user['role']; ?></td>
                                        <td class="button-action">
                                            <button class="warning"><i class="ri-pencil-line"></i></button>
                                            <button class="danger"><i class="ri-delete-bin-line"></i></button>
                                            <button><i class="ri-gallery-view-2"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
</body>

</html>