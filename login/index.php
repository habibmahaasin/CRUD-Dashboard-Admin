<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reloadd | Login Staff</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   
</head>


<body style="background-color: #03a33b">
    
<center>
    <div class="kotak_login">
    <img src="../images/reloadd-text.png" class="img-fluid" width="300">
        <hr>
    
    <?php 
        if(isset($_GET["berhasil"])){
            echo "<p style='color:#03a33b';><i>Akun Anda Berhasil di Daftarkan!. Silahkan Login</i></p>";
        }
    ?>

        <?php 
        if(isset($_GET["gagal"])){
            echo "<p style='color:red';><i>Password / Username Salah!</i></p>";
        }
    ?>

        <?php 
        if(isset($_GET["log_out"])){
            echo "<p style='color:#03a33b';><i>Akun Berhasil Keluar</i></p>";
        }
    ?>
        <?php 
        if(isset($_GET["login_dulu"])){
            echo "<p style='color:red';><i>Untuk Izin Akses, Silahkan Login Dahulu</i></p>";
        }
    ?>

        <form method="post" action="login_action.php">
        <div class="form-group">
            <label><b>Username:</b></label>
            <input type="text" class="form-control" name="username" placeholder="Masukan Username">
        </div>
        <div class="form-group" style="margin-top: 30px">
            <label><b>Password:</b></label>
            <input type="password" class="form-control" name="password" placeholder="Masukan Password">
        </div>

        <div class="form-group" style="margin-top: 15px;">
        <br>
        <hr>
            <input type="submit"  type="button" class="btn btn-success "  value="Sign In">

            <br>
            </div>
        </form>
    </div>
</center>



</body>
</html>