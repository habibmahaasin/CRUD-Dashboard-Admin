<?php
session_start();

include "../config.php";

$username = $_POST["username"];
$p = md5($_POST["password"]);

$sql = "select * from admin where username='".$username."' and password='".$p."' limit 1";
$hasil = mysqli_query ($mysqli,$sql);
$jumlah = mysqli_num_rows($hasil);

    if ($jumlah>0) {
        $row = mysqli_fetch_assoc($hasil);
        $_SESSION["id_user"]=$row["id_user"];
        $_SESSION["username"]=$row["username"];
        $_SESSION["nama"]=$row["nama"];
        $_SESSION["email"]=$row["email"];
        $_SESSION["role"]=$row["role"];
        $_SESSION["nomor_telp"]=$row["nomor_telp"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["tanggal_add"] = $row["tanggal_add"];
        $_SESSION["ditambah_oleh"] = $row["ditambah_oleh"];


        header("Location:../index.php");
        
    }else {
        header("Location: index.php?gagal");
    }
?>