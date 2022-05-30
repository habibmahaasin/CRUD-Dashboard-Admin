<?php include_once("config.php"); ?>
<?php 	
		
		$pesan = "";
		$error = "";



		if(isset($_POST['Submit'])) {

            $kode_type = $_POST['kode_type'];
	        $nama_type = $_POST['nama_type'];
            $tanggal = $_POST['tanggal'];
            $editor = $_POST['editor'];


            if (empty($nama_type) || empty($kode_type)){
                $error="Gagal Menambahkan. Semua Data <b>Wajib</b> Di Isi!";
                }
                
            else{
                $result = mysqli_query($mysqli, "INSERT INTO type(kode_type,nama_type,tanggal,editor) VALUES('$kode_type','$nama_type','$tanggal','$editor')");
                $pesan = "Type Berhasil di Tambahkan";            
            }     
        }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Tambah Type</title>
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

<h1 class="mt-4" align="center"><b style="color: #03a33b">TAMBAH</b> TYPE</h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
            <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form action="tambah-type.php" method="post" name="form1">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <div class="form-group">
                                    <h6 align="center">Kode Type: </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-code text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="kode_type" placeholder="Masukkan Disini" name="kode_type" autocomplete="off">
                                    </div>
                                    <div class="error" align="right" id="error_kode_type"></div>
                                </div>
                                
                                <div class="form-group">
                                	<h6 align="center">Nama Type : </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-tags text-success"></i></div>
                                        </div>

                                        <input type="text" class="form-control" id="nama_type" placeholder="Masukkan Disini" name="nama_type" autocomplete="off">
                                    </div>
                                    <div class="error" align="right" id="error_nama_type"></div>
                                </div>

                                <?php $tanggal = date("Y-m-d H:i:s"); ?>
                                <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
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
                        $(document).on("keyup", "#nama_type", function () {
                            var nama_type = $(this).val();
                            if (nama_type == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {nama_type: nama_type},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_nama_type").html(data.msg);
                                        $("#error_nama_type").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_nama_type").html(data.msg);
                                        $("#error_nama_type").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');

                                    }
                                }
                            });
                        });
        </script>

        <script>
                        $(document).on("keyup", "#kode_type", function () {
                            var kode_type = $(this).val();
                            if (kode_type == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {kode_type: kode_type},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_kode_type").html(data.msg);
                                        $("#error_kode_type").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_kode_type").html(data.msg);
                                        $("#error_kode_type").removeClass('succ_green').addClass('err_red');
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
