<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';
$conn = get_pg_connection();

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $weekday = $_POST['harga_weekday'];
  $weekend = $_POST['harga_weekend'];

  // --- Bagian upload gambar ---
  $nama_file = '';
  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $nama_file = basename($_FILES['gambar']['name']);
    $tujuan = 'img/' . $nama_file;

    // Pindahkan file yang diupload ke folder img
    move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan);
  }

  // --- Query untuk memasukkan data ke database ---
  $query = "INSERT INTO destinasi (nama, deskripsi, harga_weekday, harga_weekend, gambar)
            VALUES ('$nama', '$deskripsi', $weekday, $weekend, '$nama_file')";
  $result = pg_query($conn, $query);

  if ($result) {
    header("Location: data.php");
    exit;
  } else {
    echo "<script>alert('Gagal menambahkan data.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Destinasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h3 class="mb-4">Tambah Destinasi</h3>
    <!-- Wajib tambahkan enctype agar upload gambar bisa jalan -->
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Destinasi</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Harga Weekday</label>
        <input type="number" name="harga_weekday" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Harga Weekend</label>
        <input type="number" name="harga_weekend" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
