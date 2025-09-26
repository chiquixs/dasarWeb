<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Index</title>
</head>
<body>
    <h2>Array Terindex</h2>
    <?php 
        $ListDosen=["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];

        echo $ListDosen[2] . "<br>";
        echo $ListDosen[0] . "<br>";
        echo $ListDosen[1] . "<br>";

        for ($i=0; $i < 3; $i++) { 
            echo "Nama Dosen : " . $ListDosen[$i] . "<br>";
        }
    ?>
</body>
</html>