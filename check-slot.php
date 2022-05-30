<?php
require_once 'config.php';

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $query = mysqli_query($mysqli, "select username from admin where LCASE(username)='" . strtolower($username) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Username Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => "Username Tersedia"));
    }
}


if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $query = mysqli_query($mysqli, "select email from admin where LCASE(email)='" . strtolower($email) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Email Sudah Terdaftar"));

    } else {
        echo json_encode(array("result" => "success", "msg" => "Email Tersedia"));
    }
}

if (isset($_POST['nomor_telp'])) {
    $nomor_telp = mysqli_real_escape_string($mysqli, $_POST['nomor_telp']);
    $query = mysqli_query($mysqli, "select nomor_telp from admin where LCASE(nomor_telp)='" . strtolower($nomor_telp) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nomor Hp Sudah Terdaftar"));

    } else {
        echo json_encode(array("result" => "success", "msg" => "Nomor Hp Tersedia"));
    }
}


if (isset($_POST['nama_kategori'])) {
    $nama_kategori = mysqli_real_escape_string($mysqli, $_POST['nama_kategori']);
    $query = mysqli_query($mysqli, "select nama_kategori from kategori where LCASE(nama_kategori)='" . strtolower($nama_kategori) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nama Kategori Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => "Nama Kategori Tersedia"));
    }
}

if (isset($_POST['kode_kategori'])) {
    $kode_kategori = mysqli_real_escape_string($mysqli, $_POST['kode_kategori']);
    $query = mysqli_query($mysqli, "select kode_kategori from kategori where LCASE(kode_kategori)='" . strtolower($kode_kategori) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nama Kategori Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => "Nama Kategori Tersedia"));
    }
}

if (isset($_POST['nama_type'])) {
    $nama_type = mysqli_real_escape_string($mysqli, $_POST['nama_type']);
    $query = mysqli_query($mysqli, "select nama_type from type where LCASE(nama_type)='" . strtolower($nama_type) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nama Type Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => " Nama Type Tersedia"));
    }
}

if (isset($_POST['kode_type'])) {
    $kode_type = mysqli_real_escape_string($mysqli, $_POST['kode_type']);
    $query = mysqli_query($mysqli, "select kode_type from type where LCASE(kode_type)='" . strtolower($kode_type) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nama Type Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => " Nama Type Tersedia"));
    }
}

if (isset($_POST['nama_artikel'])) {
    $nama_artikel = mysqli_real_escape_string($mysqli, $_POST['nama_artikel']);
    $query = mysqli_query($mysqli, "select nama_artikel from artikel where LCASE(nama_artikel)='" . strtolower($nama_artikel) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Nama Artikel Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => " Nama Artikel Tersedia"));
    }
}

if (isset($_POST['kode_artikel'])) {
    $kode_artikel = mysqli_real_escape_string($mysqli, $_POST['kode_artikel']);
    $query = mysqli_query($mysqli, "select kode_artikel from artikel where LCASE(kode_artikel)='" . strtolower($kode_artikel) . "'");
    if ($query->num_rows > 0) {
        echo json_encode(array("result" => "fail", "msg" => "Maaf, Kode Artikel Sudah digunakan"));

    } else {
        echo json_encode(array("result" => "success", "msg" => " Kode Artikel Tersedia"));
    }
}


?>