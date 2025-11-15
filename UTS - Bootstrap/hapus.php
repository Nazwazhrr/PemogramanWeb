<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';

$conn = get_pg_connection();

$id = $_GET['id'];

$hapus = pg_query($conn, "DELETE FROM destinasi WHERE id = '$id'");

if ($hapus) {
    header("Location: data.php?pesan=hapus_sukses");
} else {
    echo "Gagal menghapus data.";
}
?>
