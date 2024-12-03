<?php
include 'function.php';

$id_berita = $_GET['id_berita'];

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita = '$id_berita'");
$Berita = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id_berita = $_POST['new_id_berita'];
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];
    $waktu_berita = $_POST['waktu_berita'];

    // File upload handling
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar']['name'];
        $gambarTmp = $_FILES['gambar']['tmp_name'];
        $targetDir = "../images/berita/";
        $targetFile = $targetDir . basename($gambar);
        $gambarFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi tipe file
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($gambarFileType, $validExtensions)) {
            move_uploaded_file($gambarTmp, $targetFile);
        } else {
            echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
            exit;
        }
    } else {
        $gambar = $Berita['gambar']; // Jika tidak ada gambar baru, gunakan gambar lama
    }

    // Check if the new id_berita already exists
    $check_sql = "SELECT * FROM Berita WHERE id_berita = '$new_id_berita' AND id_berita != '$id_berita'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $err = "ID Berita telah tersedia, gunakan yang lain!";
    } else {
        // Update query
        $sql = "UPDATE Berita SET 
                    id_berita = '$new_id_berita', 
                    judul_berita = '$judul_berita', 
                    isi_berita = '$isi_berita', 
                    waktu_berita = '$waktu_berita',
                    gambar = '$gambar' 
                WHERE id_berita = '$id_berita'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemenBerita.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
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
        <h1>Edit Berita</h1>
        <form method="POST" enctype="multipart/form-data">
            <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
            ID Berita: <input type="number" name="new_id_berita" value="<?php echo $Berita['id_berita']; ?>" required><br>
            Nama Berita: <input type="text" name="judul_berita" value="<?php echo $Berita['judul_berita']; ?>" required><br>
            Isi Berita: <textarea name="isi_berita" required><?php echo $Berita['isi_berita']; ?></textarea><br>
            Waktu Berita: <input type="datetime-local" name="waktu_berita" value="<?php echo date('Y-m-d\TH:i', strtotime($Berita['waktu_berita'])); ?>" required><br>
            Gambar: <input type="file" name="gambar"><br>
            <img src="../images/berita/<?php echo $Berita['gambar']; ?>" alt="Current gambar" width="100"><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="../admin/manajemenBerita.php">Kembali</a>
    </div>
</main>
</body>
</html>
    