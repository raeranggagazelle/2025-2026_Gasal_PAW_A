<?php
$produk = array(
  "Laptop" => 7500000,
  "Mouse" => 200000,
  "Keyboard" => 500000,
  "Monitor" => 2000000
);

foreach($produk as $item => $harga){
  echo "$item = Rp " . number_format($harga,0,',','.') . "<br>";
}
?>
