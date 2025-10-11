<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form input dengan validasi</title>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <form  method="post" id="myForm">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color:red;"></span>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color:red;"></span>
        <br>

        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <span id="password-error" style="color: red;"></span>
        <br>

        <input type="submit" value="submit">
    </form>

    <script>
        $(document).ready(function(){
            $("#myForm").submit(function(event){
                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val(); 
                var valid = true;

                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                } else {
                    $("#nama-error").text("");
                }

                if (email === ""){
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                } else {
                    $("#email-error").text("");
                }

                if (password === "") {
                    $("#password-error").text("Password harus diisi.");
                    valid = false;
                } else if (password.length < 8) {
                    $("#password-error").text("Password minimal 8 karakter.");
                    valid = false;
                }


                if (valid) {
                    // kirim ke php pakai ajax
                    $.ajax({
                        url: "form_validation.php",
                        type: "POST",
                        data: { nama: nama, email: email, password: password },
                        success: function(response){
                            // tampilkan berhasil atau gagal
                            $("body").append(response);
                        },
                        error: function(){
                            $("body").append("terjadi kesalahan");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = array();

    // validasi nama
    if (empty($nama)) {
        $errors[] = "Email harus diisi.";
    }

    // Validasi email
    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Format email tidak valid.";
    }

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }

    // Jika ada kesalahan validasi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        } 
    } else {
        echo "<h3>Data yang dikirim:</h3>";
        echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Email: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "<br>";
        echo "Password: " . htmlspecialchars($password, ENT_QUOTES, 'UTF-8') . "<br>";
    }
    // } else {
    //     //  Koneksi ke database
    //     $conn = new mysqli("localhost", "root", "", "db_form");

    //     // Cek koneksi
    //     if ($conn->connect_error) {
    //         die("Koneksi gagal: " . $conn->connect_error);
    //     }

    //     // Simpan data ke tabel 'users'
    //     $sql = "INSERT INTO users (nama, email) VALUES ('$nama', '$email')";

    //     if ($conn->query($sql) === TRUE) {
    //         echo "<p style='color:green;'>Data berhasil dikirim: Nama = $nama, Email = $email</p>";
    //     } else {
    //         echo "<p style='color:red;'>Terjadi kesalahan: " . $conn->error . "</p>";
    //     }

    //     $conn->close();
        // }
    }


?>