<?php 
include 'function.php';

// Ambil ID jadwal dokter dari URL
$id_jadwal_dokter = $_GET['id_jadwal_dokter'];

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal_dokter = $_POST['id_jadwal_dokter'];
    $id_dokter = $_POST['id_dokter'];
    $hari = htmlspecialchars($_POST['hari']);
    $jam = htmlspecialchars($_POST['jam']);

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

// Ambil data jadwal dokter berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM jadwal_dokter WHERE id_jadwal_dokter = '$id_jadwal_dokter'");
$medis = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, tampilkan pesan error
if (!$medis) {
    echo "Data tidak ditemukan!";
    exit;
}

// Ambil data dokter untuk dropdown
$queryDokter = "SELECT id_dokter, nama_dokter FROM dokter";
$resultDokter = mysqli_query($conn, $queryDokter);
$dokterList = [];
while ($dokter = mysqli_fetch_assoc($resultDokter)) {
    $dokterList[] = $dokter;
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
            <form method="POST">
        <!-- Pesan Error -->
        <?php if (isset($err)): ?>
            <p class="error"><?php echo $err; ?></p>
        <?php endif; ?>

        <!-- Input ID Jadwal Dokter -->
        <label for="id_jadwal_dokter">ID Jadwal Dokter:</label>
        <input type="number" id="id_jadwal_dokter" name="id_jadwal_dokter" value="<?php echo $medis['id_jadwal_dokter']; ?>" readonly><br>

        <!-- Dropdown ID Dokter -->
        <label for="id_dokter">Dokter:</label>
        <select id="id_dokter" name="id_dokter" required>
            <option value="">Pilih Dokter</option>
            <?php foreach ($dokterList as $dokter): ?>
                <option value="<?php echo $dokter['id_dokter']; ?>" 
                    <?php if ($dokter['id_dokter'] == $medis['id_dokter']) echo 'selected'; ?>>
                    <?php echo $dokter['nama_dokter']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <!-- Input Hari -->
        <label for="hari">Hari:</label>
        <input type="text" id="hari" name="hari" value="<?php echo $medis['hari']; ?>" required><br>

        <!-- Input Jam -->
        <label for="jam">Jam:</label>
        <input type="text" id="jam" name="jam" value="<?php echo $medis['jam']; ?>" required><br>

        <!-- Tombol Simpan -->
        <button type="submit">Simpan</button>
    </form>
            <a href="../admin/manajemenJadwal.php">Kembali</a>
        </div>
    </main>
</body>

</html>