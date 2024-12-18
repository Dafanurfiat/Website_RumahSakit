<?php
include 'function/function.php';
session_start();

if (!isset($_SESSION['id_pasien'])) {
    header('Location: index.php');
    exit; // Jangan lanjutkan eksekusi setelah redirect
}
$idPasien = $_SESSION['id_pasien'];

// Query untuk mengambil data pasien (termasuk nama pasien)
$queryPasien = "SELECT nama_pasien FROM pasien WHERE id_pasien = '$idPasien'";
$resultPasien = mysqli_query($conn, $queryPasien);

// Cek jika query pasien berhasil
if (!$resultPasien) {
    die("Error pada query pasien: " . mysqli_error($conn));
}

// Ambil data nama pasien
$pasien = mysqli_fetch_assoc($resultPasien);
$namaPasien = $pasien['nama_pasien'];

$queryRekamMedis = "SELECT * FROM rekam_medis WHERE id_pasien = '$idPasien'";
$result = mysqli_query($conn, $queryRekamMedis);

if (!$result) {
    die("Error pada query: " . mysqli_error($conn));
}

$rekamMedis = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rekamMedis[] = $row;
}

$beritaResult = mysqli_query($conn, "SELECT * FROM berita");
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
    <meta name="author" content="themefisher.com">
    <link rel="icon" type="image/png" href="images/logo.png">
    <title>Tana Luwu Medical Center</title>

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

    <!-- Slider Start -->
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase text-sm letter-spacing ">Kesehatan Anda, Prioritas Kami di Jantung
                            Tana Luwu</span>
                        <h1 class="mb-3 mt-3">Halo <?php echo $namaPasien; ?>!</h1>

                        <p class="mb-4 pr-5">Solusi kesehatan terpercaya di jantung Tana Luwu, memadukan keahlian modern
                            dengan pelayanan penuh kepedulian.</p>
                        <div class="btn-container ">
                            <a href="janji.php" target="_blank" class="btn btn-main-2 btn-icon btn-round-full">Membuat
                                Janji<i class="icofont-simple-right ml-2  "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex">
                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-surgeon-alt"></i>
                            </div>
                            <span>Layanan 24 Jam</span>
                            <h4 class="mb-3">Penjadwalan Secara Online</h4>
                            <p class="mb-4">Dapatkan dukungan SETIAP saat untuk keadaan darurat. Kami telah
                                memperkenalkan prinsip kedokteran keluarga.</p>
                            <a href="janji.php" class="btn btn-main btn-round-full">Membuat Janji</a>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <span>Jadwal Waktu</span>
                            <h4 class="mb-3">Jam Kerja</h4>
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">Senin - Rabu : <span>8:00 - 17:00</span></li>
                                <li class="d-flex justify-content-between">Kamis - Juma'at : <span>9:00 - 17:00</span>
                                </li>
                                <li class="d-flex justify-content-between">Sabtu - Minggu : <span>10:00 - 17:00</span>
                                </li>
                            </ul>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-support"></i>
                            </div>
                            <span>Kasus Darurat</span>
                            <h4 class="mb-3">+62383342732343</h4>
                            <p>Dapatkan dukungan kapan saja untuk keadaan darurat. Kami menerapkan prinsip kedokteran
                                keluarga untuk memberikan layanan terbaik. Hubungi kami segera untuk setiap situasi
                                mendesak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img">
                        <img src="images/about/img-1.png" alt="" class="img-fluid">
                        <img src="images/about/img-2.png" alt="" class="img-fluid mt-4">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="about-img mt-4 mt-lg-0">
                        <img src="images/about/img-3.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content pl-4 mt-4 mt-lg-0">
                        <h2 class="title-color">Perawatan Pribadi <br>& Hidup Sehat</h2>
                        <p class="mt-4 mb-5">Kami menyediakan layanan medis terbaik dan terpercaya. Komitmen kami adalah
                            memberikan pelayanan berkualitas yang mengutamakan kenyamanan dan kesehatan Anda.</p>

                        <a href="poli.php" class="btn btn-main-2 btn-round-full btn-icon">Poli<i
                                class="icofont-simple-right ml-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section ">
        <div class="container">
            <div class="cta position-relative">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-doctor"></i>
                            <span class="h3">75</span>k
                            <p>Orang yang Bahagia</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-flag"></i>
                            <span class="h3">460</span>+
                            <p>Operasi Selesai</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-badge"></i>
                            <span class="h3">3</span>+
                            <p>Dokter Ahli</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-globe"></i>
                            <span class="h3">2</span>
                            <p>Cabang Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section service gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Perawatan Pasien yang Terbaik dan Terpercaya</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Kami berkomitmen untuk memberikan perawatan pasien yang terbaik, dengan layanan yang telah
                            diakui secara nasional. Kami mendengarkan kebutuhan Anda dan memberikan solusi kesehatan
                            yang terbaik.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-item mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-laboratory text-lg"></i>
                            <h4 class="mt-3 mb-3">Layanan Laboratorium Unggul</h4>
                        </div>

                        <div class="content">
                            <p class="mb-4">Laboratorium kami menyediakan layanan diagnostik yang akurat dan cepat
                                dengan teknologi canggih serta tenaga medis yang berpengalaman.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-item mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-heart-beat-alt text-lg"></i>
                            <h4 class="mt-3 mb-3">Penanganan Penyakit Jantung</h4>
                        </div>
                        <div class="content">
                            <p class="mb-4">Kami memiliki tim spesialis jantung yang berkompeten dalam menangani
                                berbagai kondisi jantung dengan perawatan yang terintegrasi dan teknologi terbaru.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-item mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-tooth text-lg"></i>
                            <h4 class="mt-3 mb-3">Bedah Umum yang Aman dan Terpercaya</h4>
                        </div>
                        <div class="content">
                            <p class="mb-4">Tim bedah kami siap memberikan pelayanan bedah tubuh dengan prosedur yang
                                aman dan efektif, dengan pendekatan pasien yang berfokus pada pemulihan optimal.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-item mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-crutch text-lg"></i>
                            <h4 class="mt-3 mb-3">Pembedahan Saraf yang Terdepan</h4>
                        </div>

                        <div class="content">
                            <p class="mb-4">Kami menyediakan layanan bedah saraf dengan teknologi mutakhir dan tenaga
                                medis yang ahli, untuk memastikan hasil terbaik bagi kondisi neurologis Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-item mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-dna-alt-1 text-lg"></i>
                            <h4 class="mt-3 mb-3">Perawatan Ginekologi yang Menyeluruh</h4>
                        </div>
                        <div class="content">
                            <p class="mb-4">Layanan ginekologi kami memberikan perawatan kesehatan wanita dari
                                pemeriksaan rutin hingga penanganan kondisi spesifik dengan pendekatan personal dan
                                profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="rekam-medis" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Rekam Medis Pasien</h2>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID Rekam Medis</th>
                            <th scope="col">Diagnosa</th>
                            <th scope="col">ID dokter</th>
                            <th scope="col">Tekanan Darah Tinggi</th>
                            <th scope="col">Berat Badan (kg)</th>
                            <th scope="col">Tinggi Badan (cm)</th>
                            <th scope="col">Suhu Badan (°C)</th>
                            <th scope="col">Obat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rekamMedis as $medis_row): ?>
                        <tr>
                            <td><?= htmlspecialchars($medis_row["id_rekam_medis"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["diagnosa"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["id_dokter"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["tekanan_darah_tinggi"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["berat_badan"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["tinggi_badan"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["suhu_badan"]); ?></td>
                            <td><?= htmlspecialchars($medis_row["obat"]); ?></td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

    <section class="section testimonial-2 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>Kami Telah Melayani Lebih Dari 2000+ Pasien</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Kami bangga telah memberikan pelayanan kesehatan terbaik kepada lebih dari 5000 pasien,
                            dengan pendekatan yang berfokus pada kebutuhan dan kenyamanan Anda. Kepercayaan Anda adalah
                            prioritas utama kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="section-title">
                        <h2 class="mb-4">Apa Kata Mereka Tentang Kami</h2>
                        <div class="divider my-4"></div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 testimonial-wrap offset-lg-6">
                    <?php
                    // Query untuk mengambil berita dari database
                    $beritaResult = mysqli_query($conn, "SELECT * FROM berita");

                    // Menampilkan setiap berita dalam sebuah blok testimonial
                    while ($berita = mysqli_fetch_assoc($beritaResult)) :
                    ?>
                    <div class="testimonial-block">
                        <div class="client-info">
                            <h4><?php echo htmlspecialchars($berita['judul_berita']); ?></h4>
                            <span><?php echo htmlspecialchars($berita['waktu_berita']); ?></span>
                        </div>
                        <p>
                            <?php echo htmlspecialchars(substr($berita['isi_berita'], 0, 150)) . '...'; ?>
                        </p>
                    </div>
                    <?php endwhile; ?>
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