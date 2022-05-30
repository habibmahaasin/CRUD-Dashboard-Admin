<?php include_once("config.php"); ?>
<?php 	
		
		$pesan = "";
		$error = "";
        $tanggal = date("Y-m-d H:i:s");


		if(isset($_POST['Submit'])) {
	        $nama_artikel = $_POST['nama_artikel'];
            $kode_artikel = $_POST['kode_artikel'];
            $harga = $_POST['harga'];
            $status_barang = $_POST['status_barang'];
            $tanggal = $_POST['tanggal'];
            $editor = $_POST['editor'];


	        if (empty($nama_artikel) || empty($kode_artikel) || empty($harga)){
                $error="Gagal Menambahkan. Semua Data <b>Wajib</b> Di Isi!";
                }

	        else{
                include_once("config.php");
                $result = mysqli_query($mysqli, "INSERT INTO artikel(nama_artikel,kode_artikel,status_barang,harga,tanggal,editor) VALUES('$nama_artikel','$kode_artikel','$status_barang','$harga','$tanggal','$editor')");
                $pesan = "Artikel Berhasil di Tambahkan";
                }
        }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Tambah Artikel</title>
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

<h1 class="mt-4" align="center"><b style="color: #03a33b">TAMBAH</b> ARTIKEL</h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
            <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form action="tambah-artikel.php" method="post" name="form1">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <div class="form-group">
                                    <h6 align="center">Kode Artikel: </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-code text-success"></i></div>
                                        </div>

                                        <input type="text" class="form-control" id="kode_artikel" placeholder="Masukkan Disini" name="kode_artikel" autocomplete="off">
                                    </div>
                                    <div class="error" align="right" id="error_kode_artikel"></div>
                                </div>

                                <div class="form-group">
                                	<h6 align="center">Nama Artikel: </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-address-card text-success"></i></div>
                                        </div>

                                        <input type="text" class="form-control" id="nama_artikel" placeholder="Masukkan Disini" name="nama_artikel" autocomplete="off">
                                    </div>
                                    <div class="error" align="right" id="error_nama_artikel"></div>
                                </div>

                                
                                <div class="form-group">
                                    <h6 align="center">Harga :</h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-credit-card text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Masukkan Disini" name="harga">
                                    </div>
                                </div>

                                <h6 align="center">Status Artikel :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="status_barang" class="custom-select">
                                            <option value=""><span>Pilih Status</span></option>
                                            <?php
                                            $result = mysqli_query($mysqli,"SELECT * FROM status_barang ORDER BY kode_status ASC"); 
                                            while($data = mysqli_fetch_array($result)) {
                                               echo '<option value="'.$data['kode_status'].'">'.$data['status'].'</option>';
                                                }
                                            ?>
                                     </select>
                                </div>

                                <?php $tanggal = date("Y-m-d H:i:s"); ?>
                                
                                <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                                <input type="hidden" name="editor" value="<?php echo $nama; ?>">
                                
                                <div class="text-center">
                                    <input type="submit" value="Tambahkan" name="Submit" id="submit" class="btn btn-success btn-block rounded-0 py-2">
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
                        $(document).on("keyup", "#nama_artikel", function () {
                            var nama_artikel = $(this).val();
                            if (nama_artikel == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {nama_artikel: nama_artikel},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_nama_artikel").html(data.msg);
                                        $("#error_nama_artikel").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_nama_artikel").html(data.msg);
                                        $("#error_nama_artikel").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');

                                    }
                                }
                            });
                        });

        </script>

        <script type="text/javascript">
            $(document).on("keyup", "#kode_artikel", function () {
                            var kode_artikel = $(this).val();
                            if (kode_artikel == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {kode_artikel: kode_artikel},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_kode_artikel").html(data.msg);
                                        $("#error_kode_artikel").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_kode_artikel").html(data.msg);
                                        $("#error_kode_artikel").removeClass('succ_green').addClass('err_red');
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