<?php include_once("config.php"); ?>

        <?php 

        $error = "";
        $pesan = "";

        if(isset($_POST['Submit'])) {
            $username = $_POST['username'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $nomor_telp = $_POST['nomor_telp'];
            $role = $_POST['role'];
            $tanggal_add = $_POST['tanggal_add'];
            $ditambah_oleh = $_POST['ditambah_oleh'];

            $proses = mysqli_query($mysqli, "SELECT username FROM admin WHERE username='$_POST[username]'");
            $cek = mysqli_fetch_array($proses,MYSQLI_NUM);

            if (empty($username) || empty($nama) || empty($email) || empty($password) || empty($nomor_telp) || empty($role)){
                $error="Gagal Menambahkan. Semua Form <b>Wajib</b> Di Isi!";
                }

            elseif ($cek > 1) {
                $error="Gagal Menambahkan. Username <b>Sudah</b> Digunakan!";
            }


            elseif(strlen($password) < 6){
                $error="Gagal Menambahkan. Passwor <b>Minimal</b> 6 Digit!";
            }

            elseif(!is_numeric($nomor_telp)){ 
                    $error="Gagal Menambahkan. Nomor Telp<b>Wajib</b> Berisi Angka!";
            }

            else{
                include_once("config.php");
                $result = mysqli_query($mysqli, "INSERT INTO admin (username,nama,email,password,nomor_telp,role,tanggal_add,ditambah_oleh) VALUES('$username','$nama','$email','$password','$nomor_telp','$role','$tanggal_add','$ditambah_oleh')"); 
                $pesan = "Staff Baru Berhasil di Tambahkan";
                }
            }
        ?>



<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Tambah Staff</title>
</head>
<body>
<?php include("header.php"); ?>



<!-- CEK ROLE APA YANG MASUK -->
<?php 
    if ($role == 'Team Financial' || $role == 'Team Marketing' || $role == 'Team Produksi'){ ?>
    <h1 class="mt-4" align="center"><b style="color: #03a33b;">Maaf,</b> Anda Tidak<b style="color: #03a33b;"> Mempunyai Akses</b></h1>
<?php 
}
    if($role == 'CEO' || $role == 'Manajer'){ ?>

<!-- END CEK ROLE APA YANG MASUK -->



<h1 class="mt-4" align="center"><b style="color: #03a33b">TAMBAH</b> STAFF</h1>

<div class="container-fluid">
	<div class="row justify-content-center">

		<div class="col-12 col-md-8 col-lg-6 pb-5">
                <p   align="right" style="margin-bottom: -15px"><b style="color: #03a33b">Semua Form</b> <b style="color: red">Wajib Diisi</b></p>
                    <form action="tambah-staff.php" method="post" name="form1">
                        
                        <div class="card border-success rounded-0" style="margin-top: 20px;">

                            <div class="card-body p-3" >

                                <div class="form-group">
                                	<h6 align="center">Username : </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-address-card text-success"></i></div>
                                        </div>
                                        <input type="text" id="username" name="username" autocomplete="off" class="form-control" placeholder="Masukkan Disini">
                                    </div>
                                    <div class="error" align="center" id="error_username"></div>
                                </div>

                                <div class="form-group">
                                    <h6 align="center">Password : </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key text-success"></i></div>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Masukkan Disini" name="password" title="Password Minimal 5 digit Karakter" pattern=".{6,}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h6 align="center">Nama Lengkap : </h6>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-address-card text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Masukkan Disini" name="nama">
                                    </div>
                                </div>
								
                                <h6 align="center">Email : </h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="email"  placeholder="Masukkan Disini" name="email" autocomplete="off">
                                    </div>
                                    <div class="error" align="center" id="error_email"></div>
                                </div>

                                <h6 align="center">Nomor Telephone / WA :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-phone text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nomor_telp" placeholder="Masukkan Disini" name="nomor_telp" autocomplete="off" title="Nomor Telp Minimal 10 digit Angka" pattern=".{10,}">
                                    </div>
                                    <div class="error" align="center" id="error_nomor_telp"></div>
                                </div>

                                <?php 
                                if ($role == 'CEO') { ?>
                                <h6 align="center">Role :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <select name="role" class="custom-select">
                                            <option value="" disabled selected><span>Pilih Role</span></option>
                                            <option value="CEO"><span>CEO</span></option>
                                            <option value="Manajer"><span>Manajer</span></option>
                                            <option value="Team Produksi"><span>Team Produksi</span></option>
                                            <option value="Team Marketing"><span>Team Marketing</span></option>
                                            <option value="Team Financial"><span>Team Financial</span></option>
                                     </select>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php 
                                if ($role == 'Manajer') { ?>
                                <h6 align="center">Role :</h6>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <select name="role" class="custom-select">
                                            <option value=""><span>Pilih Role</span></option>
                                            <option value="Team Produksi"><span>Team Produksi</span></option>
                                            <option value="Team Marketing"><span>Team Marketing</span></option>
                                            <option value="Team Financial"><span>Team Financial</span></option>
                                     </select>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php $tanggal_add = date("Y-m-d H:i:s"); ?>
                                <input type="hidden" name="tanggal_add" value="<?php echo $tanggal_add; ?>">
                                <input type="hidden" name="ditambah_oleh" value="<?php echo $nama; ?>">


                                <div class="text-center">
                                    <input type="submit" value="Submit" id="submit" name="Submit" class="btn btn-success btn-block rounded-0 py-2">
                                </div>
                                <h6 align="left" style="margin-top: 15px"><a href='index.php' class="add" ><button type="button" style="margin-bottom: 4px; background-color: #343a40; color: white"  class="btn"><i class="fa fa-home" aria-hidden="true"></i> Home </button></a></h6>

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
                        $(document).on("keyup", "#username", function () {
                            var username = $(this).val();
                            if (username == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {username: username},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_username").html(data.msg);
                                        $("#error_username").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);
                                    } else {
                                        $("#error_username").html(data.msg);
                                        $("#error_username").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');
                                    }
                                }
                            });
                        });
        </script>
        <script>
                        $(document).on("keyup", "#email", function () {
                            var email = $(this).val();
                            if (email == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {email: email},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_email").html(data.msg);
                                        $("#error_email").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);
                                    } else {
                                        $("#error_email").html(data.msg);
                                        $("#error_email").removeClass('succ_green').addClass('err_red');
                                        $('#submit').attr("disabled", 'disabled');
                                    }
                                }
                            });
                        });
        </script>
        <script>
                        $(document).on("keyup", "#nomor_telp", function () {
                            var nomor_telp = $(this).val();
                            if (nomor_telp == "") {
                                return false;
                            }
                            $.ajax({
                                url: 'check-slot.php',
                                type: 'POST',
                                data: {nomor_telp: nomor_telp},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.result == "success") {
                                        $("#error_nomor_telp").html(data.msg);
                                        $("#error_nomor_telp").removeClass('err_red').addClass('succ_green');
                                        $('#submit').attr("disabled", false);
                                    } else {
                                        $("#error_nomor_telp").html(data.msg);
                                        $("#error_nomor_telp").removeClass('succ_green').addClass('err_red');
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