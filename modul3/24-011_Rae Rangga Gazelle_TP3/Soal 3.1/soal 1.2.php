<?php
$Lfruits = array("Alpukat", "Blueberry", "Ceri");
unset($Lfruits[2]);
print_r($Lfruits);
echo "<br><br>Indeks tertinggi sekarang: " . (count($Lfruits) - 1);
?>