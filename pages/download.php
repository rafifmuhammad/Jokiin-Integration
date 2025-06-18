<?php
// Pastikan sesi sudah dimulai
session_start();

// Periksa login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Ambil parameter file dari URL
if (isset($_GET['file']) && isset($_GET['type'])) {
    $filePath = $_GET['file']; // Path file dari database
    $fileType = $_GET['type']; // Jenis file (proposal, pertemuan1, dll.)

    // Pastikan file ada dan aman
    $validTypes = ['proposal', 'pertemuan1', 'pertemuan_2', 'pertemuan3', 'file_lengkap'];
    if (!in_array($fileType, $validTypes) || !file_exists($filePath)) {
        die('File tidak ditemukan atau tidak valid.');
    }

    // Tentukan nama file untuk unduhan (ekstrak dari path)
    $fileName = basename($filePath);

    // Set header untuk memaksa unduhan
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Baca dan keluarkan file
    readfile($filePath);
    exit;
} else {
    die('Parameter tidak lengkap.');
}
