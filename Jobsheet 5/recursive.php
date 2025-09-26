<?php 
// function tampilkanHaloDunia(){
//     echo "Halo Dunia! <br>";

//     tampilkanHaloDunia();
// }

// tampilkanHaloDunia();

for ($i=1; $i<=25; $i++) {
    echo "Perulangan ke-{$i} <br>";
}

function tampilkanAngka(int $jumlah, int $index = 1){
    echo "Perulangan ke-{$index} <br>";

    if ($index < $jumlah) {
        tampilkanAngka($jumlah, $index + 1);
    }
}
?>