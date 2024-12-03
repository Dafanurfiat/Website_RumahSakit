<?php 
require '../function/function.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$berita = query("SELECT * FROM berita");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Berita</title>
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
        <a href="manajemenBerita.php" class="active">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen berita</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen berita</span>
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
            <th>ID berita</th>
            <th>Judul berita</th>
            <th>Isi berita</th>
            <th>Waktu Berita</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $berita as $berita_row ): ?>
        <tr>
            <td><?= $berita_row["id_berita"]; ?></td>
            <td><?= $berita_row["judul_berita"]; ?></td>
            <td><?= $berita_row["isi_berita"]; ?></td>
            <td><?= $berita_row["waktu_berita"]; ?></td>
            <td><img src="../images/berita/<?= $berita_row["gambar"]; ?>" alt=""></td>
            <td>
                <a href="../function/edit_berita.php?id_berita=<?= $berita_row["id_berita"] ?>" class="edit">Edit</a> || 
                <a href="../function/hapus_berita.php?id_berita=<?= $berita_row["id_berita"] ?>" class="hapus">Hapus</a>
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
            <h2>Menambahkan data berita</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="../function/tambah_berita.php" method="POST" enctype="multipart/form-data">
                <input type="number" placeholder="ID berita" name="berita_id" required>
                <input type="text" placeholder="Judul berita" name="judul_berita" required>
                <textarea placeholder="isi_berita" name="isi_berita" required></textarea>
                <input type="file" name="gambar" required>
                <input type="submit" value="simpan">
            </form>
        </div>
    
    </div>            
</div>
<!-- add modal -->
<script src="../scripts/script.js"></script>
</html>
</span>


<!-- Adding berita -->


