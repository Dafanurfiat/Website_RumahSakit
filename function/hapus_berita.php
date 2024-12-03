<?php
include 'function.php';

$id_berita = $_GET['id_berita'];

$sql = "DELETE FROM berita WHERE id_berita='$id_berita'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/manajemenBerita.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}