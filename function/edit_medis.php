<?php 
include 'function.php';

// Ambil ID rekam medis dari URL
$id_rekam_medis = $_GET['id_rekam_medis'];

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pasien = $_POST['id_pasien'];
    $id_antrian = $_POST['id_antrian'];
    $diagnosa = $_POST['diagnosa'];
    $id_dokter = $_POST['id_dokter'];
    $tekanan_darah_tinggi = $_POST['tekanan_darah_tinggi'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $suhu_badan = $_POST['suhu_badan'];
    $obat = $_POST['obat'];

    // Update query
    $sql = "UPDATE rekam_medis 
            SET id_pasien = '$id_pasien', id_antrian = '$id_antrian', diagnosa = '$diagnosa', 
                id_dokter = '$id_dokter', tekanan_darah_tinggi = '$tekanan_darah_tinggi', 
                berat_badan = '$berat_badan', tinggi_badan = '$tinggi_badan', suhu_badan = '$suhu_badan', 
                obat = '$obat' 
            WHERE id_rekam_medis = '$id_rekam_medis'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/manajemenRekamMedis.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Ambil data rekam medis berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM rekam_medis WHERE id_rekam_medis = '$id_rekam_medis'");
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
    <title>Edit dokter</title>
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
        <h1>Edit dokter</h1>
        <form method="POST" enctype="multipart/form-data">
            <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
            ID Rekam Medis: <input type="number" name="id_rekam_medis" value="<?php echo $medis['id_rekam_medis']; ?>" required><br>
            ID Pasien: <input type="number" name="id_pasien" value="<?php echo $medis['id_pasien']; ?>" required><br>
            ID Antrian: <input type="number" name="id_antrian" value="<?php echo $medis['id_antrian']; ?>" required><br>
            Diagnosa: <input type="text" name="diagnosa" value="<?php echo $medis['diagnosa']; ?>" required><br>
            ID Dokter: <input type="number" name="id_dokter" value="<?php echo $medis['id_dokter']; ?>" required><br>
            Tekanan Darah Tinggi: <input type="number" name="tekanan_darah_tinggi" value="<?php echo $medis['tekanan_darah_tinggi']; ?>" required><br>
            Berat Badan: <input type="number" name="berat_badan" value="<?php echo $medis['berat_badan']; ?>" required><br>
            Tinggi Badan: <input type="number" name="tinggi_badan" value="<?php echo $medis['tinggi_badan']; ?>" required><br>
            Suhu Badan: <input type="number" name="suhu_badan" value="<?php echo $medis['suhu_badan']; ?>" required><br>
            Obat: <input type="text" name="obat" value="<?php echo $medis['obat']; ?>" required><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="../admin/manajemenRekamMedis.php">Kembali</a>
    </div>
</main>
</body>
</html>
    