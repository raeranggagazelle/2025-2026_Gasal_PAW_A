CREATE DATABASE IF NOT EXISTS db_transaksi;
USE db_transaksi;

-- Tabel Master: Nota
CREATE TABLE IF NOT EXISTS nota (
    id_nota INT AUTO_INCREMENT PRIMARY KEY,
    no_nota VARCHAR(50) UNIQUE NOT NULL,
    tanggal DATE NOT NULL,
    customer VARCHAR(100) NOT NULL,
    total DECIMAL(15,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Detail: Barang/Item Transaksi
CREATE TABLE IF NOT EXISTS transaksi_detail (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_nota INT NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL,
    harga DECIMAL(15,2) NOT NULL,
    subtotal DECIMAL(15,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_nota) REFERENCES nota(id_nota) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

