<?php 
    $username = $_POST['Username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "1234") {
        session_start();
        $_SESSION["Username"] = $username;
        $_SESSION["status"] = 'login';
        echo "Anda berhasil login. silahkan menuju <a href='homeSession.php'>Halaman Home</a>";
    } else {
        echo "Gagal login. silahkan login lagi <a href='sessionLoginForm.html'>Halaman Login</a>";
    }
?>