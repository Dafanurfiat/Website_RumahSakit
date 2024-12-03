<?php
include 'function.php';

$id_dokter = $_GET['id_dokter'];

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM dokter WHERE id_dokter = '$id_dokter'");
$dokter = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id_dokter = $_POST['new_id_dokter'];
    $new_id_poli = $_POST['new_id_poli'];
    $nama_dokter = $_POST['nama_dokter'];
    $deskripsi = $_POST['deskripsi'];

    // File upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $targetDir = "../images/dokter/";
        $targetFile = $targetDir . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi tipe file
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $validExtensions)) {
            move_uploaded_file($imageTmp, $targetFile);
        } else {
            echo "Hanya image dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
            exit;
        }
    } else {
        $image = $dokter['image']; // Jika tidak ada image baru, gunakan image lama
    }

    // Check if the new id_dokter already exists
    $check_sql = "SELECT * FROM dokter WHERE id_dokter = '$new_id_dokter' AND id_dokter != '$id_dokter'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $err = "ID dokter telah tersedia, gunakan yang lain!";
    } else {
        // Update query
        $sql = "UPDATE dokter SET 
                    id_dokter = '$new_id_dokter', 
                    id_poli = '$new_id_poli',
                    nama_dokter = '$nama_dokter', 
                    deskripsi = '$deskripsi', 
                    image = '$image' 
                WHERE id_dokter = '$id_dokter'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemenDokter.php");
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
            ID dokter: <input type="number" name="new_id_dokter" value="<?php echo $dokter['id_dokter']; ?>" required><br>
            ID poli: <input type="number" name="new_id_poli" value="<?php echo $dokter['id_poli']; ?>" required><br>
            Nama dokter: <input type="text" name="nama_dokter" value="<?php echo $dokter['nama_dokter']; ?>" required><br>
            deskripsi: <textarea name="deskripsi" required><?php echo $dokter['deskripsi']; ?></textarea><br>
            image: <input type="file" name="image"><br>
            <img src="../images/dokter/<?php echo $dokter['image']; ?>" alt="Current image" width="100"><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="../admin/manajemenDokter.php">Kembali</a>
    </div>
</main>
</body>
</html>
    