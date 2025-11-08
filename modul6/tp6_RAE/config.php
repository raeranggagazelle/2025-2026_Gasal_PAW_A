<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_transaksi');

function getConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

function generateNoNota() {
    $conn = getConnection();
    $date = date('Ymd');
    $query = "SELECT COUNT(*) as total FROM nota WHERE DATE(tanggal) = CURDATE()";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $sequence = str_pad(($row['total'] + 1), 4, '0', STR_PAD_LEFT);
    $no_nota = "NOTA-" . $date . "-" . $sequence;
    $conn->close();
    return $no_nota;
}

