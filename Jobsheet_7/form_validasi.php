<!DOCTYPE html>
<html>
<head>
  <title>Form Input dengan Validasi (AJAX + Password)</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Form Input dengan Validasi (AJAX + Password)</h1>
  
  <form id="myForm" method="post">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama">
    <span id="nama-error" style="color: red;"></span><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <span id="email-error" style="color: red;"></span><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <span id="password-error" style="color: red;"></span><br><br>

    <input type="submit" value="Submit">
  </form>

  <div id="hasil" style="margin-top: 20px; font-weight: bold;"></div>

  <script>
    $(document).ready(function () {
      $("#myForm").submit(function (event) {
        event.preventDefault(); // Mencegah reload halaman

        var nama = $("#nama").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var valid = true;

        // Reset pesan error
        $("#nama-error").text("");
        $("#email-error").text("");
        $("#password-error").text("");
        $("#hasil").text("");

        // Validasi nama
        if (nama === "") {
          $("#nama-error").text("Nama harus diisi.");
          valid = false;
        }

        // Validasi email
        if (email === "") {
          $("#email-error").text("Email harus diisi.");
          valid = false;
        }

        // Validasi password minimal 8 karakter
        if (password === "") {
          $("#password-error").text("Password harus diisi.");
          valid = false;
        } else if (password.length < 8) {
          $("#password-error").text("Password minimal 8 karakter.");
          valid = false;
        }

        // Jika semua valid, kirim data ke PHP pakai AJAX
        if (valid) {
          $.ajax({
            url: "proses_validasi.php",
            type: "POST",
            data: { nama: nama, email: email, password: password },
            success: function (response) {
              $("#hasil").html(response);
            },
            error: function () {
              $("#hasil").html("<span style='color:red;'>Terjadi kesalahan saat mengirim data.</span>");
            }
          });
        }
      });
    });
  </script>
</body>
</html>
