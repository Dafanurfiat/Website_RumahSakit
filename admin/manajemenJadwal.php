<?php
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$jadwal = query("SELECT * FROM jadwal_dokter");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Manajemen jadwal dokter</title>
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
        <a href="manajemenJadwal.php" class="active">Manajemen Jadwal Dokter</a>
        <a href="manajemenBerita.php">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen jadwal Dokter</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen jadwal Dokter</span>
      </div>

      <div class="add">
        <button class="add-button" id="myBtn">
          Tambah Data
        </button>
      </div>

      <!-- Table -->
      <div class="tableFix">
        <table id="table">
          <tr>
            <th>ID jadwal dokter</th>
            <th>ID dokter</th>
            <th>hari</th>
            <th>jam</th>
            <th>Aksi</th>
          </tr>
          <?php foreach ($jadwal as $jadwal_row): ?>
            <tr>
              <td><?= $jadwal_row["id_jadwal_dokter"] ?></td>
              <td><?= $jadwal_row["id_dokter"] ?></td>
              <td><?= $jadwal_row["hari"] ?></td>
              <td><?= $jadwal_row["jam"] ?></td>
              <td>
                <a href="../function/edit_jadwal.php?id_jadwal_dokter=<?= $jadwal_row["id_jadwal_dokter"] ?>" class="edit">Edit</a> ||
                <a href="../function/hapus_jadwal.php?id_jadwal_dokter=<?= $jadwal_row["id_jadwal_dokter"] ?>" class="hapus">Hapus</a>
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
        <input type="number" placeholder="ID jadwal dokter" name="id_jadwal_dokter" required>
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