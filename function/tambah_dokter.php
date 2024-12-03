<?php
include 'function.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_dokter = $_POST['id_dokter'];
    $id_poli = $_POST['id_poli'];
    $nama_dokter = $_POST['nama_dokter'];
    $no_wa = $_POST['no_wa'];
    $deskripsi = $_POST['deskripsi'];

    // Proses file gambar
    $image = $_FILES['image']['name'];  // Nama file gambar
    $imageTmp = $_FILES['image']['tmp_name']; // Lokasi file sementara

    // Tentukan folder tujuan untuk gambar
    $targetDir = "../images/dokter/";  // Folder tempat gambar disimpan
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
        $sql = "INSERT INTO dokter (id_dokter, id_poli, nama_dokter, no_wa, image, deskripsi) VALUES ( '$id_dokter', '$id_poli', '$nama_dokter', '$no_wa', '$image', '$deskripsi')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemendokter.php"); // Arahkan ke halaman manajemen dokter setelah berhasil
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}