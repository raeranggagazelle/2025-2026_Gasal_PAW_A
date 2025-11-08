<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?status=error&message=Method not allowed');
    exit;
}

$no_nota = isset($_POST['no_nota']) ? trim($_POST['no_nota']) : '';
$tanggal = isset($_POST['tanggal']) ? trim($_POST['tanggal']) : '';
$customer = isset($_POST['customer']) ? trim($_POST['customer']) : '';

$nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : [];
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];
$harga = isset($_POST['harga']) ? $_POST['harga'] : [];

if (empty($no_nota) || empty($tanggal) || empty($customer)) {
    header('Location: index.php?status=error&message=Data master tidak lengkap!');
    exit;
}

$items = [];
for ($i = 0; $i < count($nama_barang); $i++) {
    $nama = trim($nama_barang[$i]);
    $jml = intval($jumlah[$i]);
    $hrg = floatval($harga[$i]);
    
    if (!empty($nama) && $jml > 0 && $hrg > 0) {
        $items[] = [
            'nama' => $nama,
            'jumlah' => $jml,
            'harga' => $hrg,
            'subtotal' => $jml * $hrg
        ];
    }
}

if (count($items) == 0) {
    header('Location: index.php?status=error&message=Minimal harus ada 1 barang yang diisi!');
    exit;
}

$conn = getConnection();

$conn->autocommit(FALSE);

try {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['subtotal'];
    }
    
    $stmt_master = $conn->prepare("INSERT INTO nota (no_nota, tanggal, customer, total) VALUES (?, ?, ?, ?)");
    $stmt_master->bind_param("sssd", $no_nota, $tanggal, $customer, $total);
    
    if (!$stmt_master->execute()) {
        throw new Exception("Gagal menyimpan data master: " . $stmt_master->error);
    }
    
    $id_nota = $conn->insert_id;
    
    $stmt_detail = $conn->prepare("INSERT INTO transaksi_detail (id_nota, nama_barang, jumlah, harga, subtotal) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($items as $item) {
        $stmt_detail->bind_param("isidd", $id_nota, $item['nama'], $item['jumlah'], $item['harga'], $item['subtotal']);
        
        if (!$stmt_detail->execute()) {
            throw new Exception("Gagal menyimpan data detail: " . $stmt_detail->error);
        }
    }
    
    $conn->commit();
    
    $stmt_master->close();
    $stmt_detail->close();
    $conn->close();
    
    header('Location: index.php?status=success&message=Transaksi berhasil disimpan!');
    exit;
    
} catch (Exception $e) {
    $conn->rollback();
    $conn->close();
    
    header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
    exit;
}
