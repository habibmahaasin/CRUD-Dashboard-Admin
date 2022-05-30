<?php 
include_once("config.php");


if(isset($_POST['update']))
{   
      $password = md5($_POST['password']);
      $id_user=$_POST["id_user"];
			$username=$_POST["username"];
			$nama=$_POST["nama"];
			$email=$_POST["email"];
			$role=$_POST["role"];
			$nomor_telp=$_POST["nomor_telp"];
			$tanggal_add=$_POST["tanggal_add"];
			$ditambah_oleh=$_POST["ditambah_oleh"];

      if (empty($_POST['password'])){
              echo "<script language='javascript'>
                  document.location='info-account.php?error';
                  </script>"; 
      }

      elseif(strlen($_POST['password']) < 6){
            echo "<script language='javascript'>
                  document.location='info-account.php?gagal';
                  </script>"; 
      }
      
      else{  
            $result = mysqli_query($mysqli, "UPDATE admin SET username ='$username',nama = '$nama', email='$email',role = '$role',nomor_telp='$nomor_telp',tanggal_add='$tanggal_add', ditambah_oleh = '$ditambah_oleh', password = '$password' WHERE id_user='$id_user'");
            echo "<script language='javascript'>
                        document.location='info-account.php?berhasil';
                  </script>"; 
      }
}
?>

<!DOCTYPE html>
<html>
<head>
   <link rel="shortcut icon" href="images/favicon.ico">
	 <title>Reloadd | Info Account</title>
</head>
<body>
<?php include("header.php"); ?>


  <div class="container" style="margin-bottom: 30px;">
    <div class="screen">
      <div class="screen-header">
        <div class="screen-header-left">
          <div class="screen-header-button minimize"></div>
          <div class="screen-header-button minimize"></div>
          <div class="screen-header-button minimize"></div>
        </div>
        <div class="screen-header-right">
          <div class="screen-header-ellipsis"></div>
          <div class="screen-header-ellipsis"></div>
        </div>
      </div>
      <div class="screen-body">
        <div class="screen-body-item left">
          <div class="app-title">
            <span>Detail</span>
            <span>Account</span>
          </div>
          <div class="app-contact"></div>
        </div>
        <div class="screen-body-item">

        	<?php 
        	if(isset($_GET["berhasil"])){
            echo "<p style='color:#03a33b';><i><b>Password Berhasil di Ganti !</b></i></p>";
        	}
   		   	?>

          <?php 
          if(isset($_GET["gagal"])){
            echo "<p style='color: red';><i><b>Password Gagal di Ganti ! Minimal 6 Karakter</b></i></p>";
          }
          ?>

          <?php 
          if(isset($_GET["error"])){
            echo "<p style='color: red';><i><b>Password Wajib Di isi</b></i></p>";
          }
          ?>

          <div class="app-form">
            <div class="app-form-group">
              <p class="app-form-control"><b style="text-align: center;">Nama : </b><?php echo $nama; ?></p>
            </div>
            <div class="app-form-group">
              <p class="app-form-control" ><b style="text-align: center;">Email : </b><?php echo $email; ?></p>
            </div>
            <div class="app-form-group">
              <p class="app-form-control" ><b style="text-align: center;">No.Hp : </b><?php echo $nomor_telp; ?></p>
            </div>
            <div class="app-form-group">
              <p class="app-form-control" ><b style="text-align: center;"> Role : </b><?php echo $role; ?></p>
            </div>
            <div class="app-form-group buttons" align="right">
               <a href="info-account.php?change-password"><button style="margin-bottom: 20px;" class="btn btn-success btn rounded-5 py-2">Ganti Password</button></a>
            </div>


             <?php 
		        if(isset($_GET["change-password"])){ ?>

			        <form name="changePassword" method="POST" action="info-account.php">
			            <div class="app-form-group">
			              <input class="app-form-control" type="Password" name="password" placeholder="Masukkan Password Baru">
			            </div>
			            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
			            <input type="hidden" name="username" value="<?php echo $username; ?>">
			            <input type="hidden" name="email" value="<?php echo $email; ?>">
			            <input type="hidden" name="nomor_telp" value="<?php echo $nomor_telp; ?>">
			            <input type="hidden" name="role" value="<?php echo $role; ?>">
			            <input type="hidden" name="tanggal_add" value="<?php echo $tanggal_add; ?>">
			            <input type="hidden" name="ditambah_oleh" value="<?php echo $ditambah_oleh; ?>">
			            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

			        <input type="submit" name="update" value="Simpan" class="btn btn-success btn-block rounded-5 py-2">
			        <a href="info-account.php" style="text-decoration: none"><button style="margin-top: 5px;" class="btn btn-danger btn-block rounded-5 py-2">Cancel</button></a>
			    </form>
		        
		        <?php }
		    ?>

        
          </div>
        </div>
      </div>
    </div>

<?php include("footer.php"); ?>

</body>
</html>


<!-- CSS -->

<style type="text/css">
	*, *:before, *:after {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.background {
  display: flex;
  min-height: 100vh;
}

.container {
  flex: 0 1 700px;
  margin: auto;
  padding: 10px;
}

.screen {
  position: relative;
  background: #3e3e3e;
  border-radius: 15px;
}

.screen:after {
  content: '';
  display: block;
  position: absolute;
  top: 0;
  left: 20px;
  right: 20px;
  bottom: 0;
  border-radius: 15px;
  
  z-index: -1;
}

.screen-header {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  background: #4d4d4f;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}

.screen-header-left {
  margin-right: auto;
}

.screen-header-button {
  display: inline-block;
  width: 8px;
  height: 8px;
  margin-right: 3px;
  border-radius: 8px;
  background: white;
}

.screen-header-button.close {
  background: #ed1c6f;
}

.screen-header-button.maximize {
  background: #e8e925;
}

.screen-header-button.minimize {
  background: #74c54f;
}

.screen-header-right {
  display: flex;
}

.screen-header-ellipsis {
  width: 3px;
  height: 3px;
  margin-left: 2px;
  border-radius: 8px;
  background: #999;
}

.screen-body {
  display: flex;
}

.screen-body-item {
  flex: 1;
  padding: 50px;
}

.screen-body-item.left {
  display: flex;
  flex-direction: column;
}

.app-title {
  display: flex;
  flex-direction: column;
  position: relative;
  color: #03a33b;
  font-size: 26px;
}

.app-title:after {
  content: '';
  display: block;
  position: absolute;
  left: 0;
  bottom: -10px;
  width: 25px;
  height: 4px;
  background: #03a33b;
}

.app-contact {
  margin-top: auto;
  font-size: 8px;
  color: #fff;
}

.app-form-group {
  margin-bottom: 15px;
}

.app-form-group.message {
  margin-top: 40px;
}

.app-form-group.buttons {
  margin-bottom: 0;
  text-align: right;
}

.app-form-control {
  width: 100%;
  padding: 10px 0;
  background: none;
  border: none;
  border-bottom: 1px solid #666;
  color: #fff;
  font-size: 14px;
  text-transform: uppercase;
  outline: none;
  transition: border-color .2s;
}

.app-form-control::placeholder {
  color: #666;
}

.app-form-control:focus {
  border-bottom-color: #ddd;
}

.app-form-button {
  background: none;
  border: none;
  color: #ea1d6f;
  font-size: 14px;
  cursor: pointer;
  outline: none;
}

.app-form-button:hover {
  color: #b9134f;
}

.credits {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  color: #ffa4bd;
  font-family: 'Roboto Condensed', sans-serif;
  font-size: 16px;
  font-weight: normal;
}

.credits-link {
  display: flex;
  align-items: center;
  color: #fff;
  font-weight: bold;
  text-decoration: none;
}

.dribbble {
  width: 20px;
  height: 20px;
  margin: 0 5px;
}

@media screen and (max-width: 520px) {
  .screen-body {
    flex-direction: column;
  }

  .screen-body-item.left {
    margin-bottom: 30px;
  }

  .app-title {
    flex-direction: row;
  }

  .app-title span {
    margin-right: 12px;
  }

  .app-title:after {
    display: none;
  }
}

@media screen and (max-width: 600px) {
  .screen-body {
    padding: 40px;
  }

  .screen-body-item {
    padding: 0;
  }
}


</style>