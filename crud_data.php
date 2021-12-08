<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: index.php");
}
include("backend/koneksi.php");
include("backend/penjualan.php");
include("backend/backend_lihat.php");
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
            <li class="nav-item active">
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
            <li class="nav-item">
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
                    <h1 class="h3 mb-0 text-gray-800">CRUD Data</h1>
                </div>
                <section class="mar-top--x-2 mar-bottom--x-2">
                    <div class="card shadow mb-2 col-lg-6">
                        <div class="card-body">
                            <div class="responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <th id="judul" colspan="2"> Form Input/Edit Data </th>
                                    <input hidden type="number" name="id_jual" width="80%" value="<?php echo $penjualan->id_jual ?>" form="input">
                                    <tr width="100%">
                                        <td align="left"> Minggu </td>
                                        <td> <select id="dropdown" name="minggu" form="input" method="POST">
                                            <option value="1" <?php echo $minggu['1'] ?> > 1 </option>
                                            <option value="2" <?php echo $minggu['2'] ?> > 2 </option>
                                            <option value="3" <?php echo $minggu['3'] ?> > 3 </option>
                                            <option value="4" <?php echo $minggu['4'] ?> > 4 </option>
                                        </select> </td>
                                    </tr>
                                    <tr width="100%">
                                        <td align="left"> Bulan </td>
                                        <td> <select id="dropdown" name="bulan" form="input" method="POST">
                                            <option value="1" <?php echo $bulan['1'] ?>> Januari </option>
                                            <option value="2" <?php echo $bulan['2'] ?>> Februari </option>
                                            <option value="3" <?php echo $bulan['3'] ?>> Maret </option>
                                            <option value="4" <?php echo $bulan['4'] ?>> April </option>
                                            <option value="5" <?php echo $bulan['5'] ?>> Mei </option>
                                            <option value="6" <?php echo $bulan['6'] ?>> Juni </option>
                                            <option value="7" <?php echo $bulan['7'] ?>> Juli </option>
                                            <option value="8" <?php echo $bulan['8'] ?>> Agustus </option>
                                            <option value="9" <?php echo $bulan['9'] ?>> September </option>
                                            <option value="10" <?php echo $bulan['10'] ?>> Oktober </option>
                                            <option value="11" <?php echo $bulan['11'] ?>> November </option>
                                            <option value="12" <?php echo $bulan['12'] ?>> Desember </option>
                                        </select> </td>
                                    </tr>
                                    <tr width="100%">
                                        <form action="" method="POST" enctype="multipart/form-data" id="input">
                                        <td align="left"> Tahun </td> <td> <input type="year" name="tahun" width="80%" value="<?php echo $penjualan->tahun ?>" form="input"/> </td>
                                        </form>
                                    </tr>
                                    <tr width="100%">
                                        <form action="" method="POST" enctype="multipart/form-data" id="input">
                                        <td align="left"> Jumlah </td> <td> <input type="text" name="jumlah" width="80%" value="<?php echo $penjualan->jumlah ?>" form="input"/> </td>
                                        </form>
                                    </tr>
                                </table>
                                <form action="" method="POST" enctype="multipart/form-data" id="input" align="right">
                                    <input type="hidden" name="state" value="<?php echo isset($_GET['state']) ? $_GET['state'] : 'create' ?>" id="input" form="input">
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" type="submit" name="submit" id="submit" form="input"> Simpan </button>
                                </form> 
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
                                            <th>Id Jual</th>
                                            <th>Minggu</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $arrayData = Penjualan::readAllData();
                                        foreach ($arrayData as $data){
                                    ?>
                                    <tbody align="center">
                                        <tr>
                                            <td><aaa><?php echo $data->id_jual;?></aaa></td>
                                            <td><aaa><?php echo $data->minggu;?></aaa></td>
                                            <td><aaa><?php echo $data->bulan;?></aaa></td>
                                            <td><aaa><?php echo $data->tahun;?></aaa></td>
                                            <td><aaa><?php echo $data->jumlah;?></aaa></td>
                                            <td>
                                                <a href="crud_data.php?id_jual=<?php echo $data->id_jual; ?>&state=edit" id="actK">Edit</a> 
                                                &nbsp;
                                                <a href="crud_data.php?id_jual=<?php echo $data->id_jual; ?>&state=delete" id="actK">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
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