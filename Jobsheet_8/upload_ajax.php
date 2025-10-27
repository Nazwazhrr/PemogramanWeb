<?php
if (isset($_FILES['files'])) {
    $total_files = count($_FILES['files']['name']);
    $extensions = array("jpg", "jpeg", "png", "gif");
    $max_file_size = 5242880; // 5 MB
    $upload_dir = "images/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $success = 0;
    $errors = array();

    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $extensions)) {
            $errors[] = "File <b>{$file_name}</b> memiliki ekstensi yang tidak diizinkan.";
            continue;
        }

        if ($file_size > $max_file_size) {
            $errors[] = "File <b>{$file_name}</b> terlalu besar (maksimum 5 MB).";
            continue;
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $success++;
        } else {
            $errors[] = "Gagal mengunggah file <b>{$file_name}</b>.";
        }
    }

    if (empty($errors)) {
        echo "Berhasil mengunggah {$success} gambar!";
    } else {
        echo "Sebagian file gagal diunggah:<br>" . implode("<br>", $errors);
    }
} else {
    echo "Tidak ada file yang dipilih.";
}
?>
