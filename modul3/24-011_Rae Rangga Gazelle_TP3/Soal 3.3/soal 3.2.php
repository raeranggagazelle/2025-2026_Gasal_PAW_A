<?php
$Lheight = array(
    "Alita" => 160,
    "Bobi" => 170,
    "Chandra" => 165,
    "David" => 175
);

unset($Lheight["Chandra"]);
$keys = array_keys($Lheight);
echo "Setelah dihapus, indeks terakhir (key): " . end($keys);
?>