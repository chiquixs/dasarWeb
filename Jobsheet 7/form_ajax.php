<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contoh Form dengan PHP dan JQuery</title>
    <script src="jquery-3.7.1.js"></script>
</head>
<body>
    <h2>Form Contoh</h2>
    
    <form id="myForm"> 
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah" required>
            <option value="apel">Apel</option>
            <option value="pisang">Pisang</option>
            <option value="mangga">Mangga</option>
            <option value="jeruk">Jeruk</option>
        </select>
        <br><br>

        <label>Pilih Warna Favorit:</label><br>
        <input type="checkbox" name="warna[]" value="merah"> Merah<br>
        <input type="checkbox" name="warna[]" value="biru"> Biru<br>
        <input type="checkbox" name="warna[]" value="hijau"> Hijau<br>
        <br>

        <label>Pilih Jenis Kelamin:</label><br>
        <input type="radio" name="jenis_kelamin" value="laki-laki" required> Laki-laki<br>
        <input type="radio" name="jenis_kelamin" value="perempuan" required> Perempuan<br>
        <br>

        <input type="submit" value="Submit">
    </form>

    <div id="hasil">
        <!-- hasil akan ditampilkan disini -->
    </div>

    <script>
        $(document).ready(function() {
            $("#myForm").submit(function (e) {
                e.preventDefault(); 

                var formData = $(this).serialize();

                $.ajax({
                    url: "proses_lanjut.php",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        $("#hasil").html(response);
                    },
                });
            });
        });
    </script>
</body>
</html>
