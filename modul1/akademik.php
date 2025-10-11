<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "akademik");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses simpan data jika form dikirim
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $nim = $_POST['nim'];
  $email = $_POST['email'];
  $id_kelas = $_POST['id_kelas'];

  $query = "INSERT INTO mahasiswa (nama, nim, email, id_kelas)
            VALUES ('$nama', '$nim', '$email', '$id_kelas')";
  mysqli_query($conn, $query);
  header("Location: akademik.php"); // Refresh halaman
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Akademik</title>
  <style>
    body { font-family: Arial; margin: 40px; background-color: #f9f9f9; }
    h2 { color: #333; }
    form, table { margin-top: 20px; }
    input, select { padding: 8px; margin: 5px 0; width: 300px; }
    button { padding: 8px 16px; }
    table { border-collapse: collapse; width: 90%; background-color: #fff; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #eaeaea; }
    tr:nth-child(even) { background-color: #f2f2f2; }
  </style>
</head>
<body>

  <h2>Tambah Mahasiswa</h2>
  <form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br>

    <label>Kelas:</label><br>
    <select name="id_kelas" required>
      <?php
      $kelas = mysqli_query($conn, "SELECT id_kelas, nama_kelas FROM kelas");
      while ($k = mysqli_fetch_assoc($kelas)) {
        echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
      }
      ?>
    </select><br>

    <button type="submit" name="submit">Simpan</button>
  </form>

  <h2>Daftar Mahasiswa</h2>
  <table>
    <tr>
      <th>ID</th><th>Nama</th><th>NIM</th><th>Email</th><th>Kelas</th>
    </tr>
    <?php
    $query = "SELECT m.id_mahasiswa, m.nama, m.nim, m.email, k.nama_kelas
              FROM mahasiswa m
              LEFT JOIN kelas k ON m.id_kelas = k.id_kelas";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_mahasiswa']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['nim']}</td>
                <td>{$row['email']}</td>
                <td>" . ($row['nama_kelas'] ?? 'Belum terdaftar') . "</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='5'>Belum ada data mahasiswa.</td></tr>";
    }
    ?>
  </table>

</body>
</html>