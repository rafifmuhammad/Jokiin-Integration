<?php
include './../../config/connect.php';

// Retrieve Data Function
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
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
    $kdUser = "user_1";
    $kdPenjoki = "user_2";
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $assignmentType = htmlspecialchars($data['jenis']);
    $isFinished = "false";
    $createdAt = date('Y-m-d');

    $query = "INSERT INTO tb_tugas 
    (kd_tugas, kd_user, kd_penjoki, judul, deskripsi, is_finished, assignment_type, created_at) 
    VALUES ('$kdTugas', '$kdUser', '$kdPenjoki', '$judul', '$deskripsi', '$isFinished', '$assignmentType', '$createdAt')";

    mysqli_query($conn, $query);
    echo mysqli_error($conn);

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

// Payment Functions
function addPayment($data)
{
    global $conn;
}

// Message Functions 

// Data is an array or params?
// Ex:
// array("kdUser"=> $kdUser, "judul"=>$judul, ...);

function addMessage($data)
{
    global $conn;

    $kdPesan = uniqid();
    $kdUser = "user_1";
    $judulPesan = $data['judul'];
    $isiPesan = $data['isi_pesan'];
    $createdAt = date('Y-m-d');

    $query = "INSERT INTO tb_pesan 
    (kd_pesan, kd_user, judul_pesan, isi_pesan, created_at)
    VALUES ('$kdPesan', '$kdUser', '$judulPesan', '$isiPesan', '$createdAt')";

    mysqli_query($conn, $query);
}
