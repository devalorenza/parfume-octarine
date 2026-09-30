<?php
include "config/koneksi.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$query = "SELECT * FROM produk WHERE 1=1";

if ($keyword != '') {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query .= " AND nama_produk LIKE '%$keyword%'";
}

if ($kategori != '') {
    $kategori = mysqli_real_escape_string($koneksi, $kategori);

    $query .= " AND kategori='$kategori'";
}

$query .= " ORDER BY id DESC";

$result = mysqli_query($koneksi, $query);

$kategori_query = mysqli_query(
    $koneksi,
    "SELECT DISTINCT kategori FROM produk"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Octarine Perfume</title>

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

        /* NAVBAR */

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

        .nav-menu a {
            text-decoration: none;

            color: #333;

            margin-left: 25px;
        }

        .nav-menu a:hover {
            color: #777;
        }

        /* HERO */

        .hero {
            text-align: center;

            padding: 70px 20px 45px;
        }

        .hero h1 {
            font-size: 45px;

            margin-bottom: 15px;

            letter-spacing: 2px;
        }

        .hero p {
            color: #777;

            font-size: 17px;
        }

        /* SEARCH */

        .search-area {
            max-width: 1000px;

            margin: 0 auto 40px;

            padding: 0 20px;

            display: flex;

            gap: 12px;
        }

        .search-area input {
            flex: 1;

            padding: 14px 18px;

            border: 1px solid #ddd;

            border-radius: 8px;

            font-size: 14px;
        }

        .search-area select {
            width: 180px;

            padding: 14px;

            border: 1px solid #ddd;

            border-radius: 8px;

            background-color: white;
        }

        .search-area button {
            padding: 14px 22px;

            border: none;

            border-radius: 8px;

            background-color: #333;

            color: white;

            cursor: pointer;
        }

        .search-area button:hover {
            background-color: #555;
        }

        /* PRODUK */

        .produk-section {
            padding: 10px 60px 70px;
        }

        .produk-section h2 {
            text-align: center;

            margin-bottom: 35px;
        }

        .produk-container {
            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(220px, 1fr));

            gap: 30px;

            max-width: 1100px;

            margin: auto;
        }

        /* LINK */

        .produk-link {
            text-decoration: none;

            color: inherit;
        }

        /* CARD */

        .produk-card {
            background-color: white;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.08);

            transition: 0.3s;
        }

        .produk-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 10px 25px rgba(0,0,0,0.12);
        }

        /* FOTO */

        .produk-card img {
            width: 100%;

            height: 260px;

            object-fit: cover;

            display: block;
        }

        /* INFO */

        .produk-info {
            padding: 20px;
        }

        .produk-info h3 {
            margin: 0 0 8px;

            font-size: 19px;
        }

        .kategori {
            color: #888;

            font-size: 14px;

            margin-bottom: 12px;
        }

        .harga {
            font-size: 17px;

            font-weight: bold;

            margin-bottom: 6px;
        }

        .stok {
            font-size: 13px;

            color: #777;
        }

        .btn-detail {
            display: inline-block;

            margin-top: 15px;

            padding: 9px 15px;

            background-color: #333;

            color: white;

            border-radius: 5px;

            font-size: 13px;
        }

        /* TIDAK ADA PRODUK */

        .tidak-ada {
            text-align: center;

            grid-column: 1 / -1;

            padding: 50px;

            color: #777;
        }

        /* TENTANG */

        .tentang {
            text-align: center;

            padding: 60px 20px;

            background-color: white;
        }

        .tentang h2 {
            margin-bottom: 15px;
        }

        .tentang p {
            max-width: 700px;

            margin: auto;

            line-height: 1.7;

            color: #666;
        }

        /* FOOTER */

        footer {
            background-color: #333;

            color: white;

            text-align: center;

            padding: 25px;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {

            .navbar {
                padding: 20px;
            }

            .nav-menu a {
                margin-left: 10px;

                font-size: 13px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .produk-section {
                padding: 20px;
            }

            .search-area {
                flex-direction: column;
            }

            .search-area select {
                width: 100%;
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


    <div class="nav-menu">

        <a href="index.php">
            Home
        </a>

        <a href="#produk">
            Produk
        </a>

        <a href="#tentang">
            Tentang
        </a>

        <a href="admin/">
            Admin
        </a>

    </div>

</nav>



<!-- HERO -->

<section class="hero">

    <h1>
        Octarine Perfume
    </h1>

    <p>
        Temukan aroma yang menggambarkan
        karakter dan gaya kamu.
    </p>

</section>



<!-- SEARCH -->

<form
    method="GET"
    action="index.php"
    class="search-area"
>

    <input
        type="text"
        name="keyword"
        placeholder="Cari nama parfum..."
        value="<?php echo htmlspecialchars($keyword); ?>"
    >


    <select name="kategori">

        <option value="">
            Semua Kategori
        </option>


        <?php while ($kat = mysqli_fetch_assoc($kategori_query)) { ?>

            <option
                value="<?php echo $kat['kategori']; ?>"
                <?php
                if ($kategori == $kat['kategori']) {
                    echo 'selected';
                }
                ?>
            >

                <?php echo $kat['kategori']; ?>

            </option>

        <?php } ?>

    </select>


    <button type="submit">
        Cari
    </button>

</form>



<!-- PRODUK -->

<section
    class="produk-section"
    id="produk"
>

    <h2>
        Koleksi Parfum Octarine
    </h2>


    <div class="produk-container">


        <?php if (mysqli_num_rows($result) > 0) { ?>


            <?php while ($produk = mysqli_fetch_assoc($result)) { ?>


                <a
                    href="detail.php?id=<?php echo $produk['id']; ?>"
                    class="produk-link"
                >


                    <div class="produk-card">


                        <?php if (!empty($produk['gambar'])) { ?>

                            <img
                                src="uploads/produk/<?php echo $produk['gambar']; ?>"
                                alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                            >

                        <?php } else { ?>

                            <div
                                style="
                                height:260px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:#eee;
                                "
                            >
                                Tidak ada foto
                            </div>

                        <?php } ?>


                        <div class="produk-info">


                            <h3>
                                <?php
                                echo htmlspecialchars(
                                    $produk['nama_produk']
                                );
                                ?>
                            </h3>


                            <div class="kategori">

                                <?php
                                echo htmlspecialchars(
                                    $produk['kategori']
                                );
                                ?>

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


                            <div class="btn-detail">

                                Lihat Detail →

                            </div>


                        </div>


                    </div>


                </a>


            <?php } ?>


        <?php } else { ?>


            <div class="tidak-ada">

                Produk yang kamu cari tidak ditemukan.

            </div>


        <?php } ?>


    </div>

</section>



<!-- TENTANG -->

<section
    class="tentang"
    id="tentang"
>

    <h2>
        Tentang Octarine
    </h2>


    <p>

        Octarine menghadirkan pilihan parfum
        dengan karakter aroma yang elegan dan
        nyaman digunakan untuk berbagai kesempatan.

        Pilih produk yang kamu suka untuk melihat
        informasi dan deskripsi lengkapnya.

    </p>

</section>



<footer>

    © 2026 Octarine Perfume

</footer>


</body>

</html>