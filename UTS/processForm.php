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

    // validasi email
    $emailMessage = '';
    if (!empty($email)) {
        $emailRaw = trim($email);
        $emailSanitized = filter_var($emailRaw, FILTER_SANITIZE_EMAIL);
        
        if (filter_var($emailSanitized, FILTER_VALIDATE_EMAIL)) {
        $emailMessage = "We will send a confirmation to <strong>$emailSanitized</strong> Please wait your email confirmation!";
        } else {
            $errors[] = "Invalid email format.";
        }
    }

    // menyimpan bukti pembelian
    $receiptMessage = '';
    if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] == 0) {
        $directory = "file/";
        $uniqueFileName = basename($_FILES["receipt"]["name"]);
        $targetFile = $directory . $uniqueFileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowExtension = ["jpg", "jpeg", "png"];
        $maxSize = 5 * 1024 * 1024; 

        if (!in_array($fileType, $allowExtension)) {
            $errors[] = "Invalid file format! Only JPG, JPEG, or PNG are allowed.";
        } elseif ($_FILES["receipt"]["size"] > $maxSize) {
            $errors[] = "The file size is too large! Maximum 5MB.";
        } else {
            if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetFile)) {
                $receiptMessage = " Proof of purchase successfully uploaded: <strong>$uniqueFileName</strong>";
            } else {
                $errors[] = "Failed to upload file!";
            }
        }
    } else {
        $errors[] = "Proof of purchase must be uploaded!";
    }

    // hitung masa garansi (1 tahun dari tanggal pembelian)
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
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran Garansi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url("img/bg.jpg") center/cover no-repeat fixed;
            padding: 40px 20px;
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .success-header {
            background: linear-gradient(135deg, #a99d75ff 0%, #c1b478ff 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .success-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .success-header p {
            font-size: 16px;
            opacity: 0.95;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .checkmark svg {
            width: 50px;
            height: 50px;
            fill: #75ea66ff;
        }

        .alert {
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: start;
            gap: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-left: 5px solid #22c58cff;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left: 5px solid #ef4444;
        }

        .alert-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
        }

        .alert-content {
            flex: 1;
        }

        .alert-content strong {
            display: block;
            margin-bottom: 5px;
            color: #1f2937;
        }

        .data-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            margin-top: 30px;
        }

        .data-card h2 {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #e5e7eb;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .data-item {
            padding: 20px;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            border-radius: 12px;
            border-left: 4px solid #c2a66f;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .data-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .data-label {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .data-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 500;
            word-break: break-word;
        }

        .warranty-highlight {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid #f59e0b;
            margin-top: 25px;
            text-align: center;
        }

        .warranty-highlight .warranty-label {
            font-size: 14px;
            color: #92400e;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .warranty-highlight .warranty-date {
            font-size: 24px;
            color: #92400e;
            font-weight: 700;
        }

        .btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #f0a422ff 0%, #cebd72ff 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(229, 213, 88, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(236, 228, 119, 0.6);
        }

        .error-list {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .error-list h3 {
            color: #dc2626;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .error-list ul {
            list-style: none;
        }

        .error-list li {
            padding: 12px 15px;
            background: #fee2e2;
            border-radius: 8px;
            margin-bottom: 10px;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .success-header h1 {
                font-size: 24px;
            }
            
            .data-card {
                padding: 25px;
            }
            
            .data-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            
            <!-- header succes (tambahan remed)-->
            <div class="success-header">
                <div class="checkmark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                </div>
                <h1>Warranty Registration Successful!</h1>
                <p>Thank you for registering your product ^^</p>
            </div>

            <!-- email confirm (tambahan remed)-->
            <?php if ($emailMessage): ?>
            <div class="alert alert-success">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20" style="color: #22c55e;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="alert-content">
                    <strong>Email Konfirmation</strong>
                    <p><?= $emailMessage ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- receipt confirm (tambahan remed)-->
            <?php if ($receiptMessage): ?>
            <div class="alert alert-success">
                <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20" style="color: #22c55e;">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <div class="alert-content">
                    <strong>Proof of Purchase</strong>
                    <p><?= $receiptMessage ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- error messege -->
            <?php if (!empty($errors)): ?>
            <div class="error-list">
                <h3>⚠️ There is an error:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- data (revisi tampilan (remed))-->
            <div class="data-card">
                <h2>📋 Warranty Registration Data</h2>
                
                <div class="data-grid">
                    <div class="data-item">
                        <div class="data-label">Customer Name</div>
                        <div class="data-value"><?= htmlspecialchars("$fname $lname") ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Email</div>
                        <div class="data-value"><?= htmlspecialchars($email) ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Phone Number</div>
                        <div class="data-value"><?= htmlspecialchars($numberPhone) ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Address</div>
                        <div class="data-value"><?= htmlspecialchars($address) ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Purchase Date</div>
                        <div class="data-value"><?= htmlspecialchars($date) ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Purchase Location</div>
                        <div class="data-value"><?= htmlspecialchars($location) ?></div>
                    </div>

                    <div class="data-item">
                        <div class="data-label">Product Code</div>
                        <div class="data-value"><?= htmlspecialchars($productCode) ?></div>
                    </div>
                </div>

                <!-- warranty date -->
                <div class="warranty-highlight">
                    <div class="warranty-label">⏱️ Warranty Expires On</div>
                    <div class="warranty-date"><?= htmlspecialchars($warrantyPeriod) ?></div>
                </div>
            </div>

            <!-- back button-->
            <div class="btn-container">
                <a href="form.html" class="btn">← Back To Form</a>
            </div>

        <?php endif; ?>
    </div>
</body>
</html>