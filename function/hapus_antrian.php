<?php
include 'function.php';

$id_antrian = $_GET['id_antrian'];

$sql = "DELETE FROM antrian WHERE id_antrian='$id_antrian'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenAntrian.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}