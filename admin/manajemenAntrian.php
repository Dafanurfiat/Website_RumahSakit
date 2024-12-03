<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$antrian = query("SELECT * FROM antrian");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tana Luwu | Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css" />
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="dashboard.php" style="color: #c53f3f">
                    <h1>Tana Luwu</h1>
                </a>
                <a class="sidebar-brand brand-logo-mini" href="dashboard.php"><img src="../images/logo.png"
                        alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigasi</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="dashboard.php">
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenPoli.php">
                        <span class="menu-title">Manajemen Poli</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenDokter.php">
                        <span class="menu-title">Manajemen Dokter</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenJadwal.php">
                        <span class="menu-title">Manajemen Jadwal Dokter</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenBerita.php">
                        <span class="menu-title">Manajemen Berita</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenRekamMedis.php">
                        <span class="menu-title">Manajemen Rekam Medis</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenPasien.php">
                        <span class="menu-title">Manajemen Pasien</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="manajemenAntrian.php">
                        <span class="menu-title">Manajemen Antrian</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo-mini.svg"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                        <?php echo $_SESSION['username'] ?>
                                    </p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <a class="dropdown-item preview-item" href="../function/logout.php">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Antrian </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manajemen Antrian</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID antrian</th>
                                                    <th>ID pasien</th>
                                                    <th>ID Jadwal Dokter</th>
                                                    <th>Tanggal</th>
                                                    <th>Nomor antrian</th>
                                                    <th>Status</th>
                                                    <th>Tolak/Terima</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                </tr>
                                                <?php foreach ($antrian as $antrian_row): ?>
                                                <tr>
                                                    <td><?= $antrian_row["id_antrian"] ?></td>
                                                    <td><?= $antrian_row["id_pasien"] ?></td>
                                                    <td><?= $antrian_row["id_jadwal_dokter"] ?></td>
                                                    <td><?= $antrian_row["tanggal"] ?></td>
                                                    <td><?= $antrian_row["no_antrian"] ?></td>
                                                    <td><?= $antrian_row["status"] ?></td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-success btn-icon-text">
                                                            <a href="../function/status.php?id_antrian=<?= $antrian_row["id_antrian"] ?>&status=diterima"
                                                                class="edit">Diterima</a>
                                                        </button>
                                                        ||
                                                        <button type="button"
                                                            class="btn btn-outline-warning btn-icon-text">
                                                            <a href="../function/status.php?id_antrian=<?= $antrian_row["id_antrian"] ?>&status=ditolak"
                                                                class="hapus">Tolak</a>
                                                        </button>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-icon-text">
                                                            <a href="../function/hapus_antrian.php?id_antrian=<?= $antrian_row["id_antrian"] ?>"
                                                                class="hapus">Hapus</a>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="footer">
                        </footer>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>