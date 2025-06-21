<?php
include './../../includes/function.php';

$id = $_GET['kd_tugas'];

// Get single data of task
$task = query("SELECT * FROM tb_tugas WHERE kd_tugas = '$id'");

// Get single data of user
$idTugas = $task[0]['kd_tugas'];
$user = query("SELECT * FROM tb_users, tb_tugas WHERE tb_users.kd_user = tb_tugas.kd_user AND tb_tugas.kd_tugas = '$idTugas'");

// Get consultants 
$consultants = query("SELECT * FROM tb_users WHERE role = 'Penjoki'");

if (isset($_POST['submit'])) {
    if (updateConsultant($_POST) > 0) {
        echo "
                <script>
                    alert('Tugas berhasil diubah!');
                    document.location.href = './tasks_list.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Tugas gagal diubah!');
                    
                </script>
            ";
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
    <link rel="stylesheet" href="./../../dist/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Tugaskan Penjoki | Jokiin</title>

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
                        <h1>Tugaskan Penjoki</h1>
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

        <!-- Form Content Start -->
        <section class="form-content shrink">
            <div class="container">
                <div class="breadcrumb">
                    <a href="./dashboard.php">Dashboard</a>
                    <a href="./tasks_list.php">Daftar Tugas</a>
                    <span>Tugaskan Penjoki</span>
                </div>

                <div class="box-form-content">
                    <form action="" method="POST">
                        <input type="hidden" name="kd_tugas" id="kd_tugas" value="<?= $task[0]['kd_tugas']; ?>">
                        <div class="input-container">
                            <label for="nama_client">Nama Client</label>
                            <input type="text" name="nama_client" id="nama_client" value="<?= $user[0]['nama_lengkap']; ?>" readonly>
                        </div>
                        <div class="input-container">
                            <label for="judul">Judul Tugas</label>
                            <input type="text" name="judul" id="judul" value="<?= $task[0]['judul']; ?>">
                        </div>
                        <div class="input-container">
                            <label for="deskripsi">Deskripsi Tugas</label>
                            <input type="text" name="deskripsi" id="deskripsi" value="<?= $task[0]['deskripsi']; ?>" readonly>
                        </div>
                        <div class="input-container">
                            <label for="created_at">Tanggal Diajukan</label>
                            <input type="text" name="created_at" id="created_at" value="<?= $task[0]['created_at']; ?>" readonly>
                        </div>
                        <!-- Bro dibagian ini seharusnya buat logika isset kd_penjoki kosong kemarin rencananya buat fungsi update assignment -->
                        <?php if ($user[0]['role'] == 'Penjoki' || $user[0]['role'] == 'Pengguna') : ?>
                            <input type="hidden" name="kd_penjoki" id="kd_penjoki" value="<?= $user[0]['kd_penjoki']; ?>">
                        <?php else : ?>
                            <div class="input-container">
                                <label for="judul">Nama Penjoki</label>
                                <select name="kd_penjoki" id="kd_penjoki">
                                    <!-- The value will be the ID of the consultant -->
                                    <?php if (!empty($user[0]['kd_penjoki'])) : ?>
                                        <option value="<?= $user[0]['kd_penjoki']; ?>" selected><?= $user[0]['nama_lengkap']; ?></option>
                                        <?php foreach ($consultants as $consultant) : ?>
                                            <?php if ($consultant['kd_user'] === $user[0]['kd_penjoki']) continue ?>
                                            <option value="<?= $consultant['kd_user']; ?>"><?= $consultant['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php foreach ($consultants as $consultant) : ?>
                                            <option value="<?= $consultant['kd_user']; ?>"><?= $consultant['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="button" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Form Content End -->

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