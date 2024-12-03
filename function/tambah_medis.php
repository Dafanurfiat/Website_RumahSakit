<?php
require 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_pasien = $_POST['id_pasien'];
    $id_antrian = $_POST['id_antrian'];
    $diagnosa = $_POST['diagnosa'];
    $id_dokter = $_POST['id_dokter'];
    $tekanan_darah_tinggi = $_POST['tekanan_darah_tinggi'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $suhu_badan = $_POST['suhu_badan'];
    $obat = $_POST['obat'];

    if (empty($id_pasien) || empty($id_antrian) || empty($diagnosa) || empty($id_dokter) || 
        empty($tekanan_darah_tinggi) || empty($berat_badan) || empty($tinggi_badan) || empty($suhu_badan) || empty($obat)) {
        echo "Semua field wajib diisi!";
        exit;
    }

    // Query insert
    $query = "INSERT INTO rekam_medis (id_pasien, id_antrian, diagnosa, id_dokter, tekanan_darah_tinggi, berat_badan, tinggi_badan, suhu_badan, obat) 
              VALUES ('$id_pasien', '$id_antrian', '$diagnosa', '$id_dokter', '$tekanan_darah_tinggi', '$berat_badan', '$tinggi_badan', '$suhu_badan', '$obat')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman lain (contoh: daftar rekam medis)
        header("Location: ../admin/manajemenRekamMedis.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>