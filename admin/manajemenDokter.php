<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$dokter = query("SELECT * FROM dokter");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen dokter</title>
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
        <a href="manajemenDokter.php" class="active">Manajemen Dokter</a>
        <a href="manajemenJadwal.php">Manajemen Jadwal Dokter</a>
        <a href="manajemenBerita.php">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen Dokter</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Dokter</span>
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
            <th>ID dokter</th>
            <th>ID poli</th>
            <th>Nama dokter</th>
            <th>Nomor</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $dokter as $dokter_row ): ?>
        <tr>
            <td><?= $dokter_row["id_dokter"]; ?></td>
            <td><?= $dokter_row["id_poli"]; ?></td>
            <td><?= $dokter_row["nama_dokter"]; ?></td>
            <td><?= $dokter_row["no_wa"]; ?></td>
            <td><img src="../images/dokter/<?= $dokter_row["image"]; ?>" alt=""></td>
            <td><?= $dokter_row["deskripsi"]; ?></td>
            <td>
                <a href="../function/edit_dokter.php?id_dokter=<?= $dokter_row["id_dokter"] ?>" class="edit">Edit</a> || 
                <a href="../function/hapus_dokter.php?id_dokter=<?= $dokter_row["id_dokter"] ?>" class="hapus">Hapus</a>
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
            <h2>Menambahkan data dokter</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form-dokter" action="../function/tambah_dokter.php" method="POST" enctype="multipart/form-data">
                <input type="number" placeholder="ID dokter" name="id_dokter" required>
                <input type="number" placeholder="ID poli" name="id_poli" required>
                <input type="text" placeholder="Nama dokter" name="nama_dokter" required>
                <input type="number" placeholder="Nomor" name="no_wa" required>
                <textarea placeholder="Deskripsi" name="deskripsi" required></textarea>
                <input type="file" name="image" required>
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


