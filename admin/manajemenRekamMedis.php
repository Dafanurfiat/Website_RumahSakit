<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$medis = query("SELECT * FROM rekam_medis");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Rekam Medis</title>
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
        <a href="manajemenRekamMedis.php" class="active">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen Rekam Medis</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Rekam Medis</span>
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
            <th>ID rekam medis</th>
            <th>ID pasien</th>
            <th>ID antrian</th>
            <th>diagnosa</th>
            <th>ID dokter</th>
            <th>Tekanan darah tinggi</th>
            <th>Berat badan</th>
            <th>Tinggi badan</th>
            <th>Suhu badan</th>
            <th>Obat</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $medis as $medis_row ): ?>
        <tr>
            <td><?= $medis_row["id_rekam_medis"]; ?></td>
            <td><?= $medis_row["id_pasien"]; ?></td>
            <td><?= $medis_row["id_antrian"]; ?></td>
            <td><?= $medis_row["diagnosa"]; ?></td>
            <td><?= $medis_row["id_dokter"]; ?></td>
            <td><?= $medis_row["tekanan_darah_tinggi"]; ?></td>
            <td><?= $medis_row["berat_badan"]; ?></td>
            <td><?= $medis_row["tinggi_badan"]; ?></td>
            <td><?= $medis_row["suhu_badan"]; ?></td>
            <td><?= $medis_row["obat"]; ?></td>
            <td>
                <a href="../function/edit_medis.php?id_rekam_medis=<?= $medis_row["id_rekam_medis"] ?>" class="edit">Edit</a> || 
                <a href="../function/hapus_medis.php?id_rekam_medis=<?= $medis_row["id_rekam_medis"] ?>" class="hapus">Hapus</a>
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
            <h2>Menambahkan data rekam medis</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form-dokter" action="../function/tambah_medis.php" method="POST" enctype="multipart/form-data">
                <input type="number" placeholder="ID rekam medis" name="id_rekam_medis" required>
                <input type="number" placeholder="ID pasien" name="id_pasien" required>
                <input type="number" placeholder="ID antrian" name="id_antrian" required>
                <input type="text" placeholder="Diagnosa" name="diagnosa" required>
                <input type="number" placeholder="ID dokter" name="id_dokter" required>
                <input type="number" placeholder="Tekanan darah tinggi" name="tekanan_darah_tinggi" required>
                <input type="number" placeholder="Berat badan" name="berat_badan" required>
                <input type="number" placeholder="Tinggi badan" name="tinggi_badan" required>
                <input type="number" placeholder="Suhu badan" name="suhu_badan" required>
                <input type="text" placeholder="Obat" name="obat" required>
                <input type="submit" value="simpan">
            </form>
        </div>
    
    </div>            
</div>
<!-- add modal -->
<script src="../scripts/script.js"></script>
</html>
</span>


<!-- Adding poli -->


