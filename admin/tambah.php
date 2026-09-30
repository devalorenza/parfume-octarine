<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    $nama_gambar = time() . "_" . $nama_file;

    $folder = "../uploads/produk/";

    move_uploaded_file(
        $tmp_file,
        $folder . $nama_gambar
    );

    $query = mysqli_query(
        $koneksi,
        "INSERT INTO produk
        (nama_produk, kategori, harga, stok, deskripsi, gambar)
        VALUES
        ('$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi', '$nama_gambar')"
    );

    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Tambah Produk - Octarine</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f5f0;
}

.container {
    width: 600px;
    margin: 50px auto;
    background-color: white;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

h1 {
    margin-bottom: 30px;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 7px;
    font-weight: bold;
}

input,
textarea,
select {
    width: 100%;
    padding: 12px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

textarea {
    height: 100px;
    resize: none;
}

.btn {
    margin-top: 25px;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.btn-simpan {
    background-color: #333;
    color: white;
}

.btn-kembali {
    background-color: #ddd;
    color: #333;
    text-decoration: none;
    margin-left: 10px;
}

</style>

</head>

<body>

<div class="container">

<h1>Tambah Produk Octarine</h1>

<form method="POST"
      enctype="multipart/form-data">

<label>Nama Produk</label>

<input
    type="text"
    name="nama_produk"
    placeholder="Contoh: Octarine Rose"
    required
>


<label>Kategori</label>

<select name="kategori" required>

<option value="">
    -- Pilih Kategori --
</option>

<option value="Women">
    Women
</option>

<option value="Men">
    Men
</option>

<option value="Unisex">
    Unisex
</option>

</select>


<label>Harga</label>

<input
    type="number"
    name="harga"
    placeholder="Contoh: 150000"
    required
>


<label>Stok</label>

<input
    type="number"
    name="stok"
    placeholder="Contoh: 20"
    required
>


<label>Deskripsi</label>

<textarea
    name="deskripsi"
    placeholder="Masukkan deskripsi parfum..."
    required
></textarea>


<label>Foto Produk</label>

<input
    type="file"
    name="gambar"
    accept="image/*"
    required
>


<button
    type="submit"
    name="simpan"
    class="btn btn-simpan"
>
    Simpan Produk
</button>


<a
    href="index.php"
    class="btn btn-kembali"
>
    Kembali
</a>

</form>

</div>

</body>

</html>