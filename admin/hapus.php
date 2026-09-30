<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM produk WHERE id='$id'"
);

$produk = mysqli_fetch_assoc($query);

if ($produk) {

    // Hapus foto dari folder
    if (!empty($produk['gambar'])) {

        $file = "../uploads/produk/" . $produk['gambar'];

        if (file_exists($file)) {
            unlink($file);
        }
    }

    // Hapus data dari database
    mysqli_query(
        $koneksi,
        "DELETE FROM produk WHERE id='$id'"
    );
}

header("Location: index.php");
exit;

?>