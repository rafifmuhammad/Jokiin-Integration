<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Jokiin | Landing Page</title>
</head>

<body>
    <header>
        <!-- Navigation Start -->
        <section class="home-navigation animate__animated animate__fadeInDown">
            <div class="container">
                <div class="box-home-navigation">
                    <div class="box">
                        <h2>Joki.In</h2>
                    </div>
                    <div class="box">
                        <ul>
                            <li><a href="#">Cara Kerja</a></li>
                            <li><a href="#">Kontak Kami</a></li>
                            <li><a href="./pages/login.html">Masuk</a></li>
                            <li><button>Bergabung Dengan Kami</button></li>
                        </ul>
                    </div>
                    <!-- Mobile Navigation -->
                    <div class="box menu-navigation">
                        <ul>
                            <li>
                                <i class="ri-questionnaire-line"></i>
                                <a href="#">Cara Kerja</a>
                            </li>
                            <li>
                                <i class="ri-contacts-line"></i>
                                <a href="#">Kontak Kami</a>
                            </li>
                            <li>
                                <i class="ri-login-circle-line"></i>
                                <a href="./pages/login.html">Masuk</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box menu-bar">
                        <i class="ri-menu-3-line"></i>
                    </div>
                </div>
            </div>
        </section>
        <!-- Navigation End -->

        <!-- Hero Start -->
        <section class="hero">
            <div class="container">
                <h1 class="animate__animated animate__fadeInLeft animate__slow">Temukan Jasa Yang Anda Butuhkan Dari Penjoki Yang Siap Membantu Anda.</h1>
                <p class="animate__animated animate__fadeInLeft animate__slow">Kami akan membantu Anda dalam menyelesaikan tugas-tugas Anda</p>
                <div class="animate__animated animate__fadeInLeft animate__slow">
                    <button onclick="location.href='./pages/register.html'" class="button">Daftar Sekarang</button>
                    <i class="ri-arrow-right-s-line"></i>
                </div>
            </div>
        </section>
        <!-- Hero End -->
    </header>

    <!-- Category Start -->
    <section class="category">
        <div class="container">
            <h1 class="heading" data-aos="fade-down" data-aos-duration="1000">Jasa Yang Kami Tawarkan</h1>
            <div class="box-category">
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
                    <i class="ri-file-edit-line"></i>
                    <p>Laporan Kerja Praktek</p>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                    <i class="ri-file-word-2-line"></i>
                    <p>Makalah</p>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                    <i class="ri-file-ppt-2-line"></i>
                    <p>Power Point</p>
                </div>
            </div>
        </div>
        <div class="gap"></div>
        <button data-aos="zoom-in-up" data-aos-duration="1000" class="button">Lihat Lebih Banyak</button>
    </section>
    <!-- Category End -->

    <!-- Content Start -->
    <section class="content">
        <div class="container">
            <h1 class="heading" data-aos="fade-down" data-aos-duration="1000">Bagaimana Cara Kerjanya?</h1>
            <div class="box-content">
                <div class="box">
                    <div class="box-wrap" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        <div>
                            <i class="ri-article-line"></i>
                            <p>01.</p>
                        </div>
                        <h1>Tuliskan Judul atau Kosongkan</h1>
                        <p>Sertakan judul Anda di dalam formulir masukkan yang diberikan atau tidak sama sekali. Kami memberi kemudahan dengan memberikan Anda kebebasan dalam menentukan judul yang Anda ingin kami kerjakan.</p>
                    </div>
                    <img src="./img/content-ilustration-1.jpg" alt="content-1" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                </div>
                <div class="box">
                    <div class="box-wrap-right" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                        <div>
                            <i class="ri-file-pdf-2-line"></i>
                            <p>02.</p>
                        </div>
                        <h1>Isi Dokumen</h1>
                        <p>Sertakan dokumen lampiran yang berkaitan dengan kerja praktek atau makalah. Lampiran dapat dikirimkan secara mudah melalui sistem tanpa harus melalui perantara lainnya.</p>
                    </div>
                    <img src="./img/content-ilustration-2.jpg" alt="content-1" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                </div>
            </div>
        </div>
    </section>
    <!-- Content End -->

    <!-- Testimonial Start -->
    <section class="testimonial">
        <div class="container">
            <div class="box-testimonial">
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
                    <img src="./img/user-1.jpg" alt="user-1">
                    <div class="quote">
                        <i class="ri-double-quotes-l"></i>
                        <div>
                            <p>Respon cepat, revisi tidak pakai lama</p>
                            <h2>Aidil Wahyu</h2>
                            <p>Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                    <img src="./img/user-2.jpg" alt="user-2">
                    <div class="quote">
                        <i class="ri-double-quotes-l"></i>
                        <div>
                            <p>Respon cepat, revisi tidak pakai lama</p>
                            <h2>Difo Kurnia Adiffi</h2>
                            <p>Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                    <img src="./img/user-3.jpg" alt="user-3">
                    <div class="quote">
                        <i class="ri-double-quotes-l"></i>
                        <div>
                            <p>Respon cepat, revisi tidak pakai lama</p>
                            <h2>James Erlando</h2>
                            <p>Mahasiswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial End -->

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

    <!-- Dibilangin pake template sama temen yang tau saya bisa ngoding, pepek memang -->

    <script src="./dist/js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>