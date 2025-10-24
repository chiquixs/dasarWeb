<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // mengambil value vriable dari form
    $fname = $_POST['firstName'] ?? '';
    $lname = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $numberPhone = $_POST['number'] ?? '';
    $address = $_POST['address'] ?? '';
    $date = $_POST['date'] ?? '';
    $locationValue = $_POST['location'] ?? '';
    $productCode = $_POST['productCode'] ?? '';
    $errors = [];

    echo "<h2>Terimakasih Sudah Mendaftarkan Produk Anda</h2><br>";

    // validasi email
    if (!empty($email)) {
        $emailRaw = trim($email);
        $emailSanitized = filter_var($emailRaw, FILTER_SANITIZE_EMAIL);
        
        if (filter_var($emailSanitized, FILTER_VALIDATE_EMAIL)) {
            echo "<h3 class='email-succes'>Kami akan mengirimkan konfirmasi ke $emailSanitized. Mohon menunggu email konfirmasi!</h3><br>";
        } else {
            $errors[] = "Format email tidak valid.";
        }
    }

    // bukti pembelian
    if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] == 0) {
        $directory = "file/";
        $uniqueFileName = basename($_FILES["receipt"]["name"]);
        $targetFile = $directory . $uniqueFileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowExtension = ["jpg", "jpeg", "png"];
        $maxSize = 5 * 1024 * 1024; 

        if (!in_array($fileType, $allowExtension)) {
            $errors[] = "Format file tidak valid! Hanya JPG, JPEG, atau PNG yang diperbolehkan.";
        } elseif ($_FILES["receipt"]["size"] > $maxSize) {
            $errors[] = "Ukuran file terlalu besar! Maksimal 5MB.";
        } else {
            if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetFile)) {
                echo "<p class='pbukti'>Bukti pembelian berhasil diunggah: <strong>$uniqueFileName</strong></p>";
            } else {
                $errors[] = "Gagal mengunggah file!";
            }
        }
    } else {
        $errors[] = "Bukti pembelian wajib diunggah!";
    }

    // masa garansi
    if (!empty($date)) {
        $purchaseDate = new DateTime($date);
        $warrantyEnd = clone $purchaseDate;
        $warrantyEnd->modify('+1 year');
        $warrantyPeriod = $warrantyEnd->format('d F Y');
    } else {
        $warrantyPeriod = "Tanggal pembelian tidak diisi.";
    }

    // lokasi pembelian
    $locations = [
        "1" => "Cab. Soekarno Hatta",
        "2" => "Cab. Tlogomas",
        "3" => "Cab. Blimbing",
        "4" => "Cab. Araya"
    ];
    $location = isset($locations[$locationValue]) ? $locations[$locationValue] : "Tidak diketahui";

    // error
    if (!empty($errors)) {
        echo "<hr><h3 style='color:red;'>Kesalahan:</h3>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        .email-succes {
            background-color: #f1e6d19d;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #c2a66f;
            width:1000px;
        }

        body {
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background: url("img/bg.jpg") center/cover no-repeat fixed;
            color: #333;
            padding: 50px;
            line-height: 1.6;

        }

        h2 {
            color: #5b4636;
            background-color: #f1e6d19d;
            padding: 10px 15px;
            border-left: 5px solid #c2a66f;
            border-radius: 10px;
            width:1000px;
            margin-bottom: 0px;
        }

        h3 {
            color: #5b4636;
            margin-top: 0px;
        }

        p, br {
            font-size: 18px;
        }

        .pbukti {
            background-color: #f1e6d19d;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #c2a66f;
            width: 1000px;
            color: #333;
            font-size: 20px;
        }

        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }

        strong {
            color: #333;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .data { 
            background: #dbd4c7ff; 
            border: 1px solid #eee4ca; 
            padding: 15px; 
            border-radius: 10px;
            width: 500px;
            justify-content: center;
        }

        a.btn { 
            display: inline-block; 
            margin-top: 20px; 
            text-decoration: none; 
            background: #c2a66f; 
            color: white; 
            padding: 10px 20px; 
            border-radius: 5px; 
            transition: 0.2s; 
        } 
        
        a.btn:hover { 
            background: #b19155; 
        }

    </style>
</head>
<body>

<div class="data">
    <h3>Data Pendaftaran Garansi:</h3>
    <p><strong>Nama Customer :</strong> <?= htmlspecialchars("$fname $lname") ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Nomor Telepon :</strong> <?= htmlspecialchars($numberPhone) ?></p>
    <p><strong>Alamat :</strong> <?= htmlspecialchars($address) ?></p>
    <p><strong>Tanggal Pembelian :</strong> <?= htmlspecialchars($date) ?></p>
    <p><strong>Lokasi Pembelian :</strong> <?= htmlspecialchars($location) ?></p>
    <p><strong>Kode Produk :</strong> <?= htmlspecialchars($productCode) ?></p>
    <p><strong>Garansi Berakhir Pada :</strong> <?= htmlspecialchars($warrantyPeriod) ?></p>
</div>

<a href="form.html" class="btn">Kembali ke Form</a>

</body>
</html>
