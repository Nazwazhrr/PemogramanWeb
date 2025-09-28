<?php
//membuat fungsi
function perkenalan(){
    echo "Assalamualaikum, ";
    echo "Perkenalkan, nama saya Elok<br/>"; //Tulis sesuai nama kalian
    echo "Senang berkenalan dengan Anda<br/>";
}

//memanggil fungsi yang sudah dibuat
perkenalan("Hamdan", "Hallo");

echo "<hr>";

$saya = "Elok";
$ucapanSalam = "Selamat pagi";

//memanggil lagi
perkenalan($saya, $ucapanSalam);

?>