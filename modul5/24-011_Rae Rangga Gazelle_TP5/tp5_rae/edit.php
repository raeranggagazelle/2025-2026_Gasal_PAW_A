<?php
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'tp5_rae';
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('Gagal konek database: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $mysqli->prepare('SELECT * FROM suppliers WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$supplier = $result->fetch_assoc();

if (!$supplier) {
    header('Location: index.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $telp = trim($_POST['telp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') $errors[] = 'Nama wajib diisi';
    if ($telp === '') $errors[] = 'Telp wajib diisi';
    if ($alamat === '') $errors[] = 'Alamat wajib diisi';

    if (!$errors) {
        $u = $mysqli->prepare('UPDATE suppliers SET nama = ?, telp = ?, alamat = ? WHERE id = ?');
        $u->bind_param('sssi', $nama, $telp, $alamat, $id);
        $u->execute();
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Master Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="padding: 20px;">
    <h3>Edit Data Supplier</h3>

    <?php if ($errors): ?>
        <div style="color: red; margin: 10px 0;">
            <?php foreach ($errors as $e): ?>
                <div><?php echo htmlspecialchars($e); ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <div style="margin-bottom: 10px;">
            <label>Nama:</label><br>
            <input type="text" name="nama" style="width: 300px; padding: 5px;" value="<?php echo htmlspecialchars($_POST['nama'] ?? $supplier['nama']); ?>">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Telp:</label><br>
            <input type="text" name="telp" style="width: 300px; padding: 5px;" value="<?php echo htmlspecialchars($_POST['telp'] ?? $supplier['telp']); ?>">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Alamat:</label><br>
            <input type="text" name="alamat" style="width: 300px; padding: 5px;" value="<?php echo htmlspecialchars($_POST['alamat'] ?? $supplier['alamat']); ?>">
        </div>
        <div style="margin-top: 15px;">
            <button type="submit" style="padding: 5px 15px;">Update</button>
            <a href="index.php" style="margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>
</body>
</html>


