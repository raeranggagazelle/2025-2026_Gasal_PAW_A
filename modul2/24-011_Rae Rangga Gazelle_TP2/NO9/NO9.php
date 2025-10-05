<?php
$nilai = (int)readline("Masukkan nilai mahasiswa: ");

if ($nilai >= 90) {
    echo "Grade: A";
} else if ($nilai >= 80) {
    echo "Grade: B";
} else if ($nilai >= 70) {
    echo "Grade: C";
} else if ($nilai >= 50) {
    echo "Grade: D";
} else {
    echo "Grade: E";
}
?>


