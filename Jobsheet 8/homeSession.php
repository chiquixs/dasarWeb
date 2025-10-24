<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
</head>
<body>
    <?php 
        session_start();
        if ($_SESSION['status'] == 'login') {
            echo "Selamat datang " . $_SESSION['Username'];
        
    ?>
        <br><a href="sessionLogout.php">Logout</a>
    <?php 
        } else {
            echo "Anda belum login, silahkan";
    ?>
        <a href="sessionLoginForm.html">Login</a>
    <?php 
        }
    ?>
</body>
</html>