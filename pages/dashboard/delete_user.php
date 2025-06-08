<?php
require './../../includes/function.php';

$kd_user = $_GET['kd_user'];

if (deleteUser($kd_user) > 0) {
    echo "
        <script>
            document.location.href = './user_management.php';
            alert('Pengguna berhasil dihapus!');
        </script>
    ";
} else {
    echo "
        <script>
            document.location.href = './user_management.php';
            alert('Pengguna gagal dihapus!');
        </script>
    ";
}
