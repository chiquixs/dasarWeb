<?php
// Inisialisasi variabel
$email = "";
$error = "";
$success = "";

// Jika form dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Cek apakah field 'input' ada dan tidak kosong (contoh tambahan)
    if (isset($_POST['input'])) {
        $input = htmlspecialchars($_POST['input'], ENT_QUOTES, 'UTF-8');
    }

    // Cek apakah field 'email' ada
    if (isset($_POST['email'])) {
        // Ambil nilai email dan hilangkan spasi di awal/akhir
        $email_raw = trim($_POST['email']);

        // Sanitasi (hapus karakter ilegal pada email)
        $email_sanitized = filter_var($email_raw, FILTER_SANITIZE_EMAIL);

        // Validasi format email
        if (filter_var($email_sanitized, FILTER_VALIDATE_EMAIL)) {
            // Email valid — lanjutkan proses aman
            $email = $email_sanitized;
            $success = "Email valid: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        } else {
            // Email tidak valid
            $error = "Format email tidak valid. Masukkan alamat email yang benar.";
        }
    } else {
        $error = "Field email tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Validasi Email Aman</title>
</head>
<body>
    <h2>Contoh Validasi Email</h2>

    <?php if ($error): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green;">
            <?= $success ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Masukkan email:</label><br>
        <input
            type="email"
            id="email"
            name="email"
            required
            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
        >
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
