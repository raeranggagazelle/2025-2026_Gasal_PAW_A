<?php
$Lheight = array("Andi"=>"176", "Bara"=>"165", "Chandra"=>"170");
$Lheight["Dani"] = "160";
$Lheight["Eki"] = "168";
$Lheight["Jafar"] = "172";
$Lheight["Gita"] = "169";
$Lheight["Handi"] = "162";

echo "<pre>";
print_r($Lheight);
echo "</pre>";

$keys = array_keys($Lheight);
echo "Indeks terakhir (key): " . end($keys);
?>