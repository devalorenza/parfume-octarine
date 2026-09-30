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

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {

    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($_FILES['gambar']['name'])) {

        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];

        $nama_gambar = time() . "_" . $nama_file;

        $folder = "../uploads/produk/";

        move_uploaded_file(
            $tmp_file,
            $folder . $nama_gambar
        );

    } else {

        $nama_gambar = $produk['gambar'];

    }


    $update = mysqli_query(
        $koneksi,
        "UPDATE produk SET

        nama_produk='$nama_produk',
        kategori='$kategori',
        harga='$harga',
        stok='$stok',
        deskripsi='$deskripsi',
        gambar='$nama_gambar'

        WHERE id='$id'"
    );


    if ($update) {

        header("Location: index.php");
        exit;

    } else {

        echo "Data gagal diperbarui: "
             . mysqli_error($koneksi);

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Edit Produk - Octarine</title>

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

.foto-lama {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.btn {
    margin-top: 25px;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.btn-update {
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

<h1>Edit Produk Octarine</h1>

<form method="POST"
      enctype="multipart/form-data">


<label>Nama Produk</label>

<input
    type="text"
    name="nama_produk"
    value="<?php echo $produk['nama_produk']; ?>"
    required
>


<label>Kategori</label>

<select name="kategori" required>

<option value="Women"
<?php
if ($produk['kategori'] == 'Women') {
    echo 'selected';
}
?>
>
Women
</option>

<option value="Men"
<?php
if ($produk['kategori'] == 'Men') {
    echo 'selected';
}
?>
>
Men
</option>

<option value="Unisex"
<?php
if ($produk['kategori'] == 'Unisex') {
    echo 'selected';
}
?>
>
Unisex
</option>

</select>


<label>Harga</label>

<input
    type="number"
    name="harga"
    value="<?php echo $produk['harga']; ?>"
    required
>


<label>Stok</label>

<input
    type="number"
    name="stok"
    value="<?php echo $produk['stok']; ?>"
    required
>


<label>Deskripsi</label>

<textarea
    name="deskripsi"
    required
><?php echo $produk['deskripsi']; ?></textarea>


<label>Foto Saat Ini</label>

<br>

<?php if (!empty($produk['gambar'])) { ?>

<img
    src="../uploads/produk/<?php echo $produk['gambar']; ?>"
    class="foto-lama"
>

<?php } ?>


<label>Ganti Foto</label>

<input
    type="file"
    name="gambar"
    accept="image/*"
>


<button
    type="submit"
    name="update"
    class="btn btn-update"
>
    Update Produk
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