<?php include_once("config.php"); ?>



<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Reloadd | Dashboard</title>
</head>
<body >
    <?php include("header.php"); ?>
                <div class="card mb-4">
                    <div class="container-fluid" align="center">  
                        <img src="images/reloadd-text.png"  class="img-fluid" alt="reloadd logo" width="400" style="margin-bottom: 25px; margin-top: 25px;">
                        <ol class="breadcrumb mb-4" style="margin-top: 10px;">
                            <li class="breadcrumb-item active">DASHBOARD</li>
                        </ol>  


                        <div class="row" align="center" style="margin-bottom: 20px;">
                            <div class="col-xl-3 col-sm-6 col-12"> 
                            <div class="card" style="background-color: #F5F7FA;">
                              <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                    <div class="media-body text-left">
                                    <?php
                                        $query = "SELECT kode_produk FROM penjualan ORDER BY kode_produk";
                                        $query_run = mysqli_query($mysqli,$query);
                                        $row = mysqli_num_rows($query_run);
                                    ?>
                                    <h1><b><?php echo $row; ?></b></h1>
                                      <span><b>PRODUCT UPOADED</b></span>
                                    
                                    </div>
                                    <div class="align-self-center">
                                    <img src="images/catalog.png" class="img-fluid" width="90px">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card" style="background-color: #F5F7FA;">
                                      <div class="card-content">
                                        <div class="card-body">
                                          <div class="media d-flex">
                                            <div class="media-body text-left">
                                               <?php
                                                    $query = "SELECT kode_artikel FROM artikel ORDER BY kode_artikel";
                                                    $query_run = mysqli_query($mysqli,$query);
                                                    $row = mysqli_num_rows($query_run);
                                                ?>

                                                <h1><b><?php echo $row; ?></b></h1>
                                              <span><b>TOTAL ART</b></span>
                                            </div>
                                            <div class="align-self-center">
                                            <img src="images/art.png" class="img-fluid" width="90px">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                          

                          

                          <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card" style="background-color: #F5F7FA;">
                              <div class="card-content">
                                <div class="card-body">
                                  <div class="media d-flex">
                                    <div class="media-body text-left">
                                      <?php
                                        $result = mysqli_query($mysqli,"SELECT * FROM penjualan");
                                        $total = 0;

                                        while ($row = $result->fetch_assoc()) 
                                        {
                                            $total += $row['kuantitas'];
                                        }
                                        ?>

                                        <h1><b><?php echo $total; ?></b></h1>
                                      <span><b>TOTAL STOCK</b></span>
                                    </div>
                                    <div class="align-self-center">
                                      <img src="images/stock.png" class="img-fluid" width="90px">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card" style="background-color: #F5F7FA;">
                                      <div class="card-content">
                                        <div class="card-body">
                                          <div class="media d-flex">
                                            <div class="media-body text-left">
                                              <?php
                                                    $query = "SELECT id_user FROM admin ORDER BY id_user";
                                                    $query_run = mysqli_query($mysqli,$query);
                                                    $row = mysqli_num_rows($query_run);
                                                ?>

                                                <h1><b><?php echo $row; ?></b></h1>
                                              <span><b>TOTAL STAFF</b></span>
                                            </div>
                                            <div class="align-self-center">
                                              <img src="images/staff.png" class="img-fluid" width="90px">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                        
                        </div>
                    </div>
                        <?php include("footer.php"); ?>



<style type="text/css">
    .col-xl-6 .card{
        background-color: #F5F7FA;
    }

    .card{
      margin-bottom: 20px;
    }
</style>

</body>
</html>