<?php include_once("config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Reloadd | Daftar Type</title>
</head>
<body>
                        <?php include("header.php"); ?>
                        <h1 class="mt-4" align="center"><b style="color: #03a33b">DAFTAR</b> TYPE</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1 " style="color: #03a33b"></i>
                                <b style="color: #03a33b" >TYPE ARTIKEL</b>
                            </div>
                            <div class="card-body">
                                <?php 
                                    if(isset($_GET["berhasil_edit"])){
                                        echo "<p style='color:#03a33b';><i>Informasi Type Berhasil DiPerbaharui !</i></p>";
                                    }
                                ?>

                                <?php 
                                    if(isset($_GET["berhasil_delete"])){
                                        echo "<p style='color:#343a40';><i>Data Type Berhasil DiHapus!</i></p>";
                                    }
                                ?>

                                <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi'  ) { ?>
                                <h6 align="right"><a href='tambah-type.php' class="add" style="al"><button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add New Product</button></a></h6>

                                <?php } ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                        <thead style="background-color:#03a33b; text-align: center;">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Terakhir di Ubah</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($mysqli,"SELECT * FROM type ORDER BY kode_type ASC");
                                              while($data = mysqli_fetch_array($result)) {
                                            ?>   
                                            <tr>
                                                <td><?php echo $data["kode_type"]; ?></td>
                                                <td><?php echo $data["nama_type"]; ?></td>
                                                <td><?php echo $data["tanggal"]; ?></td>
                                                
                                                <?php if ($role == 'CEO' || $role == 'Manajer' || $role == 'Team Produksi' || $role == 'Team Marketing') { ?>
                                                <td align="center">
                                                    <a href='edit-type.php?kode_type=<?php echo $data['kode_type']; ?>' class="edit"><button type="button" style="margin-bottom: 4px;"  class="btn btn-success btn-sm"> Edit</button></a>

                                                    <a class="button" onclick="return konfirmasi()" href='delete-type.php?kode_type=<?php echo $data['kode_type']; ?>'><button type="button" style="margin-bottom: 4px; background-color: #343a40;
                                                    color: white"  class="btn btn-sm"> Delete</button></a></td>

                                                <?php } ?>

                                                <?php if ($role == 'Team Financial') { ?>
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