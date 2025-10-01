<?php
function tampilkanAngka (int $jumlah, int $index = 1) {
    echo "Perulangan ke-{$index} <br>";

    //panggil diri sendiri selama $index <= $jumlah
    if ($index < $jumlah) {
        tampilkanAngka ($jumlah, $index + 1);
    }    
}
tampilkanAngka(20);
?>
