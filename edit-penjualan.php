<?php 
include_once("config.php");

if(isset($_POST['update']))
{   
            $kode_produk  = $_POST['kode_produk'];
            $kode_artikel = $_POST['kode_artikel'];
            $kode_type = $_POST['kode_type'];
            $kode_kategori = $_POST['kode_kategori'];
            $kuantitas = $_POST['kuantitas'];
            $tanggal_add = $_POST['tanggal_add'];
            $diubah_oleh = $_POST['diubah_oleh'];

           
         if (empty($kode_artikel) || empty($kode_type) || empty($kode_kategori)){
            echo "<script language='javascript'>
                        alert('Data tidak boleh ada yang kosong ! ');
                        document.location='?id_desain=$id_desain';
                  </script>";  
        }


        else{ 
            $result = mysqli_query($mysqli, "UPDATE penjualan SET kode_artikel ='$kode_artikel',kode_type = '$kode_type', kode_kategori='$kode_kategori',kuantitas = '$kuantitas', tanggal_add = '$tanggal_add', diubah_oleh = '$diubah_oleh' WHERE kode_produk='$kode_produk'");
            header("Location:daftar-penjualan.php?berhasil_edit");
        }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Edit Penjualan</title>
</head>
<body>

<?php include("header.php"); ?>

<!-- CEK ROLE APA YANG MASUK -->
<?php 
    if ($role == 'Team Financial' ){ ?>
    <h1 class="mt-4" align="center"><b style="color: #03a33b;">Maaf,</b> Anda Tidak<b style="color: #03a33b;"> Mempunyai Akses</b></h1>
<?php 
}
    if($role == 'CEO' || $role == 'Manajer' || $role == 'Team Marketing' || $role == 'Team Produksi'){ ?>
<!-- END CEK ROLE APA YANG MASUK -->


<?php
        date_default_timezone_set('Asia/Jakarta');
        include_once("config.php");
        $kode_produk = $_GET['kode_produk'];

        $result_awal = mysqli_query($mysqli, "SELECT * FROM penjualan WHERE kode_produk='$kode_produk'");

        while($data = mysqli_fetch_array($result_awal))
    { 
?>

<h1 class="mt-4" align="center"><b style="color: #03a33b">EDIT</b> PRODUK</h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
             <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form name="update" method="POST" action="edit-penjualan.php">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <h6 align="center">Daftar Artikel Tersedia :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="kode_artikel" class="form-control" required>
                                            <?php
                                            $result = mysqli_query($mysqli, "SELECT * FROM artikel INNER JOIN status_barang ON artikel.status_barang = status_barang.kode_status ORDER BY kode_artikel ASC ");
                                            while($data_type= mysqli_fetch_array($result)){ 
                                                if ($data_type['status_barang'] == 3){
                                                ?>
                                                
                                                <option value="<?php echo $data_type['kode_artikel']; ?>"

                                                <?php 
                                                if ($data['kode_artikel'] == $data_type['kode_artikel'])

                                                {
                                                    echo "selected";
                                                } ?>

                                                ><?php echo $data_type['nama_artikel']; ?></option>
                                                
                                                <?php 
                                                 }}
                                                ?>
                                     </select>
                                     <p align="right">* Hanya Artikel Berstatus <b style="color: green">Aktif</b> Yang Dapat Dijual</p>
                                </div>

                                 <h6 align="center">Kategori Desain :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="kode_kategori" class="form-control" required>
                                            <?php
                                            $result = mysqli_query($mysqli, "SELECT * FROM kategori ORDER BY kode_kategori ASC ");
                                            while($data_kategori= mysqli_fetch_array($result)){ ?>
                                                <option value="<?php echo $data_kategori['kode_kategori']; ?>"

                                                <?php 
                                                if ($data['kode_kategori'] == $data_kategori['kode_kategori'])

                                                {
                                                    echo "selected";
                                                } ?>
                                                
                                                ><?php echo $data_kategori['nama_kategori']; ?></option>
                                                
                                                <?php 
                                                 }
                                                ?>
                                     </select>
                                </div>


                                <h6 align="center">Type Desain :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="kode_type" class="form-control" required>
                                            <?php
                                            $result = mysqli_query($mysqli, "SELECT * FROM type ORDER BY kode_type ASC ");
                                            while($data_type= mysqli_fetch_array($result)){ ?>
                                                <option value="<?php echo $data_type['kode_type']; ?>"

                                                <?php 
                                                if ($data['kode_type'] == $data_type['kode_type'])

                                                {
                                                    echo "selected";
                                                } ?>

                                                ><?php echo $data_type['nama_type']; ?></option>
                                                
                                                <?php 
                                                 }
                                                ?>
                                     </select>
                                </div>

                                <h6 align="center">Jumlah Stock :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                        </div>
                                       <input type="textarea" name="kuantitas" class="form-control" value="<?php echo $data['kuantitas']; ?>">
                                    </div>
                                </div>

                                <input type="hidden" name="kode_produk" class="form-control" value="<?php echo $data['kode_produk']; ?>">
                                <input type="hidden" name="tanggal_add" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                <input type="hidden" name="diubah_oleh" value="<?php echo $nama; ?>">


                                <div class="text-center">
                                    <input type="submit" name="update"  id="submit" value="Simpan" class="btn btn-success btn-block rounded-0 py-2">
                                </div>
                                <h6 align="left" style="margin-top: 15px"><a href='javascript:history.go(-1)' class="add" style="al"><button type="button" style="margin-bottom: 4px; background-color: #343a40; color: white"  class="btn"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back </button></a></h6>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
<?php 
}
?>


	</body>	
</html>


<?php } ?>
<?php include("footer.php"); ?>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
                        $(document).on("keyup", "#nama_desain", function () {
                            var nama_desain = $(this).val();
                            if (nama_desain == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {nama_desain: nama_desain},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_nama_desain").html(data.msg);
                                        $("#error_nama_desain").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_nama_desain").html(data.msg);
                                        $("#error_nama_desain").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');

                                    }
                                }
                            });
                        });
        </script>

        <style>
            .err_red{
                color: red;
                font-style: bold;
            }
            .succ_green{
                color: green;
            }
        </style>
