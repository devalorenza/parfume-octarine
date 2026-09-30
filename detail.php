<?php

include "config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

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

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $produk['nama_produk']; ?> - Octarine
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background-color: #f8f5f0;

            color: #333;
        }

        .navbar {
            background-color: white;

            padding: 20px 60px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.08);
        }

        .logo {
            font-size: 25px;

            font-weight: bold;

            letter-spacing: 3px;
        }

        .navbar a {
            text-decoration: none;

            color: #333;
        }

        .container {
            max-width: 1000px;

            margin: 60px auto;

            padding: 0 20px;
        }

        .detail-card {
            background-color: white;

            border-radius: 15px;

            padding: 40px;

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 50px;

            box-shadow:
                0 5px 25px rgba(0,0,0,0.08);
        }

        .foto img {
            width: 100%;

            height: 450px;

            object-fit: cover;

            border-radius: 12px;
        }

        .no-foto {
            height: 450px;

            display: flex;

            align-items: center;

            justify-content: center;

            background-color: #eee;

            border-radius: 12px;

            color: #777;
        }

        .info h1 {
            font-size: 32px;

            margin-top: 0;

            margin-bottom: 10px;
        }

        .kategori {
            color: #888;

            margin-bottom: 25px;
        }

        .harga {
            font-size: 25px;

            font-weight: bold;

            margin-bottom: 15px;
        }

        .stok {
            color: #666;

            margin-bottom: 30px;
        }

        .judul-deskripsi {
            font-size: 18px;

            font-weight: bold;

            margin-bottom: 10px;
        }

        .deskripsi {
            color: #666;

            line-height: 1.8;

            margin-bottom: 30px;
        }

        .btn-kembali {
            display: inline-block;

            padding: 12px 20px;

            background-color: #333;

            color: white;

            text-decoration: none;

            border-radius: 7px;
        }

        .btn-kembali:hover {
            background-color: #555;
        }

        footer {
            margin-top: 50px;

            padding: 25px;

            background-color: #333;

            color: white;

            text-align: center;
        }

        @media (max-width: 700px) {

            .navbar {
                padding: 20px;
            }

            .detail-card {
                grid-template-columns: 1fr;

                padding: 25px;

                gap: 30px;
            }

            .foto img,
            .no-foto {
                height: 350px;
            }

        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        OCTARINE
    </div>

    <a href="index.php">
        ← Kembali ke Beranda
    </a>

</nav>


<!-- DETAIL -->

<div class="container">

    <div class="detail-card">


        <!-- FOTO -->

        <div class="foto">

            <?php if (!empty($produk['gambar'])) { ?>

                <img
                    src="uploads/produk/<?php echo $produk['gambar']; ?>"
                    alt="<?php echo $produk['nama_produk']; ?>"
                >

            <?php } else { ?>

                <div class="no-foto">
                    Tidak ada foto produk
                </div>

            <?php } ?>

        </div>


        <!-- INFORMASI -->

        <div class="info">

            <h1>
                <?php echo $produk['nama_produk']; ?>
            </h1>


            <div class="kategori">

                Kategori:
                <?php echo $produk['kategori']; ?>

            </div>


            <div class="harga">

                Rp
                <?php

                echo number_format(
                    $produk['harga'],
                    0,
                    ',',
                    '.'
                );

                ?>

            </div>


            <div class="stok">

                Stok tersedia:
                <?php echo $produk['stok']; ?>

            </div>


            <div class="judul-deskripsi">

                Deskripsi Produk

            </div>


            <div class="deskripsi">

                <?php

                echo nl2br(
                    htmlspecialchars(
                        $produk['deskripsi']
                    )
                );

                ?>

            </div>


            <a
                href="index.php"
                class="btn-kembali"
            >
                ← Kembali ke Produk
            </a>

        </div>


    </div>

</div>


<footer>

    © 2026 Octarine Perfume

</footer>


</body>

</html>