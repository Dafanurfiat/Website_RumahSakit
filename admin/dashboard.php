<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$poli = query("SELECT * FROM poli");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../styles/admin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="dashboard.php">Tana Luwu Medical Center</a>
    </div>

    <div class="header-icons">
      <div class="account">
        <details class="dropdown">
            <summary role="button">
              <i class="fas fa-user-alt"></i><a class="button"><?php echo $_SESSION['username'] ?></a>
            </summary>
                <ul>
                    <li><a href="../function/logout.php">Logout</a></li>
                </ul>
        </details>
      </div>
    </div>

  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="manajemenPoli.php">Manajemen Poli</a>
        <a href="manajemenDokter.php">Manajemen Dokter</a>
        <a href="manajemenJadwal.php">Manajemen Jadwal Dokter</a>
        <a href="manajemenBerita.php">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>

    <div class="main-body" style="margin-top: 3px;">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Tana Luwu Medical Center</span>
      </div>

      <h2 style="margin-top: 50px;"> Selamat datang di halaman admin </h2>

    </div>

  </div>
  
    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tana Luwu Medical Center</p>
    </footer>
</body>
</html>
</span>