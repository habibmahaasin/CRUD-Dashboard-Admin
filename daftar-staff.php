<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
	<title>Reloadd | Daftar Staff</title>
</head>
<body>

	<?php include("header.php"); ?>
	 <h1 class="mt-4" align="center"><b style="color: #03a33b">DAFTAR</b> STAFF</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1 " style="color: #03a33b"></i>
                                <b style="color: #03a33b" >DAFTAR STAFF</b>
                            </div>
                            <div class="card-body">
                                
                                <?php 
                                    if(isset($_GET["berhasil_edit"])){
                                        echo "<p style='color:#03a33b';><i>Informasi Staff Berhasil DiPerbaharui !</i></p>";
                                    }
                                ?>

                                <?php 
                                    if(isset($_GET["berhasil_delete"])){
                                        echo "<p style='color:#343a40';><i> Data Staff Berhasil DiHapus!</i></p>";
                                    }
                                ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                        <thead style="background-color:#03a33b; text-align: center;">
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama</th>
                                                <th>Role</th>
                                                <th>Waktu Terdaftar</th>
                                                <th>Ditambah Oleh</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($mysqli,"SELECT * FROM admin ORDER BY role ASC"); 
                                            $i=1;
                                              while($data = mysqli_fetch_array($result)) {
                                            ?>   
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $data["nama"];?></td>
                                                <td><?php echo $data["role"];?></td>
                                                <td><?php echo $data["tanggal_add"]; ?></td>
                                                <td><?php echo $data["ditambah_oleh"];?></td>
                                                
                                                <?php if ($role == 'CEO') { ?>
                                                <td align="center">
                                                    <a href='edit-staff.php?id_user=<?php echo $data['id_user']; ?>' class="edit"><button type="button" style="margin-bottom: 4px;"  class="btn btn-success btn-sm"> Edit</button></a>
                                                    <a onclick="return konfirmasi()" href='delete-staff.php?id_user=<?php echo $data['id_user']; ?>' class="remove"><button type="button" style="margin-bottom: 4px; background-color: #343a40;
                                                    color: white"  class="btn btn-sm">Delete</button></a></td>
												<?php } ?>

												<?php if ($role == 'Team Financial' || $role == 'Team Produksi' || $role == 'Team Marketing' || $role == 'Manajer' ) { ?>
                                                    <td><p align="center">Tidak Mempunyai Akses</p></td>
                                                <?php } ?>


                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <h6 align="left" style="margin-top: 15px"><a href='javascript:history.go(-1)' class="add" style="al"><button type="button" style="margin-bottom: 4px; background-color: #343a40; color: white"  class="btn"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back </button></a></h6> 
                                </div>
                            </div>
                        </div>
	<?php include("footer.php"); ?>

</body>
</html>