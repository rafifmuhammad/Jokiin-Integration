<?php

include __DIR__ . './../../includes/function.php';

$kdTugas = $_GET['kd_tugas'];

if (deleteAssignment($kdTugas) > 0) {
    echo "
        <script>
            document.location.href = './tasks_list.php';
            alert('Tugas berhasil dihapus!');
        </script>
    ";
} else {
    echo "
        <script>
            document.location.href = './tasks_list.php';
            alert('Tugas gagal dihapus!');
        </script>
    ";
}
