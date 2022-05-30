<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location:login/index.php?login_dulu");
    exit;
}

$id_user=$_SESSION["id_user"];
$username=$_SESSION["username"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];
$role=$_SESSION["role"];
$nomor_telp=$_SESSION["nomor_telp"];
$password=$_SESSION["password"];
$tanggal_add=$_SESSION["tanggal_add"];
$ditambah_oleh=$_SESSION["ditambah_oleh"];



date_default_timezone_set('Asia/Jakarta');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <!------------- DIATAS HEAD -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="mahaasin" />
        <title>RELOADD | Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><b style="color: #03a33b"> RELO</b><b>ADD</b></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars" style="color: #03a33b"></i></button>
            <ul class="navbar-nav ml-auto ml-md-12">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw" style="color: #03a33b"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" style="text-align: center;" ><?php echo $nama; ?></a>
                        <a class="dropdown-item" >Role Anda : <?php echo $role; ?> <i style="color: #03a33b" class="fa fa-check-circle" aria-hidden="true"></i></a>
                        <a class="dropdown-item" style="text-align: center; color: #03a33b" href="info-account.php">Detail Account </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login/logout.php" style="color: red">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-home" style="color: #03a33b" aria-hidden="true"></i></div>
                                <b style="color: #03a33b">HOME</b>
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface <?php echo $role ?></div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: #03a33b"></i></div>
                                <b style="color: #03a33b">PENJUALAN</b>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="daftar-penjualan.php">Daftar Penjualan</a>

                                    <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi') { ?>
                                    <a class="nav-link" href="tambah-penjualan.php">Tambah Produk</a>
                                    <?php } ?>

                                </nav>
                            </div>

                            <a class="nav-link collapsed"  href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" role="button"  aria-controls="pages" class="sidebar-link text-muted"><div class="sb-nav-link-icon" style="color: #03a33b"><i class="fa fa-child" aria-hidden="true"></i></div>
                                <b style="color: #03a33b"> ARTIKEL</b><div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a></a>
                            <div id="pages" class="collapse">
                              <ul class="sidebar-menu list-unstyled">
                                 <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="daftar-artikel.php">Daftar Artikel</a>
                                <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi' ) { ?>
                                    <a class="nav-link" href="tambah-artikel.php">Tambah Artikel</a>
                                <?php } ?>

                                </nav>
                              </ul>
                            </div>

                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon" style="color: #03a33b"><i class="fas fa-tags"></i></div>
                                <b style="color: #03a33b">KATEGORI</b>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" >
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="daftar-kategori.php">Daftar Kategori</a>

                                <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi' ) { ?>
                                <a class="nav-link" href="tambah-kategori.php">Tambah Kategori</a> 
                                <?php } ?>      

                                </nav> 
                            </div>

                             <a class="nav-link collapsed" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="sb-nav-link-icon" style="color: #03a33b"><i class="fas fa-shopping-basket"></i></div>
                                    <b style="color: #03a33b">TYPE</b>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                    <div class="collapse" id="collapseExample" >
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="daftar-type.php">Daftar Type</a>
                                <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi' ) { ?>
                                    <a class="nav-link" href="tambah-type.php">Tambah Type</a>
                                <?php } ?>

                                </nav>
                            </div>

                            


                  <div class="sb-sidenav-menu-heading">Menu Lain <?php echo $role ?></div>
                            <div class="menu">

                        <?php 
                            if ($role == 'CEO' || $role == 'Manajer') { ?>
                            <a class="nav-link" href="tambah-staff.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user-plus" style="color: #03a33b" aria-hidden="true"></i></div>
                                <b style="color: #03a33b">TAMBAH STAFF</b>
                            </a>

                        <?php } ?>

                            <a class="nav-link" href="daftar-staff.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user" style="color: #03a33b" aria-hidden="true"></i></div>
                                <b style="color: #03a33b">DAFTAR STAFF</b>
                            </a>
                            
                        <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Financial' || $role == 'Team Marketing' || $role == 'Team Produksi') { ?>
                            <a class="nav-link" href="daftar-pesanan.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-list" style="color: #03a33b" aria-hidden="true"></i></div>
                                <b style="color: #03a33b">PESANAN</b>
                            </a>
                        <?php } ?>
                            

                        </div>
                    </div>
                </div>
                    <div class="sb-sidenav-footer">
                        <div class="small" style="margin-top: 11px; margin-bottom: 11px;">Logged in as : <?php echo $username; ?></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4" style="margin-top: 5px;">


                            <?php $tanggal = mktime(date('m'), date("d"), date('Y'));

                            date_default_timezone_set("Asia/Jakarta");
                            $jam = date ("H:i:s");
                            $a = date ("H");
                            if (($a>=6) && ($a<=11)) {
                                $ucapan = " <b>Selamat Pagi</b>";
                                $ucapan2 = "Jangan Lupa Sarapan !";
                            }else if(($a>=11) && ($a<=15)){
                                $ucapan = " <b>, Selamat Siang</b> ";
                                $ucapan2 = "Jangan Lupa Makan Siang !";
                            }elseif(($a>15) && ($a<=18)){
                                $ucapan = "<b>Selamat Sore</b> ";
                                $ucapan2 = "Jangan Lupa Mandi !";
                            }else{
                                $ucapan = "<b>Selamat Malam </b>";
                                $ucapan2 = "Jangan Tidur Malam-Malam !";
                            } ?>

                            <marquee width="100%" scrollamount="8"><b>[ <b>Hari Ini <?php echo date("d-m-Y", $tanggal ) ?> ] </b><?php echo $ucapan; ?> <b style="color: green"><?php echo $nama; ?></b> <?php echo $ucapan2; ?> [ Anda adalah Bagian dari <?php echo $role ?> <b style="color: #03a33b">Relo</b><b>add</b> Company ] </b></marquee>
                        </ol>