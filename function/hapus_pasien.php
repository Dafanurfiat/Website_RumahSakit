<?php
include 'function.php';

$id_pasien = $_GET['id_pasien'];

$sql = "DELETE FROM pasien WHERE id_pasien='$id_pasien'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenPasien.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}