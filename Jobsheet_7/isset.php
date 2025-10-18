<?php
    $umur;
    if (isset($umur) && $umur >= 18){
        echo "Anda sudah dewasa.<br>";
    } else {
        echo "Anda belum dewasa atau variabel 'umur' tidak ditemukan<br>";
    }
?>