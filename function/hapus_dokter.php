<?php
include 'function.php';

$id_dokter = $_GET['id_dokter'];

$sql = "DELETE FROM dokter WHERE id_dokter='$id_dokter'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenDokter.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}