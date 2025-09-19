<?php 
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo("Hasil Tambah: {$hasilTambah} <br>");
echo("Hasil Kurang: {$hasilKurang} <br>");
echo("Hasil Kali: {$hasilKali} <br>");
echo("Hasil Bagi: {$hasilBagi} <br>");
echo("Hasil Sisa Bagi: {$sisaBagi} <br>");
echo("Hasil Pangkat: {$pangkat} <br>");

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo("Hasil == : {$hasilSama} <br>");
echo("Hasil !=: {$hasilTidakSama} <br>");
echo("Hasil <: {$hasilLebihKecil} <br>");
echo("Hasil >: {$hasilLebihBesar} <br>");
echo("Hasil <=: {$hasilLebihKecilSama} <br>");
echo("Hasil >=: {$hasilLebihBesarSama} <br>");

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo("Hasil and : {$hasilAnd} <br>");
echo("Hasil or: {$hasilOr} <br>");
echo("Hasil not A: {$hasilNotA} <br>");
echo("Hasil not B: {$hasilNotB} <br>");

$a += $b;
echo("Hasil +=: {$a} <br>");
$a -= $b;
echo("Hasil -=: {$a} <br>");
$a *= $b;
echo("Hasil *=: {$a} <br>");
$a /= $b;
echo("Hasil /=: {$a} <br>");
$a %= $b;
echo("Hasil %=: {$a} <br>");

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo("Hasil Indentik : {$hasilIdentik} <br>");
echo("Hasil Tidak Identik : {$hasilTidakIdentik}");

// var_dump($hasilIdentik);
// echo("<br>")       
// var_dump($hasilTidakIdentik);  

$seats = 45;
$cust = 28;

$c = $seats - $cust;
$emptySeat = ($c / $seats) * 100;

echo("Empty Seats Presentage : {$emptySeat} %");



?>