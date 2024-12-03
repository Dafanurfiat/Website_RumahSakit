<?php
include 'function.php';

$id_poli = $_GET['id_poli'];

$sql = "DELETE FROM poli WHERE id_poli='$id_poli'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenPoli.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
