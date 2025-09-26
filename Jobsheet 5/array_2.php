<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $Dosen = [
            'nama' => 'Elok Nur Hamdana',
            'domisili' => 'Malang',
            'jenis_kelamin' => 'Perempuan'
        ];

        echo "Nama : {$Dosen ['nama']} <br>";
        echo "Domisili : {$Dosen ['domisili']} <br>";
        echo "Jenis Kelamin : {$Dosen ['jenis_kelamin']} <br>";
    ?>

    <table style="border-collapse: collapse; width:20%;";>
        <tr>
            <td style="border:1px solid black; padding:8px;">Nama</td>
            <td style="border:1px solid black; padding:8px;"><?php echo "{$Dosen ['nama']} <br>"; ?></td>
        </tr>
        <tr>
            <td style="border:1px solid black; padding:8px;">Domisili</td>
            <td style="border:1px solid black; padding:8px;"> <?php echo "{$Dosen ['domisili']} <br>"; ?></td>
        </tr>
        <tr>
            <td style="border:1px solid black; padding:8px;">Jenis Kelamin</td>
            <td style="border:1px solid black; padding:8px;"><?php echo "{$Dosen ['jenis_kelamin']} <br>"; ?></td>
        </tr>
    </table>
</body>
</html>