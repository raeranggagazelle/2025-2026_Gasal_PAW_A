<?php 
function validateNreturnData($id, $default) {
    return isset($_POST[$id]) ? $_POST[$id] : $default ?? "Data $id tidak ditemukan";
}

$data = [
  'name' => validateNreturnData("name", "Moch. Zamroni Fahreza"),
  'nim' => validateNreturnData("nim", "240411100085"),
  'class' => validateNreturnData("class", "Pengembangan Aplikasi Web 3A"),
  'location' => validateNreturnData("location", "Karduluk, Pragaan, Sumenep, Jawa Timur"),
];

$keys = [];
$values = [];

foreach ($data as $k => $v) {
  $keys[] = $k;
  $values[] = $v;
}

echo "<form method='post'>";
foreach ($keys as $kys){
  $types = $kys === 'nim' ? "number" : "text";
  echo "<label for='$kys' style='text-transform: capitalize;'>$kys</label>";
  echo "<br>";
  echo "<input type='$types' name='$kys' id='$kys' placeholder='input $kys........' required>";
  echo "<br>";
}
echo '<button type="submit">OK</button>';
echo '</form>';

echo "<table border='1'>";
echo "<tr>";
foreach ($keys as $kys){
  echo "<th style='text-transform: capitalize;'>$kys</th>";
}
echo "</tr>";
echo "<tr>";
foreach ($values as $val){
  echo "<td style='text-transform: capitalize;'>$val</td>";
}
echo "</tr>";
echo "</table>";


?>