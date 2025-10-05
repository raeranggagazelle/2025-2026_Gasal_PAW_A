<?php
$tagihan = 0;

do {
    echo str_repeat("=", 25) . "\n";
    echo "        MENU KASIR        \n";
    echo str_repeat("=", 25) . "\n";
    echo "1) Nasi Goreng   - Rp10000\n";
    echo "2) Es Teh        - Rp3000\n";
    echo "3) Es Jeruk      - Rp4000\n";
    echo "4) Mie Ayam      - Rp10000\n";
    echo str_repeat("-", 25) . "\n";

    $kode = (int) readline("Pilih nomor menu (1-4): ");
    $qty  = (int) readline("Masukkan jumlah pesanan: ");

    $harga = 0;
    $nama  = "Tidak valid";

    switch ($kode) {
        case 1:
            $harga = 10000; $nama = "Nasi Goreng"; break;
        case 2:
            $harga = 3000; $nama = "Es Teh"; break;
        case 3:
            $harga = 4000; $nama = "Es Jeruk"; break;
        case 4:
            $harga = 10000; $nama = "Mie Ayam"; break;
        default:
            echo "Menu tidak tersedia!\n";
    }

    $bayarSementara = $harga * $qty;
    $tagihan += $bayarSementara;

    echo ">> Pesanan: $nama x $qty = Rp$bayarSementara\n";
    echo ">> Total sementara: Rp$tagihan\n";

    $ulang = readline("Tambah pesanan lagi? (y/n): ");
} while ($ulang === 'y');

echo "\n" . str_repeat("=", 28) . "\n";
echo "  TOTAL YANG HARUS DIBAYAR\n";
echo "  Rp$tagihan\n";
echo str_repeat("=", 28) . "\n";
?>