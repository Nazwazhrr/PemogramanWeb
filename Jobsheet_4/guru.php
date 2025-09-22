<?php
$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$totalNilai = 0;

// cari nilai terbesar & terkecil
$terbesar1 = $terbesar2 = 0;
$terkecil1 = $terkecil2 = 100;

foreach ($nilaiSiswa as $nilai) {
    // cek nilai terbesar
    if ($nilai > $terbesar1) {
        $terbesar2 = $terbesar1;
        $terbesar1 = $nilai;
    } elseif ($nilai > $terbesar2) {
        $terbesar2 = $nilai;
    }

    // cek nilai terkecil
    if ($nilai < $terkecil1) {
        $terkecil2 = $terkecil1;
        $terkecil1 = $nilai;
    } elseif ($nilai < $terkecil2) {
        $terkecil2 = $nilai;
    }
}

// jumlahkan nilai kecuali 2 terbesar & 2 terkecil
foreach ($nilaiSiswa as $nilai) {
    if ($nilai == $terbesar1 || $nilai == $terbesar2 || $nilai == $terkecil1 || $nilai == $terkecil2) {
        continue;
    }
    $totalNilai += $nilai;
}

$rataRata = $totalNilai / 6;

echo "Total nilai tanpa 2 tertinggi & 2 terendah: $totalNilai <br>";
echo "Rata-rata nilai: $rataRata";
?>