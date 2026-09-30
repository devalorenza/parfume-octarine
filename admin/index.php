<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Octarine Perfume</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f5f0;
        }

        .header {
            background-color: white;

            padding: 20px 50px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout {
            text-decoration: none;
            color: #b00020;
        }

        .container {
            padding: 40px 50px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .welcome {
            margin-bottom: 25px;
            color: #666;
        }

        .btn-tambah {
            display: inline-block;

            background-color: #333;

            color: white;

            padding: 12px 18px;

            text-decoration: none;

            border-radius: 6px;

            margin-bottom: 20px;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            background-color: white;
        }

        th,
        td {
            padding: 15px;

            border-bottom: 1px solid #ddd;

            text-align: left;
        }

        th {
            background-color: #333;

            color: white;
        }

        .gambar-produk {
            width: 80px;

            height: 80px;

            object-fit: cover;

            border-radius: 8px;
        }

        .btn-edit {
            color: #333;

            text-decoration: none;

            margin-right: 10px;
        }

        .btn-hapus {
            color: #b00020;

            text-decoration: none;
        }

    </style>

</head>


<body>


<div class="header">

    <div class="logo">
        OCTARINE
    </div>


    <div class="admin-info">

        <span>
            👤 <?php echo $_SESSION['admin_username']; ?>
        </span>

        <a
            href="../auth/logout.php"
            class="logout"
        >
            Logout
        </a>

    </div>

</div>



<div class="container">

    <h1>
        Kelola Produk
    </h1>


    <div class="welcome">

        Selamat datang,
        <strong>
            <?php echo $_SESSION['admin_username']; ?>
        </strong>

    </div>


    <a
        href="tambah.php"
        class="btn-tambah"
    >
        + Tambah Produk
    </a>



    <table>

        <tr>

            <th>ID</th>

            <th>Foto</th>

            <th>Nama Produk</th>

            <th>Kategori</th>

            <th>Harga</th>

            <th>Stok</th>

            <th>Aksi</th>

        </tr>


        <?php while ($produk = mysqli_fetch_assoc($query)) { ?>

        <tr>

            <td>
                <?php echo $produk['id']; ?>
            </td>


            <td>

                <?php if (!empty($produk['gambar'])) { ?>

                    <img
                        src="../uploads/produk/<?php echo $produk['gambar']; ?>"
                        class="gambar-produk"
                        alt="<?php echo $produk['nama_produk']; ?>"
                    >

                <?php } else { ?>

                    Tidak ada foto

                <?php } ?>

            </td>


            <td>
                <?php echo $produk['nama_produk']; ?>
            </td>


            <td>
                <?php echo $produk['kategori']; ?>
            </td>


            <td>
                Rp
                <?php echo number_format(
                    $produk['harga'],
                    0,
                    ',',
                    '.'
                ); ?>
            </td>


            <td>
                <?php echo $produk['stok']; ?>
            </td>


            <td>

                <a
                    href="edit.php?id=<?php echo $produk['id']; ?>"
                    class="btn-edit"
                >
                    Edit
                </a>


                <a
                    href="hapus.php?id=<?php echo $produk['id']; ?>"
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin menghapus produk ini?');"
                >
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>


</body>

</html>