<?php 
include_once("config.php");

if(isset($_POST['update']))
{   
            $kode_kategori = $_POST['kode_kategori'];
            $nama_kategori = $_POST['nama_kategori'];
            $size_chart = $_POST['size_chart'];
            $tanggal = $_POST['tanggal'];
            $editor = $_POST['editor'];

        if (empty($nama_kategori) || empty($kode_kategori) || empty($size_chart)){
            echo "<script language='javascript'>
                        alert('Data tidak boleh ada yang kosong ! ');
                        document.location='?id_kategori=$id_kategori';
                  </script>";  
        }

        else{ 
            $result = mysqli_query($mysqli, "UPDATE kategori SET nama_kategori ='$nama_kategori', size_chart ='$size_chart' , tanggal = '$tanggal', editor = '$editor' WHERE kode_kategori='$kode_kategori'");
             header("Location:daftar-kategori.php?berhasil_edit");
        }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Reloadd | Edit Kategori</title>
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
        $kode_kategori = $_GET['kode_kategori'];

        $result_awal = mysqli_query($mysqli, "SELECT * FROM kategori WHERE kode_kategori='$kode_kategori'");;

        while($data = mysqli_fetch_array($result_awal))
    { 
?>

<h1 class="mt-4" align="center"><b style="color: #03a33b">EDIT</b> KATEGORI</h1>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">
            <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form name="update" method="POST" action="edit-kategori.php">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <div class="form-group">
                                    <h6 align="center">Kode Kategori :</h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-code text-success"></i></div>
                                        </div>
                                        <input type="textarea" name="kode_kategori" id="kode_kategori" class="form-control" value="<?php echo $data['kode_kategori']; ?>" readonly>
                                    </div>
                                     <div class="error" align="right" id="error_kode_kategori"></div>
                                </div>

                                <div class="form-group">
                                    <h6 align="center">Nama Kategori :</h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-tags text-success"></i></div>
                                        </div>
                                        <input type="textarea" name="nama_kategori" id="nama_kategori" class="form-control" value="<?php echo $data['nama_kategori']; ?>">
                                    </div>
                                    <div class="error" align="right" id="error_nama_kategori"></div>
                                </div>

                                <h6 align="center">Detail Size Chart :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comments text-success"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Masukkan Disini" id="size_chart" name="size_chart"><?php echo $data['size_chart']; ?></textarea>
                                    </div>
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
                        $(document).on("keyup", "#nama_kategori", function () {
                            var nama_kategori = $(this).val();
                            if (nama_kategori == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {nama_kategori: nama_kategori},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_nama_kategori").html(data.msg);
                                        $("#error_nama_kategori").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_nama_kategori").html(data.msg);
                                        $("#error_nama_kategori").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');

                                    }
                                }
                            });
                        });
        </script>

        <script>
                        $(document).on("keyup", "#kode_kategori", function () {
                            var kode_kategori = $(this).val();
                            if (kode_kategori == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {kode_kategori: kode_kategori},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_kode_kategori").html(data.msg);
                                        $("#error_kode_kategori").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);

                                        
                                    } else {
                                        $("#error_kode_kategori").html(data.msg);
                                        $("#error_kode_kategori").removeClass('succ_green').addClass('err_red');
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