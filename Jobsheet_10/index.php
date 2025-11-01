<?php
require __DIR__ . '/koneksi.php';

// Ambil semua data
$res = $result = q(('SELECT "Id", "Nama", "Nim", "Email", "Jurusan", to_char("Created_at", \'YYYY-MM-DD HH24:MI\') AS "Created_at" FROM "TB_Mahasiswa" ORDER BY "Id" DESC'));


$rows = pg_fetch_all($res) ?: [];
?>

<!doctype html>
<html lang="id">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <title>CRUD Mahasiswa (PHP + PostgreSQL)</title>
  <style>
    body {
      font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif;
      max-width: 980px;
      margin: 24px auto;
      padding: 0 12px
    }

    table {
      border-collapse: collapse;
      width: 100%
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px
    }

    th {
      background: #f6f6f6;
      text-align: left
    }

    a.btn {
      padding: 6px 10px;
      border: 1px solid #999;
      border-radius: 6px;
      text-decoration: none
    }

    .row-actions a {
      margin-right: 8px
    }
  </style>
</head>

<body>
  <h1>Data Mahasiswa</h1>

  <p>
  <button type="button" class="btn btn-primary" onclick="window.location.href='create.php'">
  + Tambah Mahasiswa
  </button>
  </p>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
        <th>Dibuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$rows): ?>
      <tr>
        <td colspan="7">Belum ada data.</td>
      </tr>
      <?php else: foreach ($rows as $r): ?>
      <tr>
        <td><?= htmlspecialchars($r['Id']) ?></td>
        <td><?= htmlspecialchars($r['Nim']) ?></td>
        <td><?= htmlspecialchars($r['Nama']) ?></td>
        <td><?= htmlspecialchars($r['Email']) ?></td>
        <!-- karena ada kemungkinan jurusan bernilai NULL maka ditambahkan 
         ?? '', ENT_QUOTES, 'UTF-8' agar tdak error -->
        <td><?= htmlspecialchars($r['Jurusan']?? '', ENT_QUOTES, 'UTF-8') ?></td> 
        <td><?= htmlspecialchars((string)($r['Created_at'])) ?></td>
        <td class="row-actions">
      <button type="button" class="btn btn-success btn-sm me-1"
      style="padding: 6px 14px; font-size: 14px; width: 85px;"
      onclick="window.location.href='edit.php?Id=<?= urlencode($r['Id']) ?>'">
      Ubah
      </button>

          <!-- <form action="delete.php" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?');">
            <input type="hidden" name="id" value="<?= htmlspecialchars($r['Id']) ?>">
            <button class="btn" type="submit">Hapus</button>
          </form> -->
          <a href="#" 
          class="btn btn-warning btn-sm"
          style="padding: 6px 14px; font-size: 14px; width: 85px;"
          onclick="if(confirm('Hapus data ini?')) { 
              document.getElementById('deleteForm<?= $r['Id'] ?>').submit(); 
          }">
          Hapus
          </a>
          <form id="deleteForm<?= $r['Id'] ?>" action="delete.php" method="post" style="display:none;">
            <input type="hidden" name="Id" value="<?= htmlspecialchars($r['Id']) ?>">
          </form>

        </td>
      </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</body>

</html>