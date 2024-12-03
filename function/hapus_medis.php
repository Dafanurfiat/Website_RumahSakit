<?php
include 'function.php';

$id_rekam_medis = $_GET['id_rekam_medis'];

$sql = "DELETE FROM rekam_medis WHERE id_rekam_medis='$id_rekam_medis'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenRekamMedis.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
