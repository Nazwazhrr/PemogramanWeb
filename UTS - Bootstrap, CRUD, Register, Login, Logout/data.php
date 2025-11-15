<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Silakan login terlebih dahulu.'));
    exit;
}

require 'koneksi.php';
$conn = get_pg_connection();
$query = "SELECT * FROM public.destinasi";
$result = pg_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Destinasi Jatim Park</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg bg-success navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
        <img src="img/jtp_logoo.png" alt="Logo" width="65" height="30" class="me-2">
        <span>Jatim Park Group</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="destinasi.html">Destinasi</a></li>
          <li class="nav-item"><a class="nav-link" href="gallery.html">Galeri</a></li>
          <li class="nav-item"><a class="nav-link" href="kontak.html">Kontak</a></li>
          <li class="nav-item"><a class="nav-link active" href="data.php">Data</a></li>
        </ul>
      </div>

      <div class="d-flex align-items-center ms-3">
        <span class="text-white me-3 small">
          👤 <?= htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']); ?>
        </span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container my-5 flex-grow-1">
    <h1 class="text-center fw-bold mb-4 text-success">Data Destinasi Jatim Park</h1>

    <?php if (isset($_GET['pesan'])): ?>
      <?php if ($_GET['pesan'] == 'hapus_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show">
          ✓ Data berhasil dihapus!
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php elseif ($_GET['pesan'] == 'update_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show">
          ✓ Data berhasil diupdate!
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php elseif ($_GET['pesan'] == 'tambah_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show">
          ✓ Data berhasil ditambahkan!
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Destinasi</a>

    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-success text-center">
          <tr>
            <th>ID</th>
            <th>Nama Destinasi</th>
            <th>Deskripsi</th>
            <th>Tiket Weekday</th>
            <th>Tiket Weekend</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = pg_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td style="max-width: 300px; white-space: normal;"><?= htmlspecialchars($row['deskripsi']) ?></td>
            <td>Rp <?= number_format($row['harga_weekday'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($row['harga_weekend'], 0, ',', '.') ?></td>
            <td class="text-center">
              <?php if (!empty($row['gambar'])): ?>
                <img src="img/<?= htmlspecialchars($row['gambar']) ?>" width="150" height="100" class="rounded">
              <?php else: ?>
                <span class="text-muted">Belum ada gambar</span>
              <?php endif; ?>
            </td>
            <td class="text-center">
              <a href="ubah.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm mb-1">Ubah</a>
              <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer class="bg-success text-white pt-5 pb-3 mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Jatim Park Group</h5>
          <p class="small mb-1">Jl. Kartika No.2, Kota Batu, Malang</p>
          <p class="small mb-1">Telepon: (0341) 597777</p>
          <p class="small mb-1">Email: info@jatimpark.com</p>
        </div>

        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Navigasi</h5>
          <ul class="list-unstyled small">
            <li><a href="index.html" class="text-decoration-none text-light">Beranda</a></li>
            <li><a href="destinasi.html" class="text-decoration-none text-light">Destinasi</a></li>
            <li><a href="gallery.html" class="text-decoration-none text-light">Galeri</a></li>
            <li><a href="kontak.html" class="text-decoration-none text-light">Kontak</a></li>
            <li><a href="data.php" class="text-decoration-none text-light">Data</a></li>
          </ul>
        </div>

        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Tentang Kami</h5>
          <p class="small">
            Jatim Park Group merupakan jaringan taman rekreasi dan edukasi terkemuka di Kota Batu, Jawa Timur.
            Kami menghadirkan pengalaman wisata yang memadukan hiburan, pendidikan, dan pelestarian alam.
          </p>
        </div>
      </div>

      <hr class="border-light">
      <div class="text-center small">
        © 2025 Jatim Park Group. All rights reserved.
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
