<?php
require '../function/function.php';

if (isset($_GET['id_antrian']) && isset($_GET['status'])) {
    $id_antrian = intval($_GET['id_antrian']);
    $status = $_GET['status'];

    // Validasi status
    if (!in_array($status, ['diterima', 'ditolak'])) {
        die("Status tidak valid!");
    }

    // Update status
    $updateQuery = "UPDATE antrian SET status = '$status' WHERE id_antrian = $id_antrian";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../admin/manajemenAntrian.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Parameter tidak lengkap!";
}
?>
