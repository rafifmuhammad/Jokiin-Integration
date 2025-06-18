<?php
session_start();

// Check the session
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

include './../includes/function.php';

$kdTugas = $_GET['kd_tugas'];
$kdPenjoki = $_GET['kd_penjoki'];

// Get single data of assignment
$assignment = query("SELECT DISTINCT * FROM tb_tugas WHERE kd_tugas = '$kdTugas'");
$judul = $assignment[0]['judul'];
$deskripsi = $assignment[0]['deskripsi'];
$createdAt = $assignment[0]['created_at'];

$newAssignment = [
    "kd_tugas" => "$kdTugas",
    "judul" => "$judul",
    "deskripsi" => "$deskripsi",
    "created_at" => "$createdAt",
    "kd_penjoki" => "$kdPenjoki"
];

if (updateConsultant($newAssignment) > 0) {
    echo "
        <script>
            alert('Anda berhasil mengambil tugas ini!');
            document.location.href = './riwayat.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Anda gagal mengambil tugas ini!');
        </script>
    ";
}
