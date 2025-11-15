<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';
$conn = get_pg_connection();

$id = $_GET['id']; // Ambil ID dari URL
$query = pg_query($conn, "SELECT * FROM destinasi WHERE id = '$id'");
$data = pg_fetch_assoc($query);

// Proses update data saat form disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tiket_weekday = (int) $_POST['harga_weekday']; // pastikan integer
    $tiket_weekend = (int) $_POST['harga_weekend']; // pastikan integer
    $deskripsi = $_POST['deskripsi'];
    $gambar_lama = $data['gambar'];

    // --- Proses upload gambar baru (opsional) ---
    $gambar_baru = $gambar_lama; 

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $nama_file = basename($_FILES['gambar']['name']);
        $tujuan = 'img/' . $nama_file;

        // Pindahkan file yang diupload ke folder img
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
            $gambar_baru = $nama_file;
        }
    }

    // --- Update data ke database ---
    $update = pg_query($conn, "UPDATE destinasi SET 
        nama = '$nama', 
        harga_weekday = $tiket_weekday, 
        harga_weekend = $tiket_weekend, 
        deskripsi = '$deskripsi',
        gambar = '$gambar_baru'
        WHERE id = '$id'");

    if ($update) {
        header("Location: data.php?pesan=update_sukses");
        exit;
    } else {
        echo "<script>alert('Gagal mengupdate data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Destinasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Edit Data Destinasi</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Destinasi</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tiket Weekday</label>
        <input type="number" name="harga_weekday" class="form-control" value="<?= $data['harga_weekday']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tiket Weekend</label>
        <input type="number" name="harga_weekend" class="form-control" value="<?= $data['harga_weekend']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar Saat Ini</label><br>
        <?php if (!empty($data['gambar'])): ?>
          <img src="img/<?= $data['gambar']; ?>" alt="Gambar Destinasi" width="150" class="mb-2">
        <?php else: ?>
          <p><i>Belum ada gambar</i></p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label class="form-label">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="data.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>
