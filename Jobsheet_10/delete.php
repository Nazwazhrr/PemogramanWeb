<?php
require __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$id = (int)($_POST['Id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

try {
    qparams('DELETE FROM public."TB_Mahasiswa" WHERE "Id"=$1', [$id]);
    header('Location: index.php');
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Gagal menghapus: ' . htmlspecialchars($e->getMessage());
}
