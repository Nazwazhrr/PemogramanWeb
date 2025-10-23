<?php
$host = "localhost";
$port = "5432";
$dbname = "jatimpark_db";
$user = "postgres";
$password = "audyna11"; 

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Koneksi ke database gagal: " . pg_last_error());
}
?>