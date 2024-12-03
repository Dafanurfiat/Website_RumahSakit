<?php
include 'function.php';

$id_poli = $_GET['id_poli'];

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM poli WHERE id_poli = '$id_poli'");
$poli = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id_poli = $_POST['new_id_poli'];
    $nama_poli = $_POST['nama_poli'];
    $deskripsi_poli = $_POST['deskripsi_poli'];

    // File upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $targetDir = "../images/";
        $targetFile = $targetDir . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validasi tipe file
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $validExtensions)) {
            move_uploaded_file($imageTmp, $targetFile);
        } else {
            echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
            exit;
        }
    } else {
        $image = $poli['image']; // Jika tidak ada gambar baru, gunakan gambar lama
    }

    // Check if the new id_poli already exists
    $check_sql = "SELECT * FROM poli WHERE id_poli = '$new_id_poli' AND id_poli != '$id_poli'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $err = "ID Poli telah tersedia, gunakan yang lain!";
    } else {
        // Update query
        $sql = "UPDATE poli SET 
                    id_poli = '$new_id_poli', 
                    nama_poli = '$nama_poli', 
                    deskripsi_poli = '$deskripsi_poli', 
                    image = '$image' 
                WHERE id_poli = '$id_poli'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemenPoli.php");
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
    <title>Edit Poli</title>
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
        <h1>Edit Poli</h1>
        <form method="POST" enctype="multipart/form-data">
            <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
            ID Poli: <input type="number" name="new_id_poli" value="<?php echo $poli['id_poli']; ?>" required><br>
            Nama Poli: <input type="text" name="nama_poli" value="<?php echo $poli['nama_poli']; ?>" required><br>
            Deskripsi Poli: <textarea name="deskripsi_poli" required><?php echo $poli['deskripsi_poli']; ?></textarea><br>
            Gambar: <input type="file" name="image"><br>
            <img src="../images/service/<?php echo $poli['image']; ?>" alt="Current Image" width="100"><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="../admin/manajemenPoli.php">Kembali</a>
    </div>
</main>
</body>
</html>
    