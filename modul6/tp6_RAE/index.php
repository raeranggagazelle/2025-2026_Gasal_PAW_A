<?php
require_once 'config.php';

$no_nota = generateNoNota();
$tanggal = date('Y-m-d');

$jumlah_barang = isset($_GET['jumlah']) ? max(1, intval($_GET['jumlah'])) : 3;

$message = '';
$message_type = '';
if (isset($_GET['status'])) {
    $message_type = $_GET['status'];
    $message = isset($_GET['message']) ? $_GET['message'] : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Form Input Transaksi</h1>
        
        <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="save_transaction.php">
            <h2>Data Master (Nota)</h2>
            <table>
                <tr>
                    <td><label>Nomor Nota:</label></td>
                    <td><input type="text" name="no_nota" value="<?php echo htmlspecialchars($no_nota); ?>" readonly required></td>
                </tr>
                <tr>
                    <td><label>Tanggal:</label></td>
                    <td><input type="date" name="tanggal" value="<?php echo $tanggal; ?>" required></td>
                </tr>
                <tr>
                    <td><label>Customer:</label></td>
                    <td><input type="text" name="customer" required></td>
                </tr>
            </table>
            
            <h2>Data Detail (Barang)</h2>
            <p><a href="?jumlah=<?php echo $jumlah_barang + 1; ?>">[+ Tambah Barang]</a></p>
            
            <table class="table-detail">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
                <?php for ($i = 0; $i < $jumlah_barang; $i++): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><input type="text" name="nama_barang[]" placeholder="Nama Barang"></td>
                    <td><input type="number" name="jumlah[]" min="0" step="1" placeholder="0"></td>
                    <td><input type="number" name="harga[]" min="0" step="0.01" placeholder="0"></td>
                </tr>
                <?php endfor; ?>
            </table>            
            <div class="form-actions">
                <button type="submit" name="simpan">Simpan Transaksi</button>
                <a href="index.php">Reset</a>
            </div>
        </form>
    </div>
</body>
</html>
