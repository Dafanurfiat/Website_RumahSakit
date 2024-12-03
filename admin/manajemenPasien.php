<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$pasien = query("SELECT * FROM pasien");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen pasien</title>
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
        <a href="dashboard.php">Dashboard</a>
        <a href="manajemenPoli.php">Manajemen Poli</a>
        <a href="manajemenDokter.php">Manajemen Dokter</a>
        <a href="manajemenJadwal.php">Manajemen Jadwal Dokter</a>
        <a href="manajemenBerita.php">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php" class="active">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen Pasien</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Pasien</span>
      </div>

<!-- Table -->
<div class="tableFix">
    <table id="table">
        <tr>
            <th>ID pasien</th>
            <th>Nama pasien</th>
            <th>Nomor KTP</th>
            <th>Username</th>
            <th>Tanggal lahir</th>
            <th>Nama wali</th>
            <th>Nomor kontak pasien</th>
            <th>Nomor kontak wali</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $pasien as $pasien_row ): ?>
        <tr>
            <td><?= $pasien_row["id_pasien"]; ?></td>
            <td><?= $pasien_row["nama_pasien"]; ?></td>
            <td><?= $pasien_row["no_ktp"]; ?></td>
            <td><?= $pasien_row["username"]; ?></td>
            <td><?= $pasien_row["tgl_lahir"]; ?></td>
            <td><?= $pasien_row["nama_wali"]; ?></td>
            <td><?= $pasien_row["no_kontak_pasien"]; ?></td>
            <td><?= $pasien_row["no_kontak_wali"]; ?></td>
            <td> 
                <a href="../function/hapus_pasien.php?id_pasien=<?= $pasien_row["id_pasien"] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <!-- Table -->

  </div>
  
    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tana Luwu Medical Center</p>
    </footer>
</body>
<script src="../scripts/script.js"></script>
</html>
</span>


<!-- Adding poli -->


