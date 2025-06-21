<?php
session_start();

// Check the session
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require './../includes/function.php';

$id = $_GET['kd_user'];

// Query single user's
$user = query("SELECT * FROM tb_users WHERE kd_user = '$id'");

// Update user's data
if (isset($_POST['submit'])) {
    if (editUser($_POST) > 0) {
        echo "
        <script>
            document.location.href = './profile.php';
            alert('Pengguna berhasil diubah!');
        </script>
        ";
    } else {
        echo "
        <script>
            document.location.href = './profile.php';
            alert('Pengguna gagal diubah!');
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
    <link rel="stylesheet" href="./../dist/css/style-main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Ubah Profile | Jokiin</title>

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

    <!-- Profile menu Start -->
    <section class="edit-profile">
        <div class="container">
            <!-- Where form begin -->
            <form action="" method="POST">
                <label for="image">
                    <img src="./../img/user-1.jpg" />
                    <input type="file" name="image" id="image" style="display:none;" />
                    <h1><?= $user[0]['nama_lengkap']; ?></h1>
                    <p><?= $user[0]['profesi']; ?></p>
                </label>
                <div class="box-edit-profile">
                    <div class="box">
                        <input type="hidden" name="kd_user" id="kd_user" value="<?= $user[0]['kd_user']; ?>">
                        <div>
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" value="<?= $user[0]['nama_lengkap']; ?>">
                        </div>
                        <div>
                            <label for="email" readonly>Email</label>
                            <input type="text" name="email" id="email" placeholder="Masukkan email" value="<?= $user[0]['email']; ?>" readonly>
                        </div>
                        <div>
                            <label for="phone_number" readonly>Nomor Handphone</label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Masukkan nomor handphone" value="<?= $user[0]['no_hp']; ?>" readonly>
                        </div>
                        <div>
                            <label for="profesi" value="<?= $user[0]['profesi']; ?>">Profesi</label>
                            <select name="profesi" id="profesi">
                                <option value="Penjoki">Mahasiswa</option>
                                <option value="Penjoki">Pelajar</option>
                                <option value="Penjoki">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label for="role" value="<?= $user[0]['role']; ?>">Sebagai</label>
                            <select name="role" id="role" readonly>
                                <option value="Penjoki">Pengguna</option>
                                <option value="Penjoki">Penjoki</option>
                            </select>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan password">
                        </div>
                        <button type="submit" class="button" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Profile-menu End -->

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