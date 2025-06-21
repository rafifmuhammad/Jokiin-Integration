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

$kdTugas = $_GET['kd_tugas'];

$assignment = query("SELECT *
                    FROM tb_users
                    JOIN tb_tugas ON tb_users.kd_user = tb_tugas.kd_user 
                    LEFT JOIN tb_pembayaran ON tb_tugas.kd_tugas = tb_pembayaran.kd_tugas 
                    WHERE tb_tugas.kd_tugas = '$kdTugas'
                    ORDER BY tb_tugas.created_at DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $data = [
        'kd_tugas' => $kdTugas,
        'file_type' => $_POST['file_type'] // e.g., 'proposal', 'pertemuan1', etc.
    ];
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $result = uploadAssignment($data);
        if ($result > 0) {
            echo "<script>alert('Tugas berhasil diunggah!'); window.location.href = 'detail.php?kd_tugas=" . urlencode($kdTugas) . "&success=1';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mengunggah tugas. Silakan coba lagi.'); window.location.href = 'detail.php?kd_tugas=" . urlencode($kdTugas) . "';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Tidak ada file yang dipilih atau terjadi error upload.'); window.location.href = 'detail.php?kd_tugas=" . urlencode($kdTugas) . "';</script>";
        exit;
    }
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
    <title>Detail | Jokiin</title>
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
                            <a href="./profile.php">
                                <h3><?= $user[0]['nama_lengkap']; ?></h3>
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

    <!-- Detail Start -->
    <div class="table-responsive">
        <section class="detail">
            <div class="container">
                <h1>Detail Pengerjaan</h1>
                <table class="custom-table">
                    <tr>
                        <th>Kode tugas</th>
                        <td><?= $assignment[0]['kd_tugas']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pengaju</th>
                        <td><?= $assignment[0]['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <th>Kode Penjoki</th>
                        <td><?= $assignment[0]['kd_penjoki']; ?></td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>
                            <strong><?= $assignment[0]['judul']; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi Tambahan</th>
                        <td><?= $assignment[0]['deskripsi']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Diajukan</th>
                        <td><?= $assignment[0]['created_at']; ?></td>
                    </tr>
                    <tr>
                        <th>File Tugas</th>
                        <td>
                            <table class="custom-table-vertical">
                                <tr>
                                    <th>Proposal Kerja Praktek</th>
                                    <th>Pertemuan 1</th>
                                    <th>Pertemuan 2</th>
                                    <th>Pertemuan 3</th>
                                    <th>File Lengkap</th>
                                </tr>
                                <tr>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="proposal">
                                            <input type="hidden" name="file_type" value="proposal">
                                            <input type="hidden" name="upload" value="1">
                                            <?php if ($user[0]['role'] == 'Pengguna') : ?>
                                                <div class="download-container">
                                                    <i class="ri-download-2-line"></i>
                                                    <?php if (!empty($assignment[0]['file_proposal'])): ?>
                                                        <a href="download.php?file=<?= urlencode($assignment[0]['file_proposal']); ?>&type=proposal" class="download-link">Download File</a>
                                                    <?php else: ?>
                                                        <span>Tidak ada file</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="download-container">
                                                    <i class="ri-file-upload-line"></i>
                                                    <button type="submit" class="upload-button">Upload File</button>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="pertemuan1">
                                            <input type="hidden" name="file_type" value="pertemuan1">
                                            <input type="hidden" name="upload" value="1">
                                            <?php if ($user[0]['role'] == 'Pengguna') : ?>
                                                <div class="download-container">
                                                    <i class="ri-download-2-line"></i>
                                                    <?php if (!empty($assignment[0]['file_pertemuan_1'])): ?>
                                                        <a href="download.php?file=<?= urlencode($assignment[0]['file_pertemuan_1']); ?>&type=pertemuan1" class="download-link">Download File</a>
                                                    <?php else: ?>
                                                        <span>Tidak ada file</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="download-container">
                                                    <i class="ri-file-upload-line"></i>
                                                    <button type="submit" class="upload-button">Upload File</button>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="pertemuan2">
                                            <input type="hidden" name="file_type" value="pertemuan_2">
                                            <input type="hidden" name="upload" value="1">
                                            <?php if ($user[0]['role'] == 'Pengguna') : ?>
                                                <div class="download-container">
                                                    <i class="ri-download-2-line"></i>
                                                    <?php if (!empty($assignment[0]['file_pertemuan_2'])): ?>
                                                        <a href="download.php?file=<?= urlencode($assignment[0]['file_pertemuan_2']); ?>&type=pertemuan_2" class="download-link">Download File</a>
                                                    <?php else: ?>
                                                        <span>Tidak ada file</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="download-container">
                                                    <i class="ri-file-upload-line"></i>
                                                    <button type="submit" class="upload-button">Upload File</button>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="pertemuan3">
                                            <input type="hidden" name="file_type" value="pertemuan3">
                                            <input type="hidden" name="upload" value="1">
                                            <?php if ($user[0]['role'] == 'Pengguna') : ?>
                                                <div class="download-container">
                                                    <i class="ri-download-2-line"></i>
                                                    <?php if (!empty($assignment[0]['file_pertemuan_3'])): ?>
                                                        <a href="download.php?file=<?= urlencode($assignment[0]['file_pertemuan_3']); ?>&type=pertemuan3" class="download-link">Download File</a>
                                                    <?php else: ?>
                                                        <span>Tidak ada file</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="download-container">
                                                    <i class="ri-file-upload-line"></i>
                                                    <button type="submit" class="upload-button">Upload File</button>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="file_lengkap">
                                            <input type="hidden" name="file_type" value="file_lengkap">
                                            <input type="hidden" name="upload" value="1">
                                            <?php if ($user[0]['role'] == 'Pengguna') : ?>
                                                <div class="download-container">
                                                    <i class="ri-download-2-line"></i>
                                                    <?php if (!empty($assignment[0]['laporan_lengkap'])): ?>
                                                        <a href="download.php?file=<?= urlencode($assignment[0]['laporan_lengkap']); ?>&type=file_lengkap" class="download-link">Download File</a>
                                                    <?php else: ?>
                                                        <span>Tidak ada file</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="download-container">
                                                    <i class="ri-file-upload-line"></i>
                                                    <button type="submit" class="upload-button">Upload File</button>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Pembayaran 1</th>
                        <td>
                            <?php if ($user[0]['role'] == 'Pengguna') :  ?>
                                <a href="./payment_1.html" class="button-payment">Lakukan Pembayaran 1</a>
                                <div class="payment-info">
                                    <i class="ri-information-line"></i>
                                    <p>Pembayaran 1 merupakan pembayaran yang dilakukan untuk membuka file proposal hingga file pertemuan 1.</p>
                                </div>
                            <?php else : ?>
                                <a href="./#" class="button-payment">Bukti Pembayaran 1</a><br><br>
                                <button class="confirm-payment" onclick="location.href='./confirm_payment.php'">Konfirmasi Telah Dibayar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Pembayaran 2</th>
                        <td>
                            <?php if ($user[0]['role'] == 'Pengguna') :  ?>
                                <a href="./payment_2.html" class="button-payment">Lakukan Pembayaran 2</a>
                                <div class="payment-info">
                                    <i class="ri-information-line"></i>
                                    <p>Pembayaran 2 merupakan pembayaran yang dilakukan untuk membuka file pertemuan 2 hingga file lengkap.</p>
                                </div>
                            <?php else : ?>
                                <a href="./#" class="button-payment">Bukti Pembayaran 1</a><br><br>
                                <button class="confirm-payment" onclick="location.href='./confirm_payment.php'">Konfirmasi Telah Dibayar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $isFinished = false;

                            if (
                                !empty($assignment[0]['file_proposal']) &&
                                !empty($assignment[0]['file_pertemuan_1']) &&
                                !empty($assignment[0]['file_pertemuan_2']) &&
                                !empty($assignment[0]['file_pertemuan_3']) &&
                                !empty($assignment[0]['laporan_lengkap'])
                            ) {
                                $isFinished = true;
                            }
                            ?>
                            <div class="<?php echo ($isFinished) ? 'status-table finished' : 'status-table' ?>">
                                <?php if (
                                    !$isFinished
                                ) : ?>
                                    Belum Selesai
                                <?php else : ?>
                                    Selesai
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Penilaian</th>
                        <td>
                            <div class="rating">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Aksi</th>
                        <td>
                            <button class="table-button">Batalkan</button>
                            <button class="table-button message">Hubungi Client</button>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
    <!-- Detail End -->

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
                <p>Copyright © 2025 Rafifbanner.</p>
            </div>
        </section>
    </footer>
    <!-- Footer End -->

    <script src="./../dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>