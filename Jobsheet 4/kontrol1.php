<?php 
// sorting
$nilaiMahasiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$totalNilai = count($nilaiMahasiswa);

for ($i = 0; $i < $totalNilai - 1; $i++) { 
    for($j = 0; $j < $totalNilai - $i - 1; $j++){
        if ($nilaiMahasiswa[$j] < $nilaiMahasiswa[$j + 1]) {
            $temp = $nilaiMahasiswa[$j];
            $nilaiMahasiswa[$j] = $nilaiMahasiswa[$j + 1];
            $nilaiMahasiswa[$j + 1] = $temp;
        }
    }
}

$nilaiUse = [];
$total = 0;

for ($i = 2; $i < $totalNilai - 2; $i++ ){
    $nilaiUse[] = $nilaiMahasiswa[$i];
    $total += $nilaiMahasiswa[$i];
}

$avg = $total / count($nilaiUse);
echo "Nilai Total : $total <br>";
echo "Rata-rata Nilai : $avg <br>";
?>