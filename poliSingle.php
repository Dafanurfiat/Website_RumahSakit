<?php 
include "function/function.php";
session_start();

$idPoli = isset($_GET['id_poli']) ? $_GET['id_poli'] : null;

if ($idPoli) {
    // Persiapkan query untuk mengambil data poli berdasarkan id_poli
    $query = "SELECT * FROM poli WHERE id_poli = ?";
    
    // Gunakan prepared statement untuk menghindari SQL injection
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $idPoli);  // "i" berarti parameter integer
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Ambil data poli
            $poli = $result->fetch_assoc();
        } else {
            echo "Poli tidak ditemukan!";
        }

        $stmt->close();
    } else {
        echo "Error pada query: " . $conn->error;
    }
} else {
    echo "ID Poli tidak ditemukan!";
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software" />
    <meta name="author" content="themefisher.com" />

    <title>Tana Luwu Medical Center</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css" />
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css" />
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css" />

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body id="top">
    <header>
        <div class="header-top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="top-bar-info list-inline-item pl-0 mb-0">
                            <li class="list-inline-item"><a href="mailto:support@gmail.com"><i
                                        class="icofont-support-faq mr-2"></i>Tanaluwumedical@gmail.com</a></li>
                            <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>Jalan.Paal-2 nomor 45
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                            <a href="tel:+23-345-67890">
                                <span>Panggil Sekarang: </span>
                                <span class="h4">08958029292929</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="landingPage.php">
                    <img src="images/logo.png" alt="" class="img-fluid">
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="landingPage.php">Beranda</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>

                        <li class="nav-item"><a class="nav-link" href="poli.php">Poli</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="dokter.php" id="dropdown03" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Dokter <i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                <li><a class="dropdown-item" href="dokter.php">Dokter</a></li>
                                <li><a class="dropdown-item" href="janji.php">Membuat Janji</a></li>
                            </ul>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="blog-sidebar.php">Berita</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link" href="function\logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <span class="text-white">Tana Luwu Medical Center</span>
                        <h1 class="text-capitalize mb-5 text-lg">Detail Poli</h1>

                        <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="landingPage.php" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Department Details</a></li>
          </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section poliSingle.php">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-img">
                        <img src="images/service/<?= htmlspecialchars($poli['image']) ?>" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="department-content mt-5">
                        <h3 class="text-md"><?= htmlspecialchars($poli['nama_poli']) ?></h3>
                        <div class="divider my-4"></div>
                        <p class="lead">
                            <?= htmlspecialchars($poli['deskripsi_poli']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer Start -->
    <footer class="footer section gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mr-auto col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <div class="logo mb-4">
                            <img src="images/logo.png" alt="" class="img-fluid">
                        </div>
                        <p>
                            Tana Luwu Medical Center di Liwas, Manado, Sulawesi Utara, menyediakan layanan kesehatan
                            berkualitas dengan fasilitas modern dan tenaga medis profesional, berfokus pada kenyamanan
                            dan keselamatan pasien.</p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">Poli</h4>
                        <div class="divider mb-4"></div>

                        <ul class="list-unstyled footer-menu lh-35">
                            <li><a href="poli.php">Penyakit Dalam </a></li>
                            <li><a href="poli.php">Kandungan dan anak</a></li>
                            <li><a href="poli.php">Umum</a></li>
                            <li><a href="poli.php">THT</a></li>
                            <li><a href="poli.php">Gigi</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget-contact mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">Hubungi Kami</h4>
                        <div class="divider mb-4"></div>

                        <div class="footer-contact-block mb-4">
                            <div class="icon d-flex align-items-center">
                                <i class="icofont-email mr-3"></i>
                                <span class="h6 mb-0">Dukungan Tersedia 24/7</span>
                            </div>
                            <h4 class="mt-2"><a href="tel:+6208958029292929">Tanaluwumedical@gmail.com</a></h4>
                        </div>

                        <div class="footer-contact-block">
                            <div class="icon d-flex align-items-center">
                                <i class="icofont-support mr-3"></i>
                                <span class="h6 mb-0">Senin sampai Juma'at : 08:30 - 18:00</span>
                            </div>
                            <h4 class="mt-2"><a href="tel:+6208958029292929">+6208958029292929</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-btm py-4 mt-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="copyright">
                            &copy; Copyright Reserved to <span class="text-color">Tana Luwu Medical Center</span></a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <a class="backtop js-scroll-trigger" href="#top">
                            <i class="icofont-long-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- 
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="plugins/jquery/jquery.js"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="plugins/bootstrap/js/popper.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/counterup/jquery.easing.js"></script>
    <!-- Slick Slider -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <!-- Counterup -->
    <script src="plugins/counterup/jquery.waypoints.min.js"></script>

    <script src="plugins/shuffle/shuffle.min.js"></script>
    <script src="plugins/counterup/jquery.counterup.min.js"></script>
    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap">
    </script>

    <script src="js/script.js"></script>
    <script src="js/contact.js"></script>
</body>

</html>