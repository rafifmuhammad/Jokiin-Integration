<?php
session_start();

include __DIR__ . './../includes/function.php';

if (isset($_POST['submit'])) {
    $_SESSION['email'] = $_POST['email'];

    if (addUser($_POST) > 0) {
        $_SESSION['login'] = true;

        echo "
            <script>
                alert('Berhasil mendaftar!');
                document.location.href = './home.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal mendaftar!');
                document.location.href = './register.php';
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
    <link rel="stylesheet" href="./../dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Jokiin | Daftar</title>

</head>

<body>
    <!-- Header Start -->
    <section class="header">
        <div class="container">
            <div class="box-register-header">
                <div class="box">
                    <h1>Joki.In</h1>
                </div>
                <div class="box">
                    <i class="ri-home-5-line" onclick="location.href='./../home.php'"></i>
                    <a href="./../index.html">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Header End -->

    <!-- Form Start -->
    <section class="form">
        <div class="container">
            <div class="box-form">
                <div class="box">
                    <form action="" method="post">
                        <div>
                            <label for="nama">Nama Lengkap</label><br>
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label for="email">Email</label><br>
                            <input type="text" name="email" id="email" placeholder="Masukkan email">
                        </div>
                        <div>
                            <label for="no_hp">Nomor Handphone</label><br>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor handphone">
                        </div>
                        <div>
                            <label for="profession">Profesi</label><br>
                            <select name="profesi" id="profesi">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pelajar">Pelajar</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label for="role">Daftar Sebagai</label><br>
                            <select name="role" id="role">
                                <option value="Pengguna">Pengguna</option>
                                <option value="Penjoki">Penjoki</option>
                            </select>
                        </div>
                        <div>
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Masukkan password">
                        </div>
                        <div>
                            <button type="submit" name="submit">Daftar</button>
                            <a href="./login.php">Telah memiliki akun? Masuk</a>
                        </div>
                    </form>
                </div>
                <div class="box">
                    <img src="./../img/register-ilustration.jpg" alt="ilustration">
                </div>

                <!-- Testing Modal Alert -->
                <div class="modal-alert">
                    <div class="box-modal-alert">
                        <div class="box">
                            <i class="ri-error-warning-line"></i>
                            <p><strong>Kesalahan:</strong> Email atau password yang anda berikan salah!</p>
                        </div>
                        <div class="box">
                            <i class="ri-close-line close-modal"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Form End -->

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
                                <li><a href="">Masuk</a></li>
                                <li><a href="">Daftar</a></li>
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