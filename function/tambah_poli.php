<?php
include 'function.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_poli = $_POST['nama_poli'];
    $deskripsi_poli = $_POST['deskripsi_poli'];

    // Proses file gambar
    $image = $_FILES['image']['name'];  // Nama file gambar
    $imageTmp = $_FILES['image']['tmp_name']; // Lokasi file sementara

    // Tentukan folder tujuan untuk gambar
    $targetDir = "../images/service/";  // Folder tempat gambar disimpan
    $targetFile = $targetDir . basename($image); // Path lengkap untuk gambar

    // Periksa apakah file gambar valid (opsional)
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = array("jpg", "jpeg", "png", "gif"); // Daftar ekstensi yang valid
    if (!in_array($imageFileType, $validExtensions)) {
        echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
        exit;
    }

    // Pindahkan file gambar ke folder tujuan
    if (move_uploaded_file($imageTmp, $targetFile)) {
        // Gambar berhasil diupload

        // Masukkan data ke database
        $sql = "INSERT INTO poli (nama_poli, deskripsi_poli, image) VALUES ('$nama_poli', '$deskripsi_poli', '$image')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemenPoli.php"); // Arahkan ke halaman manajemen poli setelah berhasil
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}