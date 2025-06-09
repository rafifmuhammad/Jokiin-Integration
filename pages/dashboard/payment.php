<?php
include './../../includes/function.php';

// Pagination Set up
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$perPage = 5;
$start = ($page - 1) * $perPage;

// Ambil data sesuai halaman
$payments = query("SELECT * FROM tb_pembayaran ORDER BY created_at DESC LIMIT $start, $perPage");

// Hitung total data
$total = count(query("SELECT * FROM tb_pembayaran"));
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
    <title>Pembayaran | Jokiin</title>
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
        <div class="box">
            <i class="ri-group-line" onclick="location.href='user_management.php'"></i>
            <a href="./user_management.php">Manajemen Pengguna</a>
        </div>
        <div class="box">
            <i class="ri-message-2-line" onclick="location.href='mail_management.php'"></i>
            <a href="./mail_management.php">Manajemen Pesan</a>
        </div>
        <div class="box">
            <i class="ri-list-check-3" onclick="location.href='tasks_list.php'"></i>
            <a href="./tasks_list.php">Tugas-tugas</a>
        </div>
        <div class="box active">
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
                        <h1>Pembayaran</h1>
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
                    <a href="./dashboard.php">Dashboard</a>
                    <span>Pembayaran</span>
                </div>

                <div class="box-content">
                    <div class="box">
                        <h1 class="title">Tabel Pembayaran</h1>
                        <div>
                            <form action="">
                                <input type="text" name="cari" id="cari" placeholder="Cari dalam tabel">
                                <button>Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="box">

                        <div class="table-responsive">
                            <table class="data-table long-table">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pembayaran</th>
                                    <th>Kode Tugas</th>
                                    <th>Kode Pengguna</th>
                                    <th>Kode Penjoki</th>
                                    <th>Pembayaran 1</th>
                                    <th>Pembayaran 2</th>
                                    <th>Bukti 1</th>
                                    <th>Bukti 2</th>
                                    <th>Tanggal Bayar 1</th>
                                    <th>Tanggal Bayar 2</th>
                                    <th>Total Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($payments as $payment) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $payment['kd_pembayaran']; ?></td>
                                        <td><?= $payment['kd_tugas']; ?></td>
                                        <td><?= $payment['kd_pengguna']; ?></td>
                                        <td><?= $payment['kd_penjoki']; ?></td>
                                        <td><?= $payment['is_paid_1']; ?></td>
                                        <td><?= $payment['is_paid_2']; ?></td>
                                        <td>
                                            <a href="<?= $payment['bukti_pembayaran_1']; ?>"><i class="ri-eye-line"></i> Lihat</a>
                                        </td>
                                        <td>
                                            <a href="<?= $payment['bukti_pembayaran_2']; ?>"><i class="ri-eye-line"></i> Lihat</a>
                                        </td>
                                        <td><?= $payment['tanggal_pembayaran_1']; ?></td>
                                        <td><?= $payment['tanggal_pembayaran_2']; ?></td>
                                        <td>Rp. <?= $payment['total_bayar']; ?></td>
                                        <td class="button-action">
                                            <button class="warning"><i class="ri-pencil-line"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <div class="box">
                        <button>Sebelumnya</button>
                        <button>1</button>
                        <button>Selanjutnya</button>
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