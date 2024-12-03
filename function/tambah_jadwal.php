<?php
require 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_jadwal_dokter = $_POST['id_jadwal_dokter'];
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam = !empty($_POST['jam']) ? $_POST['jam'] : 'tutup';

    // Validasi data
    if (empty($id_jadwal_dokter || empty($id_dokter) || empty($hari))) {
        echo "Semua field wajib diisi!";
        exit;
    }

    // Query insert
    $query = "INSERT INTO jadwal_dokter (id_jadwal_dokter, id_dokter, hari, jam) 
              VALUES ('$id_jadwal_dokter', '$id_dokter', '$hari', '$jam')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman lain (contoh: daftar rekam medis)
        header("Location: ../admin/manajemenJadwal.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>