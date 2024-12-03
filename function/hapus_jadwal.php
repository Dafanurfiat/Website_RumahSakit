<?php
include 'function.php';

$id_jadwal_dokter = $_GET['id_jadwal_dokter'];

$sql = "DELETE FROM jadwal_dokter WHERE id_jadwal_dokter='$id_jadwal_dokter'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenJadwal.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
