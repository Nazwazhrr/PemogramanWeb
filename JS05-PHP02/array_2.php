<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #444;
        }
        table {
            width: 55%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 14px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3f51b5;
            color: white;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Profil Dosen</h2>
    <?php
        $Dosen = [
            'nama' => 'Elok Nur Hamdana',
            'domisili' => 'Malang',
            'jenis_kelamin' => 'Perempuan' ];

        // echo "Nama : {$Dosen ['nama']} <br>";
        // echo "Domisili : {$Dosen ['domisili']} <br>";
        // echo "Jenis Kelamin : {$Dosen ['jenis_kelamin']} <br>";

        echo "<table>";
        foreach ($Dosen as $key => $value) {
            echo "<tr><th>$key</th><td>$value</td></tr>";
        }
        echo "</table>";
        
    ?>

</body>
</html>