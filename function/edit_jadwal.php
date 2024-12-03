<?php 
include 'function.php';

// Ambil ID rekam medis dari URL
$id_jadwal_dokter = $_GET['id_jadwal_dokter'];

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal_dokter = $_POST['id_jadwal_dokter'];
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    // Update query
    $sql = "UPDATE jadwal_dokter 
            SET id_jadwal_dokter = '$id_jadwal_dokter', id_dokter = '$id_dokter', hari = '$hari', jam = '$jam'
            WHERE id_jadwal_dokter = '$id_jadwal_dokter'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/manajemenJadwal.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Ambil data rekam medis berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM jadwal_dokter WHERE id_jadwal_dokter = '$id_jadwal_dokter'");
$medis = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, tampilkan pesan error
if (!$medis) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal dokter</title>
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
<main>
<section class="wrapper">
    <div class="box">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</section>
    <div class="edit-form">
        <h1>Edit Jadwal dokter</h1>
        <form method="POST" enctype="multipart/form-data">
            <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
            ID Jadwal dokter: <input type="number" name="id_jadwal_dokter" value="<?php echo $medis['id_jadwal_dokter']; ?>" required><br>
            ID dokter: <input type="number" name="id_dokter" value="<?php echo $medis['id_dokter']; ?>" required><br>
            Hari: <input type="text" name="hari" value="<?php echo $medis['hari']; ?>" required><br>
            Jam: <input type="text" name="jam" value="<?php echo $medis['jam']; ?>" required><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="../admin/manajemenJadwal.php">Kembali</a>
    </div>
</main>
</body>
</html>
    