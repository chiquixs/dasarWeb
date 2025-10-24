<?php 
if (isset($_POST["submit"])) {
    $targetdir = "uploads/"; //direktori tujuan untuk menyimpan file
    $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
    $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 3*1024*1024;

    if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"]<=$maxsize) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetfile)) {
            echo "FIle berhasil diunggah.";
            echo "<h3>Pratinjau Gambar:</h3>";
            echo "<img src='" . $targetfile . "' width='200' style='height:auto;'>";
        } else {
            echo "gagal mengunggah file";
        }
    } else {
        echo "File tidak valid atau melebihi ukuran maksimum yang diijinkan";
    }
}
?>