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
  <title>Manajemen poli</title>
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
        <a href="manajemenPoli.php" class="active">Manajemen Poli</a>
        <a href="manajemenDokter.php">Manajemen Dokter</a>
        <a href="manajemenJadwal.php">Manajemen Jadwal Dokter</a>
        <a href="manajemenBerita.php">Manajemen Berita</a>
        <a href="manajemenRekamMedis.php">Manajemen Rekam Medis</a>
        <a href="manajemenPasien.php">Manajemen Pasien</a>
        <a href="manajemenAntrian.php">Manajemen Antrian</a>
    </nav>


    <div class="main-body">
      <h2>Manajemen Poli</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Poli</span>
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
            <th>ID poli</th>
            <th>Nama poli</th>
            <th>Deskripsi poli</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $poli as $poli_row ): ?>
        <tr>
            <td><?= $poli_row["id_poli"]; ?></td>
            <td><?= $poli_row["nama_poli"]; ?></td>
            <td><?= $poli_row["deskripsi_poli"]; ?></td>
            <td><img src="../images/service/<?= $poli_row["image"]; ?>" alt=""></td>
            <td>
                <a href="../function/edit_poli.php?id_poli=<?= $poli_row["id_poli"] ?>" class="edit">Edit</a> || 
                <a href="../function/hapus_poli.php?id_poli=<?= $poli_row["id_poli"] ?>" class="hapus">Hapus</a>
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
            <h2>Menambahkan data poli</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="../function/tambah_poli.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="ID poli" name="poli_id" required>
                <input type="text" placeholder="Nama poli" name="nama_poli" required>
                <textarea placeholder="Deskripsi poli" name="deskripsi_poli" required></textarea>
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


<!-- Adding poli -->


