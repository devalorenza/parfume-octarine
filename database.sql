-- DATABASE PARFUME OCTARINE

CREATE DATABASE IF NOT EXISTS octarine
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE octarine;

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (username, password)
VALUES ('admin', 'octarine123')
ON DUPLICATE KEY UPDATE username = username;

CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    gambar VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produk
(nama_produk, kategori, harga, stok, deskripsi, gambar)
VALUES
('Octarine Rose', 'Women', 150000, 20,
 'Parfum dengan karakter aroma floral yang lembut dan cocok digunakan untuk aktivitas sehari-hari.', NULL),
('Octarine Ocean', 'Men', 175000, 20,
 'Parfum dengan karakter aroma segar yang memberikan kesan bersih dan modern.', NULL),
('Octarine Aura', 'Unisex', 185000, 15,
 'Parfum dengan karakter aroma yang dapat digunakan untuk pria maupun wanita.', NULL);
