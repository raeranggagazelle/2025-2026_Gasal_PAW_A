<?php
$numbers = array(10, 20, 30, 40, 50);

array_push($numbers, 60, 70);

$more = array(80, 90);
$merged = array_merge($numbers, $more);

print_r(array_values($merged));

echo "Nilai 40 berada pada indeks: " . array_search(40, $merged) . "<br>";

$filtered = array_filter($merged, fn($n) => $n > 50);
print_r($filtered);

sort($merged);
print_r($merged);
?>