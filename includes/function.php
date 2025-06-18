<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jokiin/config/connect.php';

// Retrieve Data Function
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);

    if ($result === false) {
        echo "Query failed: " . mysqli_error($conn) . "<br>Query: " . $query;
        exit;
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Feature Functions
// Assignment Functions
function addAssignment($data)
{
    global $conn;

    $kdTugas = uniqid();
    $kdUser = $data['kd_user'];
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $assignmentType = htmlspecialchars($data['jenis']);
    $isFinished = "false";
    $createdAt = date('Y-m-d');

    // Payment variables
    $kdPembayaran = uniqid();
    $kdUser = $data['kd_user'];
    $createdAt = date('Y-m-d');
    $totalBayar = 0;
    $jenisTugas = $data['jenis'];
    $isPaid1 = false;
    $isPaid2 = false;

    if ($jenisTugas == 'Kerja Praktek') {
        $totalBayar = 400000;
    } else {
        exit;
    }

    addMessage($data, "Tugas Berhasil Ditambahkan", "Tugas anda telah berhasil ditambahkan!");

    // Query for table tugas
    $query = "INSERT INTO tb_tugas
    (kd_tugas, kd_user, judul, deskripsi, is_finished, assignment_type, created_at) 
    VALUES ('$kdTugas', '$kdUser', '$judul', '$deskripsi', '$isFinished', '$assignmentType', '$createdAt')";

    // Query for table payment
    $queryPayment = "INSERT INTO tb_pembayaran 
    (kd_pembayaran, kd_tugas, kd_pengguna, total_bayar, created_at, is_paid_1, is_paid_2)
    VALUES ('$kdPembayaran', '$kdTugas', '$kdUser', $totalBayar, '$createdAt', '$isPaid1', '$isPaid2')";

    mysqli_query($conn, $query);
    mysqli_query($conn, $queryPayment);
    echo mysqli_error($conn);

    return mysqli_affected_rows($conn);
}

function deleteAssignment($id)
{
    global $conn;

    $query = "DELETE FROM tb_tugas WHERE kd_tugas = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadAssignment($data)
{
    global $conn;

    $kdTugas = htmlspecialchars($data['kd_tugas']);
    $fileType = htmlspecialchars($data['file_type']); // e.g., 'proposal', 'pertemuan1', 'pertemuan2', 'pertemuan3', 'file_lengkap'

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/jokiin/uploads/';
        $fullPath = $uploadDir . $fileName;

        // Check if upload directory exists, create it if it doesn't
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($fileTmpPath, $fullPath)) {
            // Determine which column to update based on file_type
            $column = '';
            switch ($fileType) {
                case 'proposal':
                    $column = 'file_proposal';
                    break;
                case 'pertemuan1':
                    $column = 'file_pertemuan_1';
                    break;
                case 'pertemuan2':
                    $column = 'file_pertemuan_2';
                    break;
                case 'pertemuan3':
                    $column = 'file_pertemuan_3';
                    break;
                case 'file_lengkap':
                    $column = 'laporan_lengkap';
                    break;
                default:
                    return 0;
            }

            // Update the tb_tugas table with the full path
            $query = "UPDATE tb_tugas SET $column = '$fullPath' WHERE kd_tugas = '$kdTugas'";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
        } else {
            echo "Error moving file.";
            return 0;
        }
    }

    return 0;
}

function updateConsultant($data)
{
    global $conn;

    $kdTugas = htmlspecialchars($data['kd_tugas']);
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $createdAt = htmlspecialchars($data['created_at']);
    $kdPenjoki = htmlspecialchars($data['kd_penjoki']);

    // Tugas
    $query1 = "UPDATE tb_tugas SET
    judul = '$judul',
    deskripsi = '$deskripsi',
    created_at = '$createdAt',
    kd_penjoki = '$kdPenjoki'
    WHERE kd_tugas = '$kdTugas'";

    // Pembayaran
    $query2 = "UPDATE tb_pembayaran SET kd_penjoki = '$kdPenjoki' WHERE kd_tugas = '$kdTugas'";

    // Query tugas
    mysqli_query($conn, $query1);

    // Query pembayaran
    mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

// Users Functions
function addUser($data)
{
    global $conn;

    $kdUser = uniqid();
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $profesi = htmlspecialchars($data['profesi']);
    $role = htmlspecialchars($data['role']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $createdAt = date('Y-m-d');

    $query = "INSERT INTO tb_users 
    (kd_user, nama_lengkap, email, no_hp, profesi, role, password, created_at)
    VALUES ('$kdUser', '$nama', '$email', '$no_hp', '$profesi', '$role', '$password', '$createdAt')";

    mysqli_query($conn, $query);
    echo mysqli_error($conn);

    return mysqli_affected_rows($conn);
}


function deleteUser($id)
{
    global $conn;

    $query = "DELETE FROM tb_users WHERE kd_user = '$id'";
    mysqli_query($conn, $query);

    echo mysqli_error($conn);

    return mysqli_affected_rows($conn);
}

function editUser($data)
{
    global $conn;

    $kdUser = htmlspecialchars($data['kd_user']);
    $namaLengkap = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $phoneNumber = htmlspecialchars($data['phone_number']);
    $profesi = htmlspecialchars($data['profesi']);
    $role = htmlspecialchars($data['role']);
    $password = htmlspecialchars($data['password']);

    if (empty($password)) {
        $query = "UPDATE tb_users SET 
        nama_lengkap = '$namaLengkap',
        email = '$email',
        no_hp = '$phoneNumber',
        profesi = '$profesi',
        role = '$role'
        WHERE kd_user = '$kdUser'";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    } else {
        $query = "UPDATE tb_users SET 
        nama_lengkap = '$namaLengkap',
        email = '$email',
        no_hp = '$phoneNumber',
        profesi = '$profesi',
        role = '$role',
        password = password_hash($password, PASSWORD_DEFAULT);
        WHERE kd_user = '$kdUser'";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}

// Payment Functions
function addPayment($data)
{
    global $conn;

    $kdPembayaran = uniqid();
    $kdTugas = $data['kd_tugas'];
    $kdUser = 'user_2';
    $createdAt = date('Y-m-d');
    $totalBayar = 0;
    $tag = $data['jenis'];

    if ($tag == 'Kerja Praktek') {
        $totalBayar = 400000;
    } else {
        exit;
    }

    $query = "INSERT INTO tb_pembayaran 
    (kd_pembayaran, kd_tugas, kd_pengguna, total_bayar, created_at)
    VALUES ('$kdPembayaran', '$kdTugas', '$kdUser', $totalBayar, '$createdAt')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Message Functions 

// Data is an array or params?
// Ex:
// array("kdUser"=> $kdUser, "judul"=>$judul, ...);

function addMessage($data, $title, $message)
{
    global $conn;

    $kdPesan = uniqid();
    $kdUser = $data['kd_user'];
    $judulPesan = $title;
    $isiPesan = $message;
    $createdAt = date('Y-m-d');

    $query = "INSERT INTO tb_pesan 
    (kd_pesan, kd_user, judul_pesan, isi_pesan, created_at)
    VALUES ('$kdPesan', '$kdUser', '$judulPesan', '$isiPesan', '$createdAt')";

    mysqli_query($conn, $query);
}

// Rate Joki Functions
function addRate($data)
{
    global $conn;

    $kdPenilaian = uniqid();
    $kdPengguna = $data['kd_user'];
    $kdPenjoki = $data['kd_penjoki'];
    $rate = $data['nilai'];
    $comment = $data['komentar'];
    $createdAt = date('Y-m-d');

    $query = "INSERT INTO tb_penilaian
    (kd_penilaian, kd_pengguna, kd_penjoki, rating, komentar, dinilai_pada, created_at)
    VALUES ('$kdPenilaian', '$kdPengguna', '$kdPenjoki', '$rate', '$comment', '$createdAt', '$createdAt')";

    mysqli_query($conn, $query);
}

function editRate($data)
{
    global $conn;

    $kdPengguna = $data['kd_pengguna'];
    $kdPenjoki = $data['kd_penjoki'];
    $rate = $data['nilai'];
    $comment = $data['komentar'];
    $dinilaiPada = date('Y-m-d');

    $query = "UPDATE tb_penilaian, tb_users SET
    rating = '$rate',
    komentar = '$comment',
    dinilai_pada = '$dinilaiPada'
    WHERE tb_penilaian.kd_user = tb_users.kd_user AND 
    tb_penilaian.kd_penjoki = tb_users.kd_user AND 
    kd_penjoki = '$kdPenjoki' AND kd_pengguna = '$kdPengguna'
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
