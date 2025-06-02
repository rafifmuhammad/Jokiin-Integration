<?php
include './../../includes/function.php';

if (isset($_POST['submit'])) {
    if (addUser($_POST) > 0) {
        echo "
                <script>
                    alert('Pengguna berhasil ditambahkan!');
                    document.location.href = './user_management.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Kesalahan: Pengguna gagal ditambahkan!');
                    document.location.href = './add_user.php';
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
    <title>Tambahkan Pengguna | Jokiin</title>
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
        <div class="box">
            <i class="ri-bank-card-line" onclick="location.href='payment.html'"></i>
            <a href="./payment.html">Pembayaran</a>
        </div>
        <div class="box">
            <i class="ri-star-half-line" onclick="location.href='rating.html'"></i>
            <a href="./rating.html">Penilaian</a>
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
                        <h1>Tambahkan Pengguna</h1>
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
                    <a href="./dashboard.html">Dashboard</a>
                    <a href="./tasks_list.php">Manajemen Pengguna</a>
                    <span>Tambahkan Pengguna</span>
                </div>

                <div class="box-form-content">
                    <form action="" method="post">
                        <div class="input-container">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="input-container">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan email" autocomplete="off">
                        </div>
                        <div class="input-container">
                            <label for="no_hp">No. Handphone</label>
                            <input type="no_hp" name="no_hp" id="no_hp" placeholder="Masukkan nomor handphone" autocomplete="off">
                        </div>
                        <div class="input-container">
                            <label for="profesi">Profesi</label>
                            <select name="profesi" id="profesi">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pelajar">Pelajar</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="role">Role</label>
                            <select name="role" id="role">
                                <option value="Pengguna">Pengguna</option>
                                <option value="Penjoki">Penjoki</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan password">
                        </div>
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
</body>

</html>