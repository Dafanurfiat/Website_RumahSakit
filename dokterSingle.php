<?php 
include "function/function.php";

$id_dokter = isset($_GET['id_dokter']) ? intval($_GET['id_dokter']) : 0;

// Query untuk mengambil data dokter dan jadwal
$sql = "SELECT d.nama_dokter, d.no_wa, d.image, p.nama_poli, d.deskripsi, j.hari, j.jam 
        FROM dokter d 
        JOIN poli p ON d.id_poli = p.id_poli 
        JOIN jadwal_dokter j ON d.id_dokter = j.id_dokter 
        WHERE d.id_dokter = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_dokter);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Pisahkan data dokter dan jadwal
    $dokter = $result->fetch_assoc(); // Ambil data dokter (baris pertama)
    $result->data_seek(0); // Reset pointer hasil query
    $jadwal_list = $result->fetch_all(MYSQLI_ASSOC); // Ambil semua jadwal
} else {
    die("Dokter tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">

    <title>Novena- Health & Care Medical template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">

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
                        <span class="text-white">Detail Dokter</span>
                        <h1 class="text-capitalize mb-5 text-lg"><?= htmlspecialchars($dokter['nama_dokter']) ?></h1>

                        <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="landingPage.php" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Doctor Details</a></li>
          </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="first" class="section dokterSingle.php">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="doctor-img-block">
                        <img src="images/dokter/<?= htmlspecialchars($dokter['image']) ?>" alt=""
                            class="img-fluid w-100">

                        <div class="info-block mt-4">
                            <h4 class="mb-0"><?= htmlspecialchars($dokter['nama_dokter']) ?></h4>
                            <p><?= htmlspecialchars($dokter['nama_poli']) ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="doctor-details mt-4 mt-lg-0">
                        <h2 class="text-md">Tentang Dokter</h2>
                        <div class="divider my-4"></div>
                        <p style="text-align: justify;"><?= htmlspecialchars($dokter['deskripsi']) ?></p>

                        <a href="janji.php" class="btn btn-main-2 btn-round-full mt-3">Membuat Janji<i
                                class="icofont-simple-right ml-2  "></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section doctor-skills">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="sidebar-widget bg-light p-4 rounded shadow-sm">
                        <h5 class="mb-4 text-center font-weight-bold">Membuat Janji</h5>

                        <ul class="list-unstyled lh-35">
                            <?php foreach ($jadwal_list as $jadwal): ?>
                            <li class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                <span class="font-weight-bold"><?= htmlspecialchars($jadwal['hari']) ?></span>
                                <span class="text-muted"><?= htmlspecialchars($jadwal['jam']) ?></span>
                                <?php endforeach; ?>
                            </li>
                        </ul>


                        <div class="sidebar-contact-info mt-4 text-center">
                            <p class="mb-0">Need Urgent Help?</p>
                            <h3 class="text-primary font-weight-bold">
                                <?= htmlspecialchars(str_replace('+62', '0', $dokter['no_wa'])) ?></h3>
                            <a href="https://wa.me/<?= htmlspecialchars($dokter['no_wa']) ?>"
                                class="btn btn-main-2 btn-round-full mt-3">Call Now</a>
                        </div>
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