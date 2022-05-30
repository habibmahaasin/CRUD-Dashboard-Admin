<?php include_once("config.php"); ?>

        <?php 

        $error = "";
        $pesan = "";

        if(isset($_POST['Submit'])) {
            $kode_artikel = $_POST['kode_artikel'];
            $kode_type = $_POST['kode_type'];
            $kode_kategori = $_POST['kode_kategori'];
            $kuantitas = $_POST['kuantitas'];
            $tanggal_add = $_POST['tanggal_add'];
            $diubah_oleh = $_POST['diubah_oleh'];

            $proses = mysqli_query($mysqli, "SELECT kode_artikel FROM penjualan WHERE kode_artikel='$_POST[kode_artikel]'");
            $cek = mysqli_fetch_array($proses,MYSQLI_NUM);

            if (empty($kode_artikel) || empty($kode_type) || empty($kode_kategori) || empty($kuantitas)){
                $error="Gagal Menambahkan. Semua Data <b>Wajib</b> Di Isi!";
                }

            elseif ($cek > 1) {
                $error="Gagal Menambahkan. Artikel <b>Sudah</b> Digunakan!";
                }

            else{
                include_once("config.php");
                $result = mysqli_query($mysqli, "INSERT INTO penjualan ( kode_artikel, kode_type, kode_kategori, kuantitas, tanggal_add, diubah_oleh) VALUES ('$kode_artikel', '$kode_type', '$kode_kategori', '$kuantitas', '$tanggal_add', '$diubah_oleh' ) "); 
                $pesan = "Artikel/Desain Berhasil di Tambahkan";
                }
            }
        ?>


<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Tambah Penjualan</title>
</head>
<body>

<?php include("header.php"); ?>


<!-- CEK ROLE APA YANG MASUK -->
<?php 
    if ($role == 'Team Financial' || $role == 'Team Marketing' ){ ?>
    <h1 class="mt-4" align="center"><b style="color: #03a33b;">Maaf,</b> Anda Tidak<b style="color: #03a33b;"> Mempunyai Akses</b></h1>
<?php 
}
    if($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi'){ ?>
<!-- END CEK ROLE APA YANG MASUK -->


<h1 class="mt-4" align="center"><b style="color: #03a33b">UPLOAD</b> PRODUK </h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
                <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form action="tambah-penjualan.php" method="post" name="form1">
                        
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >
                                <h6 align="center">Daftar Artikel Tersedia :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="kode_artikel"  class="custom-select">
                                            <option value="" ><span>Pilih Artikel</span></option>
                                            <?php
                                            $result = mysqli_query($mysqli,"SELECT * FROM artikel INNER JOIN status_barang ON artikel.status_barang = status_barang.kode_status ORDER BY kode_artikel ASC"); 
                                            while($data = mysqli_fetch_array($result)) {

                                                if ($data['status_barang'] == 3){
                                                    echo '<option value="'.$data['kode_artikel'].'">'.$data['nama_artikel'].'</option>';
                                                    }
                                                }
                                            ?>
                                     </select>
                                     <p align="right">* Hanya Artikel Berstatus <b style="color: green">Aktif</b> Yang Dapat Dijual</p>
                                </div>

                                <h6 align="center">Kategori Desain :</h6>
								<div class="col-sm-13" style="margin-bottom: 10px;">
            						<select name="kode_kategori" class="custom-select">
            								<option value=""><span>Pilih Kategori</span></option>
            							    <?php
            							    $result = mysqli_query($mysqli,"SELECT * FROM kategori ORDER BY nama_kategori ASC"); 
										    while($data = mysqli_fetch_array($result)) {
										       echo '<option value="'.$data['kode_kategori'].'">'.$data['nama_kategori'].'</option>';
										        }
										    ?>
									 </select>
								</div>

                                <h6 align="center">Type Desain :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="kode_type" class="custom-select">
                                        <option value=""><span>Pilih Type</span></option>
                                            <?php
                                            $result = mysqli_query($mysqli,"SELECT * FROM type ORDER BY nama_type ASC"); 
                                            while($data = mysqli_fetch_array($result)) {
                                               echo '<option value="'.$data['kode_type'].'">'.$data['nama_type'].'</option>';
                                                }
                                            ?>
                                     </select>
                                </div>
								
                                <h6 align="center">Jumlah Stock Tersedia :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-shopping-cart text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control"  placeholder="Masukkan Disini" name="kuantitas">
                                    </div>
                                </div>



                                <?php $tanggal_add = date("Y-m-d H:i:s"); ?>
                                <input type="hidden" name="tanggal_add" value="<?php echo $tanggal_add; ?>">
                                <input type="hidden" name="diubah_oleh" value="<?php echo $nama; ?>">


                                <div class="text-center">
                                    <input type="submit" value="Submit"  id="submit" name="Submit" class="btn btn-success btn-block rounded-0 py-2">
                                </div>
                                <h6 align="left" style="margin-top: 15px"><a href='javascript:history.go(-1)' class="add" style="al"><button type="button" style="margin-bottom: 4px; background-color: #343a40; color: white"  class="btn"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back </button></a></h6>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
        <h6 align="center" style="margin-top: -35px; color: #d90421;"><?php echo $error;?></h6>
        <h6 align="center" style="margin-top: -35px; color: #03a33b"><?php echo $pesan;?></h6>

    </body>
</html>

<?php } ?>
<?php include("footer.php"); ?>
