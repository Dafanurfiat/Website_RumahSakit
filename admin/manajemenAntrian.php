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
  <meta charset="UTF-8" />
  <title>Manajemen antrian</title>
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
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php" class="active">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen antrian</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen antrian</span>
      </div>

      <!-- Table -->
      <div class="tableFix">
        <table id="table">
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
          <?php foreach ($antrian as $antrian_row): ?>
            <tr>
              <td><?= $antrian_row["id_antrian"] ?></td>
              <td><?= $antrian_row["id_pasien"] ?></td>
              <td><?= $antrian_row["id_jadwal_dokter"] ?></td>
              <td><?= $antrian_row["tanggal"] ?></td>
              <td><?= $antrian_row["no_antrian"] ?></td>
              <td><?= $antrian_row["status"] ?></td>
              <td>
              <a href="../function/status.php?id_antrian=<?= $antrian_row["id_antrian"] ?>&status=diterima" class="edit">Diterima</a>
              <a href="../function/status.php?id_antrian=<?= $antrian_row["id_antrian"] ?>&status=ditolak" class="hapus">Tolak</a>
              <td>
                <a href="../function/hapus_antrian.php?id_antrian=<?= $antrian_row["id_antrian"] ?>" class="hapus">Hapus</a>
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
<!-- add modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Menambahkan data Jadwal dokter</h2>
    </div>

    <div class="modal-body">
      <form class="modal-form" action="../function/tambah_jadwal.php" method="POST" enctype="multipart/form-data">
        <input type="number" placeholder="ID jadwal dokter" name="id_antrian" required>
        <input type="number" placeholder="ID dokter" name="id_dokter" required>
        <input type="text" placeholder="hari" name="hari" required>
        <input type="text" placeholder="jam" name="jam">
        <input type="submit" value="simpan">
      </form>
    </div>

  </div>
</div>
<!-- add modal -->
<script src="../scripts/script.js"></script>

</html>
</span>


<!-- Adding dokter -->