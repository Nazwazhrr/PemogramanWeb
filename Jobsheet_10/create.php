<?php
require __DIR__ . '/koneksi.php';

$err = $ok = '';
$nim = $nama = $email = $jurusan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = trim($_POST['Nim'] ?? '');
    $nama    = trim($_POST['Nama'] ?? '');
    $email   = trim($_POST['Email'] ?? '');
    $jurusan = trim($_POST['Jurusan'] ?? '');

    if ($nim === '' || $nama === '') {
        $err = 'NIM dan Nama wajib diisi.';
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Format email tidak valid.';
    } else {
        try {
            qparams(
                'INSERT INTO public."TB_Mahasiswa" ("Nim", "Nama", "Email", "Jurusan") VALUES ($1, $2, NULLIF($3, \'\'), NULLIF($4, \'\'))',
                [$nim, $nama, $email, $jurusan]
            );
            header('Location: index.php');
            exit;
        } catch (Throwable $e) {
            $err = $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <title>Tambah Mahasiswa</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial,sans-serif;max-width:720px;margin:24px auto;padding:0 12px}
    label{display:block;margin-top:10px}
    input,select{width:100%;padding:8px;margin-top:4px}
    .btn{padding:8px 12px;border:1px solid #999;border-radius:6px;text-decoration:none}
    .alert{padding:10px;border-radius:6px;margin:10px 0}
    .alert.error{background:#ffe9e9;border:1px solid #e99}
  </style>
</head>
<body>
  <h1>Tambah Mahasiswa</h1>

  <?php if ($err): ?>
    <div class="alert error"><?= htmlspecialchars($err) ?></div>
  <?php endif; ?>

  <form method="post">
    <label>NIM
      <input name="Nim" value="<?= htmlspecialchars($nim) ?>" required>
    </label>
    <label>Nama
      <input name="Nama" value="<?= htmlspecialchars($nama) ?>" required>
    </label>
    <label>Email (opsional)
      <input name="Email" value="<?= htmlspecialchars($email) ?>" placeholder="nama@kampus.ac.id">
    </label>
    <label>Jurusan (opsional)
      <input name="Jurusan" value="<?= htmlspecialchars($jurusan) ?>">
    </label>

    <p style="margin-top:16px">
      <button class="btn btn-success" type="submit">Simpan</button>
      <a class="btn btn-secondary" href="index.php">Kembali</a>
    </p>
  </form>
</body>
</html>
