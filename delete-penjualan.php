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
 <!-- SESION -->
 
<?php 
    if ($role == 'Team Financial' ){ ?>
    <h1 class="mt-4" align="center"><b style="color: #03a33b;">Maaf,</b> Anda Tidak<b style="color: #03a33b;"> Mempunyai Akses</b></h1>
    <?php include("../footer.php"); ?>
<?php 
}

    if($role == 'CEO' || $role == 'Manajer' || $role == 'Team Marketing' || $role == 'Team Produksi'){ ?>

		<?php
		// include database connection file
		include_once("config.php");
		$kode_produk = $_GET['kode_produk'];
		$result = mysqli_query($mysqli, "DELETE FROM penjualan WHERE kode_produk=$kode_produk");


		header("Location:daftar-penjualan.php?berhasil_delete");
		?>

<?php } ?>