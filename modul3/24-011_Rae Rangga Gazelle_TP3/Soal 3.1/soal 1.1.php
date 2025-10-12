<?php
$Lfruits = array("Alpukat", "Blueberry", "Ceri");
array_push($Lfruits, "Durian", "Mangga", "Apel", "Pir", "Jeruk");

echo "Isi array Lfruits:<br>";
print_r($Lfruits);
echo "<br><br>Nilai dengan indeks tertinggi adalah: " . end($Lfruits);
echo "<br>Indeks tertinggi: " . (count($Lfruits) - 1);
?>
