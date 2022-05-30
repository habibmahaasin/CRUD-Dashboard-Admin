<?php 
include_once("config.php");


if(isset($_POST['update']))
{   
            $kode_type = $_POST['kode_type'];
            $nama_type = $_POST['nama_type'];
            $tanggal = $_POST['tanggal'];
            $editor = $_POST['editor'];


        if(empty($nama_type)){
            echo "<script language='javascript'>
                        alert('Data tidak boleh ada yang kosong ! ');
                        document.location='?kode_type=$kode_type';
                  </script>";  
        }

        else{ 
            $result = mysqli_query($mysqli, "UPDATE type SET nama_type ='$nama_type', tanggal = '$tanggal', editor = '$editor' WHERE kode_type='$kode_type'");
             header("Location:daftar-type.php?berhasil_edit");
        }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Edit Type</title>
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
        $kode_type = $_GET['kode_type'];

        $result_awal = mysqli_query($mysqli, "SELECT * FROM type WHERE kode_type='$kode_type'");

        while($data = mysqli_fetch_array($result_awal))
    { 
?>

<h1 class="mt-4" align="center"><b style="color: #03a33b">EDIT</b> TYPE</h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
            <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form name="update" method="POST" action="edit-type.php">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <div class="form-group">
                                    <h6 align="center">Kode Type: </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-code text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="kode_type" placeholder="Masukkan Disini" name="kode_type" value="<?php echo $data['kode_type']; ?>" autocomplete="off" readonly>
                                    </div>
                                    <div class="error" align="right" id="error_kode_type"></div>
                                </div>

                                <div class="form-group">
                                	<h6 align="center">Nama Type :</h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-success"></i></div>
                                        </div>
                                        <input type="textarea" name="nama_type" class="form-control" id="nama_type" value="<?php echo $data['nama_type']; ?>">
                                    </div>
                                    <div class="error" align="right" id="error_nama_type"></div>
                                </div>

                                <?php $tanggal = date("Y-m-d H:i:s"); ?>
                                <input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">

                                <input type="hidden" name="editor" value="<?php echo $nama; ?>">

                                <div class="text-center">
                                    <input type="submit" name="update" id="submit" value="Simpan" class="btn btn-success btn-block rounded-0 py-2">
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

        <style>
            .err_red{
                color: red;
                font-style: bold;
            }
            .succ_green{
                color: green;
            }
        </style>
