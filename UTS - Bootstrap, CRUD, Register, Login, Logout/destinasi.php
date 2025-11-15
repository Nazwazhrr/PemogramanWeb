<?php
include 'config.php';

// Ambil semua destinasi
$query_destinasi = "SELECT * FROM destinasi ORDER BY id_destinasi";
$result_destinasi = pg_query($conn, $query_destinasi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinasi Jatim Park</title>
</head>
<body>
  <div class="navbar">
    <img src="img/jtp_logoo.png" class="logo" alt="Logo JTP">
    <ul>
      <a href="index.html">Home</a>
      <a href="destinasi.php">Destinasi</a>
      <a href="gallery.html">Galeri</a>
      <a href="kontak.html">Kontak</a>
      <a href="data.php">Data</a>
    </ul>
  </div>

  <div id="destinasi">
    <h2>Destinasi Jatim Park</h2>
    <div class="cards">
      <?php
      while ($dest = pg_fetch_assoc($result_destinasi)) {
          echo "<div class='card'>
                  <div class='icon-wrapper'>
                      <img src='{$dest['gambar']}' alt='{$dest['nama_destinasi']}'>
                  </div>
                  <h3>{$dest['nama_destinasi']}</h3>
                  <p><strong>Deskripsi:</strong> {$dest['deskripsi']}</p>
                  <p><strong>Tiket Weekday:</strong> Rp {$dest['harga_weekday']}</p>
                  <p><strong>Tiket Weekend:</strong> Rp {$dest['harga_weekend']}</p>";

          // Ambil data wahana berdasarkan id_destinasi
          $id = $dest['id_destinasi'];
          $query_wahana = "SELECT nama_wahana, kategori FROM wahana WHERE id_destinasi = $id ORDER BY kategori";
          $result_wahana = pg_query($conn, $query_wahana);

          $kategori_sekarang = "";
          while ($wahana = pg_fetch_assoc($result_wahana)) {
              if ($kategori_sekarang != $wahana['kategori']) {
                  if ($kategori_sekarang != "") {
                      echo "</ul>";
                  }
                  $kategori_sekarang = $wahana['kategori'];
                  echo "<p><strong>{$kategori_sekarang}:</strong></p><ul>";
              }
              echo "<li>{$wahana['nama_wahana']}</li>";
          }
          echo "</ul>
                <button class='cta-button'>Beli Tiket</button>
              </div>";
      }
      ?>
    </div>
  </div>

  <div id="footer-container"></div>
  <script src="footer.js"></script>
</body>
</html>

<?php pg_close($conn); ?>
