<?php
include 'function.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul_berita = $_POST['judul_berita'];
    $isi_berita = $_POST['isi_berita'];

    // Proses file gambar
    $gambar = $_FILES['gambar']['name'];  // Nama file gambar
    $gambarTmp = $_FILES['gambar']['tmp_name']; // Lokasi file sementara

    // Tentukan folder tujuan untuk gambar
    $targetDir = "../images/berita/";  // Folder tempat gambar disimpan
    $targetFile = $targetDir . basename($gambar); // Path lengkap untuk gambar

    // Periksa apakah file gambar valid (opsional)
    $gambarFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = array("jpg", "jpeg", "png", "gif"); // Daftar ekstensi yang valid
    if (!in_array($gambarFileType, $validExtensions)) {
        echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
        exit;
    }

    // Pindahkan file gambar ke folder tujuan
    if (move_uploaded_file($gambarTmp, $targetFile)) {
        // Gambar berhasil diupload

        // Masukkan data ke database
        $sql = "INSERT INTO berita (judul_berita, isi_berita, waktu_berita, gambar) VALUES ('$judul_berita', '$isi_berita', '$waktu_berita', '$gambar')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manajemenberita.php"); // Arahkan ke halaman manajemen berita setelah berhasil
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}