<?php
$a = 10;
$b = 5;

echo "Variabel a: {$a} <br>";
echo "Variabel b: {$b} <br>";
echo "<br>";

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil Tambah: {$hasilTambah} <br>";
echo "Hasil Kurang: {$hasilKurang} <br>";
echo "Hasil Kali: {$hasilKali} <br>";
echo "Hasil Bagi: {$hasilBagi} <br>";
echo "Sisa Bagi: {$sisaBagi} <br>";
echo "pangkat: {$pangkat} <br>";
echo "<br>";

$hasilSama = $a == $b;
$hasilTidakSama =  $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "Hasil Sama: {$hasilSama} <br>";
echo "Hasil Tidak Sama: {$hasilTidakSama} <br>";
echo "Hasil Lebih Kecil: {$hasilLebihKecil} <br>";
echo "Hasil Lebih Besar: {$hasilLebihBesar} <br>";
echo "Hasil Lebih Kecil Sama: {$hasilLebihKecilSama} <br>";
echo "Hasil Lebih Besar Sama: {$hasilLebihBesarSama} <br>";
echo "<br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "Hasil AND: {$hasilAnd} <br>";
echo "Hasil OR: {$hasilOr} <br>";
echo "Hasil NOT A: {$hasilNotA} <br>";
echo "Hasil NOT B: {$hasilNotB} <br>";
echo "<br>";

echo "Nilai a: {$a} <br>";
echo "Nilai b: {$b} <br><br>";
$a += $b;
echo "Setelah a += b, nilai a: $a <br>";
$a -= $b;
echo "Setelah a -= b, nilai a: $a <br>";
$a *= $b;
echo "Setelah a *= b, nilai a: $a <br>";
$a /= $b;
echo "Setelah a /= b, nilai a: $a <br>";
$a %= $b;
echo "Setelah a %= b, nilai a: $a <br><br>";

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "Nilai a: {$a} <br>";
echo "Nilai b: {$b} <br><br>";

echo "Apakah a identik dengan b (===)? " . ($hasilIdentik ? 'true' : 'false') . "<br>";
echo "Apakah a tidak identik dengan b (!==)? " . ($hasilTidakIdentik ? 'true' : 'false') . "<br><br>";
?>