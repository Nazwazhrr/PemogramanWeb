<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Input PHP</title>
</head>
<body>
  <h2>Form Input PHP</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="input">Masukkan text:</label>
    <input type="text" name="input" id="input">

    <input type="submit" name="submit" value="Kirim"><br><br>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $input = $_POST['input'];
      $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

      echo "Hasil input: " . $input . "<br>";
  }
  ?>
</body>
</html>
