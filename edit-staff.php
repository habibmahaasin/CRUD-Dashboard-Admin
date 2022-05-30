<?php 
include_once("config.php");

if(isset($_POST['update']))
{   
            $username = $_POST['username'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $nomor_telp = $_POST['nomor_telp'];
            $role = $_POST['role'];
            $tanggal_add = $_POST['tanggal_add'];
            $ditambah_oleh = $_POST['ditambah_oleh'];
            $id_user = $_POST['id_user'];


    
            $result = mysqli_query($mysqli, "UPDATE admin SET username ='$username',nama = '$nama', email='$email',password = '$password',nomor_telp='$nomor_telp',role='$role', tanggal_add = '$tanggal_add', ditambah_oleh = '$ditambah_oleh' WHERE id_user='$id_user'");
            header("Location:daftar-staff.php?berhasil_edit");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Edit Produk</title>
</head>
<body>

<?php include("header.php"); ?>

<!-- CEK ROLE APA YANG MASUK -->
<?php 
    if ($role == 'Team Financial' || $role == 'Manajer' || $role == 'Team Marketing' || $role == 'Team Produksi' ){ ?>
    <h1 class="mt-4" align="center"><b style="color: #03a33b;">Maaf,</b> Anda Tidak<b style="color: #03a33b;"> Mempunyai Akses</b></h1>
<?php 
}
    if($role == 'CEO' ){ ?>
<!-- END CEK ROLE APA YANG MASUK -->


<?php
        date_default_timezone_set('Asia/Jakarta');
        include_once("config.php");
        $id_user = $_GET['id_user'];

        $result_awal = mysqli_query($mysqli, "SELECT * FROM admin WHERE id_user='$id_user'");

        while($data = mysqli_fetch_array($result_awal))
    { 
?>

<h1 class="mt-4" align="center"><b style="color: #03a33b">EDIT</b> ROLE</h1>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
            <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form name="update" method="POST" action="edit-staff.php">
                        <div class="card border-success rounded-0" style="margin-top: 20px;">
                            <div class="card-body p-3" >

                                <div class="form-group">
                                	<h6 align="center">Nama Staff :</h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-success"></i></div>
                                        </div>
                                        <input type="textarea" id="nama_desain" name="nama" class="form-control" value="<?php echo $data["nama"];?>" readonly="readonly">
                                    </div>
                                </div>

                                <h6 align="center">Role :</h6>
                                <div class="col-sm-13" style="margin-bottom: 10px;">
                                    <select name="role" class="form-control" required>
                                        <option value="<?php echo $data["role"];?>"><?php echo $data["role"];?></option>
                                        <option value="CEO"><span>CEO</span></option>
                                        <option value="Manajer"><span>Manajer</span></option>
                                        <option value="Team Produksi"><span>Team Produksi</span></option>
                                        <option value="Team Marketing"><span>Team Marketing</span></option>
                                        <option value="Team Financial"><span>Team Financial</span></option>
                                     </select>
                                </div>

                                <input type="hidden" name="id_user" class="form-control" value="<?php echo $data['id_user']; ?>">
                                <input type="hidden" name="tanggal_add" value="<?php echo $data['tanggal_add']?>">
                                <input type="hidden" name="ditambah_oleh" value="<?php echo $data['ditambah_oleh']; ?>">
                                <input type="hidden" name="nomor_telp" value="<?php echo $data['nomor_telp']; ?>">
                                <input type="hidden" name="password" value="<?php echo $data['password']; ?>">
                                <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                                <input type="hidden" name="username" value="<?php echo $data['username']; ?>">

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
