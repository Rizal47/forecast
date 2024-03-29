<!DOCTYPE html>
<!--test-->
<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: index.php");
}
include("backend/koneksi.php");
include("backend/penjualan.php");
include("backend/backend_lihat.php");
include("connection/koneksi.php");
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Forecasting</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/arabic.css" rel="stylesheet" >
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="beranda.php">
                <div class="sidebar-brand-icon">
                    <img src="gambar/logo.png" width="30px" height="30px">
                </div>
                <div class="sidebar-brand-text mx-3">FORECASTING</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="beranda.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="crud_data.php">
                    <i class="fa fa-plus"></i>
                    <span>CRUD Data</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="prediksi_data.php">
                    <i class="fa fa-database"></i>
                    <span>Prediksi Data</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="kesalahan.php">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>Kesalahan Peramalan</span>
                </a>
            </li>
            <br>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                  
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Informasi User -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["nama"];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            
                            <!-- Dropdown User -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" id="custom-dropdown" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

            <!-- Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Kesalahan Peramalan</h1>
                </div>
                <section class="mar-top--x-2 mar-bottom--x-2">
                    <div class="card shadow mb-2 col-lg-6">
                        <div class="card-body">
                            <div class="responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form action="hitungkesalahan.php" method="post">
                                    <div class="form-group">
                                        <label>Data Asli</label>
                                        <input type="text" class="form-control" name="dataasli" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Peramalan</label>
                                        <input class="form-control" type="text" name="peramalan" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <br>
                <section class="mar-top--x-3 mar-bottom--x-5">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead align="center">
                                        <tr>
                                            <th>Id</th>
                                            <th>Data Asli</th>
                                            <th>Peramalan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                    <?php
                                        $select=mysqli_query($conn,'select * from kesalahan');
                                        $jumlah_data=0;
                                        $selisih=0;
                                        $MAPE = 0;
                                        while ($data = mysqli_fetch_array($select)) {
                                            echo "
                                                <tr>
                                                    <td>" . $data["id_kesalahan"] . "</td>
                                                    <td>" . $data["data_asli"] . "</td>
                                                    <td>" . $data["peramalan"] . "</td>
                                                    <td> <a href='delete.php?id=".$data["id_kesalahan"]."'> Hapus </a> </td>
                                                </tr>
                                                ";
                                            if ($jumlah_data>0) {
                                                $selisih += abs($data["peramalan"] - $data["data_asli"]);
                                                $MAPE += abs($data["peramalan"] - $data["data_asli"])/$data["data_asli"];
                                            }
                                            $jumlah_data+=1;
                                            
                                        }  

                                    ?>
                                    </tbody>
                                </table> 
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th width="15%"> MAD </th>
                                        <th width="85%"> <?=$selisih/$jumlah_data ?></th>
                                    </tr>
                                    <tr> 
                                        <th width="15%"> MSE </th>
                                        <th width="85%"> <?= pow($selisih,2)/$jumlah_data ?></th>
                                    </tr>
                                    <tr>
                                        <th width="15%"> MAPE </th>
                                        <th width="85%"> <?= $MAPE/$jumlah_data*100?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End of Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 1</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" jika ingin meninggalkan halaman.</div>
                <div class="modal-footer">
                    <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" type="button" data-dismiss="modal">Batal</button>
                    <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="logout.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>