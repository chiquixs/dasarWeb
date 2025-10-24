<?php 
if (isset($_FILES['file'])) {
    $errors = array();
    $uploaded = array();
    $allowed_ext = array("jpg", "jpeg", "png", "gif");
    $max_size = 5 * 1024 * 1024; // 5 MB

    // Buat folder uploads jika belum ada
    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    // Ambil informasi file
    $file_name = $_FILES['file']['name'];
    $file_tmp  = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];

    // Ambil ekstensi file
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validasi ekstensi
    if (!in_array($file_ext, $allowed_ext)) {
        $errors[] = "$file_name : ekstensi tidak diizinkan.";
    }

    // Validasi ukuran
    if ($file_size > $max_size) {
        $errors[] = "$file_name : melebihi ukuran maksimum 5 MB.";
    }

    // Jika tidak ada error, upload file
    if (empty($errors)) {
        $target_file = "uploads/" . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $uploaded[] = $file_name;
        } else {
            $errors[] = "$file_name : gagal diunggah.";
        }
    }

    // Tampilkan hasil
    if (!empty($errors)) {
        echo "<br>Errors:<br>" . implode("<br>", $errors);
    }

    if (!empty($uploaded)) {
        echo "Berhasil diunggah: " . implode(", ", $uploaded) . "<br>";
        foreach ($uploaded as $img) {
            echo "<img src='uploads/$img' width='200' style='height:auto; margin:5px; border:1px solid #ccc;'>";
        }
    }
}
?>
