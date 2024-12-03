<?php
include 'function/function.php';

session_start();

if (!isset($_SESSION['id_pasien'])) {
	die("Anda harus login untuk membuat janji.");
}
$idPasien = $_SESSION['id_pasien'];
$jadwalQuery = "SELECT jd.id_jadwal_dokter, jd.hari, jd.jam, d.nama_dokter, d.id_dokter
                FROM jadwal_dokter jd 
                INNER JOIN dokter d ON jd.id_dokter = d.id_dokter";
$jadwalResult = $conn->query($jadwalQuery);

if (!$jadwalResult) {
	die("Error pada query jadwal dokter: " . $conn->error);
}

$jadwalDokter = [];
if ($jadwalResult->num_rows > 0) {
	while ($row = $jadwalResult->fetch_assoc()) {
		$jadwalDokter[$row['id_dokter']][] = $row;
	}
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['submit'])) {
		// Pastikan data form diterima
		if (!isset($_POST['id_jadwal_dokter']) || !isset($_POST['tanggal'])) {
			die('Data jadwal dokter atau tanggal belum diisi!');
		}

		// Sanitasi data input
		$idJadwalDokter = $conn->real_escape_string($_POST['id_jadwal_dokter']);
		$tanggal = $conn->real_escape_string($_POST['tanggal']);

		// Hitung nomor antrian
		$queryAntrian = "SELECT MAX(no_antrian) AS max_antrian 
                     FROM antrian 
                     WHERE id_jadwal_dokter = '$idJadwalDokter' AND tanggal = '$tanggal'";
		$resultAntrian = $conn->query($queryAntrian);
		if (!$resultAntrian) {
			die("Error pada query antrian: " . $conn->error);
		}

		$maxAntrian = $resultAntrian->fetch_assoc()['max_antrian'] ?? 0;
		$noAntrian = $maxAntrian + 1;

		// Simpan data janji
		$insertQuery = "INSERT INTO antrian (id_pasien, id_jadwal_dokter, tanggal, no_antrian) 
                    VALUES ('$idPasien', '$idJadwalDokter', '$tanggal', $noAntrian)";
		if ($conn->query($insertQuery)) {
			$message = "<div class='alert alert-success' role='alert'> Janji berhasil dibuat! Nomor antrian Anda: $noAntrian </div>";
		} else {
			$message = "<div class='alert alert-danger' role='alert'> Gagal membuat janji: " . $conn->error . "</div>";
		}
	}
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
                        <h1 class="text-capitalize mb-5 text-lg">Membuat Janji</h1>

                        <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="landingPage.php" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Book your Seat</a></li>
          </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="appoinment section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mt-3">
                        <div class="feature-icon mb-3">
                            <i class="icofont-support text-lg"></i>
                        </div>
                        <span class="h3">Panggilan untuk Layanan Darurat!</span>
                        <h2 class="text-color mt-3">+62 3432 3893</h2>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
                        <h2 class="mb-2 title-color">Buat Janji dengan Dokter</h2>
                        <?php if (isset($message)): ?>
                        <?= $message ?>
                        <?php endif; ?>
                        <form id="appoinment-form" class="appoinment-form" method="POST" action="janji.php">
                            <div class="row">
                                <!-- Pilihan Dokter -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="dokter-select" name="id_dokter"
                                            onchange="updateJadwal()">
                                            <option value="">Pilih Dokter</option>
                                            <?php
											$dokterQuery = "SELECT id_dokter, nama_dokter FROM dokter";
											$dokterResult = $conn->query($dokterQuery);
											while ($dokter = $dokterResult->fetch_assoc()) {
												echo "<option value='{$dokter['id_dokter']}'>{$dokter['nama_dokter']}</option>";
											}
											?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Pilihan Jadwal -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="jadwal-select" name="id_jadwal_dokter">
                                            <option value="">Pilih Jadwal Dokter</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Input Tanggal -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="tanggal" id="date" type="date" class="form-control"
                                            placeholder="dd/mm/yyyy">
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="col-lg-12">
                                    <button type="submit" name="submit" class="btn btn-main btn-round-full">Membuat
                                        Janji</button>
                                </div>
                            </div>
                        </form>

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
    <script>
    // Data jadwal dokter dalam format JSON (dari PHP)
    const jadwalDokter = <?= json_encode($jadwalDokter) ?>;

    // Update pilihan jadwal dokter berdasarkan dokter yang dipilih
    function updateJadwal() {
        const dokterSelect = document.getElementById('dokter-select');
        const jadwalSelect = document.getElementById('jadwal-select');
        const selectedDokter = dokterSelect.value;

        // Hapus semua opsi jadwal sebelumnya
        jadwalSelect.innerHTML = '<option value="">Pilih Jadwal Dokter</option>';

        // Jika ada dokter yang dipilih, tambahkan jadwalnya
        if (selectedDokter && jadwalDokter[selectedDokter]) {
            jadwalDokter[selectedDokter].forEach(jadwal => {
                const option = document.createElement('option');
                option.value = jadwal.id_jadwal_dokter;
                option.textContent = `${jadwal.hari}, ${jadwal.jam}`;
                jadwalSelect.appendChild(option);
            });
        }
    }
    </script>
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